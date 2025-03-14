<?php
namespace App\Actions\Dashboard;

use App\Helpers\adminSettingsHelper;
use App\Models\ReferenceFormField;
use App\Repositories\FormFieldReference\FormFieldReferenceRepo;


class OrderFieldsActions
{

    public $fieldRefRepo;

    public function __construct( FormFieldReferenceRepo $fieldRefRepo )
    {
        $this->fieldRefRepo = $fieldRefRepo;
    }

    public function index( $request )
    {

        $data = [
            'title' => 'Order form fields',
            'articles' => [],
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        // Main fields request
        $data['items'] = ReferenceFormField::where('entity', 'order');

        // Search fields by title
        if ($request->has('s')) {
            $data['items'] = $data['items']->where('title', 'like', '%'.$request->s.'%');
        }

        // Finally, paginate the results
        $data['items'] = $data['items']->paginate(10);

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
            'entity' => 'order',
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