<?php
namespace App\Services\Product;
use GuzzleHttp\Psr7\Request;
use App\Http\Resources\{ProductCollection, ProductResource};
use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\Collection;


class ProductService{

    protected $productRepository;

    function __construct (ProductRepository $productRepository){

        $this->productRepository = $productRepository;

    }

    function store($data) : object {

        return $this->productRepository->store($data);

    }

    function getProductById($productId) : ?object {

        return new ProductResource($this->productRepository->findById($productId)
            ->first());

    }
    function getProducts() :? ProductCollection  {

        $products =  $this->productRepository->all()
            ->active()
            ->paginate(paginatedRowsCount());

        return new ProductCollection($products);
    }


}
