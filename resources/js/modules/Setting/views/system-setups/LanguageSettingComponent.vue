<template>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert--danger alert-danger mb-3" role="alert">
                <i class="tio-info alert--icon"></i> <strong class="word-nobreak mr-1">Note :</strong>
                <div class="w-0 flex-grow-1">Changing some settings will take time to show effect please clear
                    session or wait for 60 minutes else browse from incognito mode</div>
            </div>

            <form class="card mb-3" action="" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="language-name" class="col-form-label">{{ $t("language") }} </label>
                                <input type="text" class="form-control" id="language-name" name="name"
                                    :placeholder="$t('language_ex')" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Country code</label>
                                <select class="form-control" name="code">
                                    <option selected disabled>---Select Country Code---
                                    </option>
                                    <option value="sn">Shona - chiShona</option>
                                    <option value="sd">Sindhi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit <i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </form>

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table
                            class="table table-borderless table-hover table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0">SL</th>
                                    <th class="border-top-0" style="width: 25%">{{ $t("label.name") }}</th>
                                    <th class="border-top-0" style="width: 15%">{{ $t("label.code") }}</th>
                                    <th class="border-top-0" style="width: 15%">{{ $t("label.status") }}</th>
                                    <th class="border-top-0" style="width: 15%">{{ $t("label.default_status") }}</th>
                                    <th class="border-top-0" style="width: 20%">{{ $t("label.action") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>

                                    <td>en
                                    </td>
                                    <td>en</td>
                                    <td>
                                        <label class="switcher">
                                            <input type="checkbox" @click="updateStatus()" class="switcher_input"
                                                checked>
                                            <span class="switcher_control"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switcher">
                                            <input type="checkbox" @click="applyDefault()" class="switcher_input"
                                                checked>
                                            <span class="switcher_control"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center gap-2">
                                            <router-link :to="{ name: '' }" :title="$t('translate')"
                                                class="btn btn-sm btn-outline-success square-btn">
                                                <i class="mdi mdi-translate"></i>
                                            </router-link>
                                            <button class="btn btn-sm btn-outline-danger square-btn">
                                                <i class="mdi mdi-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import toastHelper from '~/Core/helpers/toastHelper';

// import Select2 from 'vue3-select2-component';

import { reactive } from 'vue';

const form = reactive({
    language_name : " ",
    language_code : "vi"
});

const option = reactive([
    {
        id: "vi",
        text: "Việt nam"
    },
    {
        id: "en",
        text: "English"
    }
]);

function updateStatus() {

}

function applyDefault() {

}

</script>