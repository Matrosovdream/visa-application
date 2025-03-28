<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Helpers\adminSettingsHelper;
use App\Models\OrderStatus;
use App\Helpers\TravellerHelper;
use App\Models\Traveller;
use App\Models\TravellerDocuments;
use App\Models\User;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Product;
use App\Actions\Web\OrderActions;
use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepo;
use App\Repositories\Traveller\TravellerRepo;


class DashboardOrdersController extends Controller
{

    protected $orderRepo;
    protected $travellerRepo;

    public function __construct()
    {
        $this->orderRepo = new OrderRepo();
        $this->travellerRepo = new TravellerRepo();
    }
    
    public function index( Request $request )
    {

        //dd($request->all());

        // Filter orders
        $orders = Order::orderByDesc('id');

        if( isset($request->date_from) ) {
            $orders->where('created_at', '>=', $request->date_from);
        }

        if( isset($request->date_to) ) {
            $orders->where('created_at', '<=', $request->date_to);
        }

        if( isset($request->status) ) {
            $status = OrderStatus::where('slug', $request->status)->first();
            $orders->where('status_id', $status->id);
        }

        $data = [
            'title' => 'Orders',
            'orders' => $orders->paginate(10),
            'orderStatuses' => OrderStatus::all(),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];
        return view('dashboard.orders.index', $data);
    }

    public function show($id)
    {
     
        $data = [
            'title' => 'Order',
            'order' => Order::find($id),
            'orderRepo' => $this->orderRepo->getByID($id),
            'orderStatuses' => OrderStatus::all(),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
            //'travellerFieldCategories' => TravellerHelper::getTravellerFieldCategories(),
            //'travellerFields' => TravellerHelper::getTravellerFieldList( $traveller->id )
        ];

        return view('dashboard.orders.show', $data);
    }

