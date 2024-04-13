<?php

namespace Modules\Product\Services\ProductCategory;

interface IProductCategoryService
{
    public function index();
    public function store();
    public function show();
    public function update();
    public function delete();
}