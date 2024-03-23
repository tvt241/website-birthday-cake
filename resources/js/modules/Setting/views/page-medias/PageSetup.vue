<template>
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="http://localhost:2222/public/assets/admin/img/icons/pages.png"
                alt="">
            <span class="page-header-title">
                Page setup
            </span>
        </h2>
    </div>
    <div class="mt-5 mb-5">
        <div class="inline-page-menu my-4">
            <ul class="list-unstyled">
                <li class="">
                    <router-link :to="{ name: 'admin.settings.system-setups.languages' }" class="nav-link" exact active-class="active">
                        {{ $t("label.about_us") }}
                    </router-link>
                </li>
                <li class="">
                    <router-link :to="{ name: 'admin.settings.system-setups.languages' }" class="nav-link" exact active-class="active">
                        {{ $t("label.terms_and_condition") }}
                    </router-link>
                </li>
                <li class="">
                    <router-link :to="{ name: 'admin.settings.system-setups.languages' }" class="nav-link" exact
                        active-class="active">
                        {{ $t("label.privacy_policy") }}
                    </router-link>
                </li>
                <li class="">
                    <router-link :to="{ name: 'admin.settings.system-setups.languages' }" class="nav-link" exact
                        active-class="active">
                        {{ $t("label.return_policy") }}
                    </router-link>
                </li>
                <li class="">
                    <router-link :to="{ name: 'admin.settings.system-setups.languages' }" class="nav-link" exact
                        active-class="active">
                        {{ $t("label.refund_policy") }}
                    </router-link>
                </li>
                <li class="">
                    <router-link :to="{ name: 'admin.settings.system-setups.languages' }" class="nav-link" exact
                        active-class="active">
                        {{ $t("label.cancellation_policy") }}
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
    <div class="row g-2">
        <div class="col-12">
            <form action="http://localhost:2222/admin/business-settings/page-setup/about-us" method="post">
                <div class="d-flex justify-content-end gap-3 align-items-center">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>