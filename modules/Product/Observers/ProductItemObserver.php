<?php

namespace Modules\Product\Observers;

use Modules\Product\Models\ProductItem;

class ProductItemObserver
{
    public function created(ProductItem $productItem){
        $productItem->barcode = $productItem->genBarCode();
        $productItem->save();
    }
}
