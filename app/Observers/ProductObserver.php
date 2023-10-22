<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductPrice;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
    public function Retrieved(Product $product)
    {
        
        if(authenticatedUser() != null){
            // get the price due to user type
            $productPrice = ProductPrice::where("product_id",$product->id)
            ->where("user_type_id",authenticatedUser()->user_type_id)
            ->latest()
            ->first();

            if($productPrice){

                $product->price = $productPrice->price;
            }
        }
    }
}
