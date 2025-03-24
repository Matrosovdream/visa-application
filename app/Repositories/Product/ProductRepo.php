<?php
namespace App\Repositories\Product;

use App\Repositories\AbstractRepo;
use App\Models\Product;
use App\Repositories\Product\ProductFieldsReferenceRepo;


class ProductRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];    
    protected $withRelations = [];

    protected $fieldReferenceRepo;

    public function __construct() {

        $this->model = new Product();

        // References
        $this->fieldReferenceRepo = new ProductFieldsReferenceRepo();

    }

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        $res = [
            'id' => $item->id,
            'name' => $item->name,
            'slug' => $item->slug,
            'price' => $item->price,
            'published' => $item->published,
            'fields' => $this->fieldReferenceRepo->getFieldsByProduct( $item->id ),
            'Model' => $item
        ];

        return $res;
    }

}