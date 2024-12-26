<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductFieldsReferenceRepo;
use App\Repositories\FormFieldReference\FormFieldReferenceRepo;
use Illuminate\Http\Request;



class ProductFieldsReferenceController extends Controller {

    protected $productFieldRepo;

    public function __construct()
    {
        $this->productFieldRepo = new ProductFieldsReferenceRepo();
        //$this->formFieldRepo = new FormFieldReferenceRepo();
    }

    public function store(Request $request) {

        $request->validate([
            'product_id' => 'required',
            'entity' => 'required',
            'field_id' => 'required',
            'section' => 'required',
        ]);

        $this->productFieldRepo->create($request->all());

        //dd($request->all());

        return redirect()->back()->with('success', 'Product field reference added successfully');

    }

    public function update(Request $request, $id) {


        $request->validate([
            'product_id' => 'required',
            'entity' => 'required',
            'field_id' => 'required',
            'section' => 'required',
        ]);

        $this->productFieldRepo->update($id, $request->all());

        return redirect()->back()->with('success', 'Product field reference updated successfully');

    }    

    public function destroy($id) {

        $this->productFieldRepo->deleteById($id);

        return redirect()->back()->with('success', 'Product field reference deleted successfully');

    }
 
}