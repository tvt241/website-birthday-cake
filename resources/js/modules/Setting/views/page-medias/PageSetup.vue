<template>
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src=""
                alt="">
            <span class="page-header-title">
                Thiết lập trang web
            </span>
        </h2>
    </div>
    <div class="mt-5 mb-5">
        <ul class="nav nav-underline-active-primary">
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page-medias.page-setups.about_us' }" class="nav-link" exact active-class="active">
                    Về chúng tôi
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page-medias.page-setups.terms_and_condition' }" class="nav-link" exact active-class="active">
                    Điều khoản và điều kiện
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page-medias.page-setups.privacy_policy' }" class="nav-link" exact
                    active-class="active">
                    Chính sách bảo mật
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page-medias.page-setups.return_policy' }" class="nav-link" exact
                    active-class="active">
                    Chính sách trả hàng
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page-medias.page-setups.refund_policy' }" class="nav-link" exact
                    active-class="active">
                    Chính sách hoàn tiền
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page-medias.page-setups.cancellation_policy' }" class="nav-link" exact
                    active-class="active">
                    Chính sách hủy
                </router-link>
            </li>
        </ul>
    </div>
    <div class="row g-2">
        <div class="col-12">
            <form action="" method="post">
                <div class="d-flex justify-content-end gap-3 align-items-center">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>