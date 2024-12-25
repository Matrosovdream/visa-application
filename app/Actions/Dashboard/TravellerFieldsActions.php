<?php
namespace App\Actions\Dashboard;

use App\Helpers\adminSettingsHelper;
use App\Models\ReferenceFormField;
use App\Repositories\FormFieldReference\FormFieldReferenceRepo;

class TravellerFieldsActions
{

    public $fieldRefRepo;

    public function __construct( FormFieldReferenceRepo $fieldRefRepo )
    {
        $this->fieldRefRepo = $fieldRefRepo;
    }

    public function index()
    {
        $data = [
            'title' => 'Traveller form fields',
            'articles' => [],
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        $data['items'] = ReferenceFormField::where('entity', 'traveller')
        ->orderBy('id', 'asc')
        ->paginate(10);

        return $data;

    }

    public function show( $id )
    {

        $data = [
            'title' => 'Edit Field #'.$id,
            'field' => $this->fieldRefRepo->getById($id),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
            'references' => $this->fieldRefRepo->getReferences(),
            'entities' => $this->fieldRefRepo->getEntities(),
            'field_types' => $this->fieldRefRepo->getFieldTypes(),
        ];
        //dd($data);

        return $data;
    }

    public function create()
    {
        $data = [
            'title' => 'Create Field',
            'entity' => 'traveller',
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
            'references' => $this->fieldRefRepo->getReferences(),
            'entities' => $this->fieldRefRepo->getEntities(),
            'field_types' => $this->fieldRefRepo->getFieldTypes(),
        ];

        //dd($data);

        return $data;
    }

    public function store( $request )
    {

        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'entity' => 'required',
            'type' => 'required'
        ]);
        
        $data = $request->all();
        return $this->fieldRefRepo->create($data);

    }

    public function update($id, $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'entity' => 'required',
            'type' => 'required'
        ]);

        $data = $request->all();
        return $this->fieldRefRepo->update($id, $data);
    }
 
    public function destroy($id)
    {
        $this->fieldRefRepo->deleteById($id);
    }


}