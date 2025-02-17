<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Helpers\adminSettingsHelper;
use App\Models\Product;
use App\Models\Country;
use Str;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductFieldsReferenceRepo;
use App\Repositories\FormFieldReference\FormFieldReferenceRepo;

class DashboardProductsController extends Controller
{

    public $perPage = 10;

    protected $productFieldRepo;
    protected $formFieldRepo;

    public function __construct()
    {
        $this->productFieldRepo = new ProductFieldsReferenceRepo();
        $this->formFieldRepo = new FormFieldReferenceRepo();
    }
    
    public function index()
    {

        if( request('s') ) {
            $products = Product::search(request('s'))->where('published', request('status'))->paginate($this->perPage);
        } else {
            $products = Product::paginate($this->perPage);
        }

        $data = [
            'title' => 'Products',
            'products' => $products,
            'perPage' => $this->perPage,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.products.index', $data);
    }

    public function show($id)
    {
        $product = Product::find($id);

        $data = [
            'title' => 'Product',
            'product' => $product,
            'countries' => Country::all(),
            'productFields' => $this->getProductFields( $product ),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        $data['formFields'] = [
            'order' => $this->productFieldRepo->getOrderFieldsByProduct($id),
            'traveller' => $this->productFieldRepo->getTravellerFieldsByProduct($id),
        ];

        //dd($data['formFields']);

        $data['formFieldsRef'] = [
            'order' => [
                'sections' => $this->formFieldRepo->getOrderSections(),
                'fields' => $this->formFieldRepo->getOrderFields(),
            ],
            'traveller' => [
                'sections' => $this->formFieldRepo->getTravellerSections(),
                'fields' => $this->formFieldRepo->getTravellerFields(),
            ],
        ];

        //dd($data['formFieldsRef']);

        return view('dashboard.products.show', $data);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        $data = [
            'title' => 'Edit Product',
            'product' => $product,
            'countries' => Country::all(),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
            'productFields' => $this->getProductFields(),
        ];

        return view('dashboard.products.edit', $data);
    }

    public function update($id)
    {
        $product = Product::find($id);

        $product->name = request('product_name');
        $product->description = request('description');
        $product->price = '0.00';
        $product->published = ( request('status') == 'published' ) ? 1 : 0;
        $product->save();

        // Sync countries
        $product->countries()->sync(request('countries'));

        // Create meta fields
        foreach( request('fields') as $field=>$value ) {
            $product->setMeta( $field, $value );
        }

        return redirect()->route('dashboard.products.show', $id);
    }

    public function store( Request $request )
    {

        $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $product = new Product();
        $product->name = request('product_name');
        $product->slug = Str::slug(request('product_name'));
        $product->description = request('description');
        $product->price = 0;
        $product->published = ( request('status') == 'published' ) ? 1 : 0;
        $product->save();

        return redirect()->route('dashboard.products.show', $product->id);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('dashboard.products.index');
    }

    public function create()
    {
        $data = [
            'title' => 'Create Product',
            'countries' => Country::all(),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.products.create', $data);
    }

    public function getProductFields( $product=null ) {

        $fields = [
            ['slug' => 'valid_for', 'title' => 'Valid For (days)', 'type' => 'text', 'value' => ''],
            ['slug' => 'entries_number', 'title' => 'Number entries', 'type' => 'text', 'value' => ''],
            ['slug' => 'max_stay', 'title' => 'Max stay (days)', 'type' => 'text', 'value' => ''],
        ];

        if( isset($product) ) {
            foreach ($fields as $key => $field) {
                $fields[$key]['value'] = $product->getMeta($field['slug']);
            }
        }

        return $fields;

    }


}
