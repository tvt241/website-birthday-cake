<template>
    <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                        </div>
                        <div class="form-check pl-0">
                            <label class="control control-checkbox">Check me out
                                <input type="checkbox" checked="checked" />
                                <div class="control-indicator"></div>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-pill" >Đóng</button>
                    <button type="button" class="btn btn-primary btn-pill">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps } from 'vue';

const props = defineProps(["isShow"]);
</script>