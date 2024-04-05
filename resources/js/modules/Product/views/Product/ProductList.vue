<template>
    <PageHeaderTitleComponent :header-title="$t('label.products.list')">
        <button type="button" class="btn btn-primary text-nowrap">
            <router-link :to="{ name: 'settings.system-setups.languages' }" class="" exact
                active-class="active">
                <i class="mdi mdi-plus"></i>
                {{ $t("button.create") }}
            </router-link>
        </button>
    </PageHeaderTitleComponent>
    <div class="row g-2">
        <div class="col-12">
            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-top px-card pt-4">
                    <div class="row justify-content-between align-items-center gy-2">
                        <div class="col-lg-4">
                            <form action="http://localhost:2222/admin/product/list" method="GET">
                                <div class="input-group">
                                    <input id="" type="search" name="search" class="form-control"
                                        placeholder="Search by product name" aria-label="Search" value="" required
                                        autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-8">
                            <div class="d-flex gap-3 justify-content-end text-nowrap flex-wrap">
                                <div>
                                    <button type="button" class="btn btn-outline-primary" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="tio-download-to"></i>
                                        Export
                                        <i class="tio-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a type="submit" class="dropdown-item d-flex align-items-center gap-2"
                                                href="http://localhost:2222/admin/product/excel-import">
                                                <img width="14"
                                                    src="http://localhost:2222/public/assets/admin/img/icons/excel.png"
                                                    alt="">
                                                Excel
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-4">
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Product name</th>
                                    <th>Selling price</th>
                                    <th class="text-center">Total sale</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody id="set-rows">
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="media align-items-center gap-3">
                                            <div class="avatar">
                                                <img src="http://localhost:2222/storage/app/public/product/2023-09-06-64f83b1948ac3.png"
                                                    class="rounded img-fit">
                                            </div>

                                            <div class="media-body">
                                                <a class="text-dark" href="http://localhost:2222/admin/product/view/1">
                                                    Test Product
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>10.00$</td>
                                    <td class="text-center">0
                                    </td>
                                    <td>
                                        <div><span class="">Stock Type : Unlimited</span></div>
                                    </td>
                                    <td>
                                        <div>
                                            <label class="switcher">
                                                <input id="1" class="switcher_input" type="checkbox" checked
                                                    data-url="http://localhost:2222/admin/product/status/1/0"
                                                    onchange="status_change(this)">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline-info btn-sm edit square-btn"
                                                href="http://localhost:2222/admin/product/edit/1">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm delete square-btn"
                                                onclick="form_alert('product-1','Want to delete this item ?')">
                                                <i class="tio-delete"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4 px-3">
                        <div class="d-flex justify-content-lg-end">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";

</script>