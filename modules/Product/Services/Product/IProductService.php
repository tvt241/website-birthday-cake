<?php

namespace Modules\Product\Services\Product;

interface IProductService {
    public function genProductCode($category_code, $variation_id);
    public function index();
    public function store();
    public function show();
    public function update();
    public function delete();
}