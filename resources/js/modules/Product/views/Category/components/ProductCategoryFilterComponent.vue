<template>
    <div class="card-top px-card pt-4">
        <form action="">
            <div class="row my-2">
                <div class="col-12 col-md-4">
                <label class="title-color d-flex">Tên danh mục</label>
                <input type="" class="form-control" placeholder="Nhập tên danh mục">
            </div>
            <div class="col-12 col-md-4">
                <label class="title-color d-flex">Cấp tối đa</label>
                <select class="form-control" name="instock" id="instock">
                    <option value="">--Tất cả--</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>

                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="title-color d-flex">Trạng thái</label>
                <select class="form-control" name="instock" id="instock">
                    <option value="">
                        --Tất cả--</option>
                    <option value="1">Kích hoạt</option>
                    <option value="0">Không kích hoạt</option>
                </select>
            </div>
            </div>
            <div class="text-right">
                <button id="filter" type="button" class="btn btn-primary">
                    <i class="text-right"></i>Lọc
                </button>
            </div>

        </form>
    </div>
</template>