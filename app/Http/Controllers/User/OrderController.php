<?php
namespace App\Http\Controllers\User;

use App\Actions\Web\OrderActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Traveller;
use App\Models\TravellerDocuments;
use App\Helpers\TravellerHelper;
use App\Helpers\orderHelper;
use App\Repositories\FormFieldReference\FormFieldReferenceRepo;
use App\Repositories\Order\OrderRepo;
use App\Repositories\FormFieldValue\FormFieldValueRepo;
use App\Repositories\Traveller\TravellerRepoStore;


class OrderController extends Controller
{

    protected $formFieldRepo;
    protected $orderRepo;
    protected $fieldValueRepo;
    protected $travellerRepoStore;

    public function __construct()
    {
        $this->formFieldRepo = new FormFieldReferenceRepo();
        $this->orderRepo = new OrderRepo();
        $this->fieldValueRepo = new FormFieldValueRepo();
        $this->travellerRepoStore = new TravellerRepoStore();
    }

    public function index()
    {
        $data = array( 'title' => 'Order', 'orders' => Order::getOrdersByUser( Auth::user()->id )->paginate(100));
        return view('web.account.orders.index', $data);
    }

    public function show($order_id)
    {

        $order = Order::find($order_id);

        // Calculate total
        $total = $order->getTotal();

        // Add extra services price
        foreach ($order->getExtraServices() as $extraService) {
            $total += $extraService->price * $order->getMeta('travellers_count');
        }

        $data = array(
            'title' => 'Order', 
            'order' => Order::find($order_id),
            'total' => $total
        );
        return view('web.account.orders.show', $data);
    }

    public function documents($order_id)
    {
        $data = array('title' => 'Order documents', 'order' => Order::find($order_id));
        return view('web.account.orders.documents', $data);
    }

    public function showPreview($order_hash)
    {
        if( request()->has('lg') ) {
            dd( Order::getByHash($order_hash)->getCart() );
        }
        
        $data = array('title' => 'Order Preview', 'order' => Order::getByHash($order_hash));
        return view('web.order.show', $data);
    }

    public function tripDetails($order_id)
    {
        $data = array(
            'title' => 'Trip details',
            'order' => Order::find($order_id), 
            'travellerFieldCategories' => TravellerHelper::getTravellerFieldCategories(),
            'travellerFields' => TravellerHelper::getTravellerFieldList()
        );

        $product_id = $data['order']->getProduct()->id;

        // Fields reference
        $filters = ['entity' => 'order', 'section' => 'trip'];
        $data['formFields'] = $this->formFieldRepo->getProductFields( 
            $product_id, 
            $filters 
        );

        $countryToCode = $data['order']->getMeta('country_to_code');

        // Prepare references
        foreach ($data['formFields'] as $key => $field) {
            if( $field['type'] == 'reference' ) {

                if( $field['field']['reference_code'] == 'airport' ) {

                    // Filter $field['options'] by country code
                    $field['field']['options'] = array_filter($field['field']['options'], function($airport) use ($countryToCode) {
                        return $airport['iso_country'] == $countryToCode;
                    });

                    $field['options'] = $field['field']['options'];

                    $data['formFields'][$key] = $field;
                }

            }
        }

        //dd($data['formFields']);

        // order field values
        $data['orderFieldValues'] = $this->orderRepo->getOrderValues( $order_id );

        // Set next page
        if( isset($data['order']->travellers) ) {
            $params = [
                'order_id' => $order_id, 
                'applicant_id' => $data['order']->travellers[0]->id, 
                'category' => 'personal'
            ];
            $data['next_page'] = route('web.account.order.applicant.personal', $params);
        }

        return view('web.account.orders.trip', $data);
    }

    public function tripDetailsUpdate(Request $request, $order_id)
    {

        // Update order fields
        if( isset($request->fields) ) {
            $this->orderRepo->saveOrderValues( $order_id, $request->fields );
        }

        // Check if is completed then update status
        orderHelper::checkUpdateStatus( $order_id );

        if( isset( $request->next_page ) ) {
            return redirect($request->next_page );
        } else {
            return redirect()->route('web.account.order.trip', $order_id);
        }
        
    }

    public function applicantDocuments($order_id, $applicant_id)
    {
        $applicant = Traveller::find($applicant_id);
        return view('web.account.orders.applicant.documents', $this->getApplicantData($order_id, $applicant_id));
    }

    public function applicantDocumentsUpdate(Request $request, $order_id, $applicant_id)
    {

        $traveller = Traveller::find($applicant_id);    

        // Store the file in the 'uploads' directory
        if ($request->hasFile('document')) {

            $data = ['description' => $request->description, 'order_id' => $order_id];
            TravellerHelper::uploadDocument( 
                $applicant_id, 
                $request_file = 'document',
                $data
            );

        }

        // Check if is completed then update status
        orderHelper::checkUpdateStatus( $order_id );
        
        return redirect()->route('web.account.order.applicant.documents', [$order_id, $applicant_id]);
    }

