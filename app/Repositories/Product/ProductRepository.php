<?php
namespace App\Repositories\Product;
use App\Models\Product;
use DB;

class ProductRepository{

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function all()
    {
        return $this->product;

    }

    public function findById($productId): object
    {
        return $this->product->where('products.id',$productId);
    }


    function store($data)
    {
        return $this->product->create($data);
    }

    





}