    public function edit($id)
    {

        $data = [
            'title' => 'Edit Order',
            'order' => Order::find($id),
            'orderRepo' => $this->orderRepo->getByID($id),
            'orderStatuses' => OrderStatus::all(),
            'Users' => User::all(),
            'countries' => Country::all(),
            'currencies' => Currency::all(),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        //dd($data['orderRepo']);

        return view('dashboard.orders.edit', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Create Order',
            'orderStatuses' => OrderStatus::all(),
            'Users' => User::all(),
            'countries' => Country::all(),
            'currencies' => Currency::all(),
            'products' => Product::all(),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        //dd($data);

        return view('dashboard.orders.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'product' => 'required',
            'meta.currency' => 'required',
            'fields.status_id' => 'required',
            'fields.user_id' => 'required',
            'meta.country_from_id' => 'required',
            'meta.country_to_id' => 'required',
        ]);

        $request->product_id = explode('|', $request->product)[0];
        $request->offer_id = explode('|', $request->product)[1];
        $request->currency = $request->meta['currency'];
        $request->quantity = 1;

        //dd($request);

        $order = OrderActions::createOrder($request);

        if( isset($order) ) {
            return redirect()->route('dashboard.orders.show', $order->id);
        } else {
            return redirect()->back();
        }
    }

    public function update(Order $order, Request $request)
    {
        
        //dd($order, $request->all());

        // Update fields
        $order->update($request->fields);

        // Meta
        foreach( $request->meta as $meta => $value ) {
            $order->setMeta($meta, $value);
        }   

        return redirect()->back()->with('success', 'Order updated');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect()->route('dashboard.orders.index');
    }

    public function travellersCreate(Order $order)
    {

        $travellerFields = TravellerHelper::getTravellerFieldList();
        //dd($travellerFields);


        $data = [
            'title' => 'Order Traveller',
            'order' => $order,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
            'orderStatuses' => OrderStatus::all(),
            'travellerFieldCategories' => TravellerHelper::getTravellerFieldCategories(),
            'travellerFields' => TravellerHelper::getTravellerFieldList()
        ];

        return view('dashboard.orders.traveller.create', $data);
    }

    public function travellersStore(Order $order, Request $request)
    {

        $request->validate([
            'fields.name' => 'required',
            'fields.lastname' => 'required',
            'fields.birthday' => 'required',
            'fields.passport' => 'required',
        ]);

        $traveller = new Traveller();
        $traveller->name = $request->input('fields.name');
        $traveller->lastname = $request->input('fields.lastname');
        $traveller->birthday = $request->input('fields.birthday');
        $traveller->passport = $request->input('fields.passport');
        $traveller->save();

        // Sync with the order
        $order->travellers()->sync($traveller->id);

        foreach( $request->fields as $field => $value ) {
            
            // Get field
            $field = TravellerHelper::getTravellerField($field);

            // Validate field and Update field
            if( isset($field) ) {
                TravellerHelper::updateTravellerField($traveller->id, $field, $value);
            } 

        }

        return redirect()->route('dashboard.orders.traveller.edit', [$order->id, $traveller->id]);
    }

    public function travellerShow($orderId, $travellerId)
    {
        $order = Order::find($orderId);
        $traveller = $order->travellers()->find($travellerId);
        $travellerRepo = $this->travellerRepo->getByID($travellerId);

        $data = [
            'title' => 'Order Traveller',
            'order' => $order,
            'orderRepo' => $this->orderRepo->getByID($orderId),
            'traveller' => $traveller,
            'travellerRepo' => $travellerRepo,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
            'orderStatuses' => OrderStatus::all(),
            'travellerFieldCategories' => TravellerHelper::getTravellerFieldCategories(),
            'travellerFields' => TravellerHelper::getTravellerFieldList( $traveller->id )
        ];

        // Traveller fields
        $fields = $data['orderRepo']['product']['fields']['traveller']['all'];

        // Group by section field
        $groupedFields = [];
        foreach( $fields as $field ) {
            // Retrieve the value
            $value = $travellerRepo['fieldValues']['items'][ $field['id'] ] ?? null;
            $field['field']['value'] = $value['value'] ?? null;

            // If type is reference
            if( $field['field']['type'] == 'reference' ) {

                // Filter from options by id
                foreach( $field['field']['options'] as $option ) {

                    if( !isset($option['id']) ) { continue; }

                    if( $option['id'] == $field['field']['value'] ) {
                        $field['field']['valueRef'] = $option['name'];
                        break;
                    }
                }
            }

            $groupedFields[ $field['section'] ][] = $field['field'];
        }

        $data['groupedFields'] = $groupedFields;

        return view('dashboard.orders.traveller.show', $data);
    }

    public function travellerEdit($orderId, $travellerId)
    {
        $order = Order::find($orderId);
        $traveller = $order->travellers()->find($travellerId);

        $data = [
            'title' => 'Edit Order Traveller',
            'order' => $order,
            'traveller' => $traveller,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
            'orderStatuses' => OrderStatus::all(),
            'travellerFieldCategories' => TravellerHelper::getTravellerFieldCategories(),
            'travellerFields' => TravellerHelper::getTravellerFieldList( $traveller->id )
        ];

        return view('dashboard.orders.traveller.edit', $data);

    }

    public function travellerUpdate(Order $order, Traveller $traveller, Request $request)
    {

        foreach( $request->fields as $field => $value ) {
            
            // Get field
            $field = TravellerHelper::getTravellerField($field);

            // Validate field and Update field
            if( isset($field) ) {
                TravellerHelper::updateTravellerField($traveller->id, $field, $value);
            } 

        }

        return redirect()->route('dashboard.orders.traveller.edit', [$order->id, $traveller->id]);

    }

    public function travellersDestroy(Order $order, Traveller $traveller, Request $request)
    {
        $traveller->delete();
        return redirect()->back()->with('success', 'Traveller deleted');
    }

    public function travellerDocumentStore(Order $order, Traveller $traveller, Request $request)
    {
        
        // Store the file in the 'uploads' directory
        if ($request->hasFile('document')) {

            $data = ['description' => $request->description, 'order_id' => $order->id];
            TravellerHelper::uploadDocument( 
                $traveller->id, 
                $request_file = 'document',
                $data
            );

        }

        return redirect()->back()->with('success', 'Document uploaded');
    }

    public function travellerDocumentDestroy(Order $order, Traveller $traveller, TravellerDocuments $document)
    {
        $document->delete();
        return redirect()->back()->with('success', 'Document deleted');
    }

}
