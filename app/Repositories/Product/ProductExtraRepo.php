<?php
namespace App\Repositories\Product;

use App\Models\ProductExtras;

class ProductExtraRepo {

    protected $model;

    public function __construct()
    {
        $this->model = new ProductExtras();
    }

    public function getRequired()
    {
        $items = $this->model->getRequiredExtras();
        return $this->mapItems($items);
    }

    public function getOptional()
    {
        $items = $this->model->getOptionalExtras();
        return $this->mapItems($items);
    }

    public function mapItems($items)
    {
        $mappedItems = [];
        foreach ($items as $item) {
            $mappedItems[] = $this->mapItem($item);
        }
        return $mappedItems;
    }

    public function mapItem($item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'type' => $item->type,
            'price' => $item->price,
            'required' => $item->required,
            'meta' => $item->meta,
        ];
    }

    
}