    public function applicantDocumentDelete($order_id, $applicant_id, $document_id)
    {
        TravellerDocuments::find($document_id)->delete();
        return redirect()->route('web.account.order.applicant.documents', [$order_id, $applicant_id]);
    }

    public function applicantPersonal($order_id, $applicant_id)
    {

        $data = $this->getApplicantData($order_id, $applicant_id);
        $data = array_merge($data, $this->getTravellerFields($applicant_id, $data['order']->getProduct()->id, 'personal'));

        return view('web.account.orders.applicant.personal', $data);
    }

    public function getTravellerFields( $applicant_id, $product_id, $category ) {

        $data = [];

        $data['formFields'] = $this->getFormFields( 
            $product_id,
            'traveller', 
            $category
        );

        $data['fieldValues'] = $this->fieldValueRepo->getTravellerValues( $applicant_id );

        return $data;

    }

    public function applicantPassport($order_id, $applicant_id)
    {
        $data = $this->getApplicantData($order_id, $applicant_id);
        $data = array_merge($data, $this->getTravellerFields($applicant_id, $data['order']->getProduct()->id, 'passport'));

        return view('web.account.orders.applicant.passport', $data);
    }

    public function applicantFamily($order_id, $applicant_id)
    {
        $data = $this->getApplicantData($order_id, $applicant_id);
        $data = array_merge($data, $this->getTravellerFields($applicant_id, $data['order']->getProduct()->id, 'family'));

        return view('web.account.orders.applicant.family', $data);
    }

    public function applicantPastTravel($order_id, $applicant_id)
    {
        $data = $this->getApplicantData($order_id, $applicant_id);
        $data = array_merge($data, $this->getTravellerFields($applicant_id, $data['order']->getProduct()->id, 'past_travel'));

        return view('web.account.orders.applicant.past-travel', $data);
    }

    public function applicantDeclarations($order_id, $applicant_id)
    {
        $data = $this->getApplicantData($order_id, $applicant_id);
        $data = array_merge($data, $this->getTravellerFields($applicant_id, $data['order']->getProduct()->id, 'declarations'));

        return view('web.account.orders.applicant.declarations', $data);
    }

    public function applicantFieldsUpdate(Request $request, $order_id, $applicant_id)
    {
        
        // Update order fields
        if( isset($request->travellers) ) {
            $this->travellerRepoStore->saveFieldValues( $applicant_id, $request->travellers );
        }

        //dd($request->all());

        /*
        ApplicantActions::fieldsUpdate($request, $order_id, $applicant_id);
        */

        // Check if is completed then update status
        orderHelper::checkUpdateStatus( $order_id );

        if( isset($request->next_page) ) {
            return redirect( $request->next_page );
        } else {
            return redirect()->back();
        }
        
        
    }

    public function getApplicantData($order_id, $applicant_id) {

        $fields = [
            'order' => Order::find($order_id), 
            'applicant' => Traveller::find($applicant_id),
            'travellerFieldCategories' => TravellerHelper::getTravellerFieldCategories(),
            'travellerFields' => TravellerHelper::getTravellerFieldList( $applicant_id )
        ];

        if( isset( request()->category ) ) {
            $fields['fields'] = TravellerHelper::getTravellerFieldList($applicant_id)[ request()->category ];
        }

        // Set next page
        $category = request()->category ?? '';

        if( $category == 'personal' ) {
            $params = [
                'order_id' => $order_id, 
                'applicant_id' => $applicant_id, 
                'category' => 'passport'
            ];
            $fields['next_page'] = route('web.account.order.applicant.passport', $params);
        }
        if( $category == 'passport' ) {
            $params = [
                'order_id' => $order_id, 
                'applicant_id' => $applicant_id, 
                'category' => 'family'
            ];
            $fields['next_page'] = route('web.account.order.applicant.family', $params);
        }
        if( $category == 'family' ) {
            $params = [
                'order_id' => $order_id, 
                'applicant_id' => $applicant_id, 
                'category' => 'past_travel'
            ];
            $fields['next_page'] = route('web.account.order.applicant.past-travel', $params);
        }
        if( $category == 'past_travel' ) {
            $params = [
                'order_id' => $order_id, 
                'applicant_id' => $applicant_id, 
            ];
            $fields['next_page'] = route('web.account.order.applicant.documents', $params);
        }

        return $fields;
    }

    public function createApply(Request $request)
    {

        $order = OrderActions::createOrderNew($request);
        if( isset($order) ) {
            return redirect()->route('web.order.show', $order->hash);
        } else {
            return redirect()->back();
        }

    }

    public function pay($hash)
    {
        $order = Order::getByHash($hash);

        // Payment processing
        

        // Change order status
        $order->status_id = 2;
        $order->save();

        // Redirect to the order page
        return redirect()->route('web.order.show', $order->hash);
    }

    public function getFormFields($product_id, $entity, $section)
    {
        $filters = ['entity' => $entity, 'section' => $section];
        return $this->formFieldRepo->getProductFields( $product_id, $filters );
    }

}
