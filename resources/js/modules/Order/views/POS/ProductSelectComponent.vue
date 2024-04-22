<template>
    <div class="col-lg-7">
            <div class="card">
                <!-- POS Title -->
                <div class="pos-title">
                    <h4 class="mb-0">Sản phẩm</h4>
                </div>
                
                <div class="d-flex flex-wrap flex-md-nowrap justify-content-between gap-3 gap-xl-4 px-4 py-4">
                    <div class="w-100 mr-xl-2">
                        <select name="category" id="category" class="form-control" title="select category">
                            <option value="">Tất cả danh mục</option>
                        </select>
                    </div>
                    <div class="w-100 ml-xl-2">
                        <form id="search-form">
                            <div class="input-group border rounded">
                                <input type="search" class="form-control border-0" placeholder="Tên sản phẩm">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body pt-0" id="items">
                    <div class="pos-item-wrap justify-content-center">
                        <div class="pos-product-item card" onclick="quickView('1')">
                            <div class="pos-product-item_thumb">
                                <img src="" class="img-fit">
                            </div>

                            <div class="pos-product-item_content clickable">
                                <div class="pos-product-item_title">
                                    Test Product
                                </div>
                                <div class="pos-product-item_price">
                                    10.00$
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 d-flex justify-content-end">
                    
                </div>
            </div>
        </div>
</template>