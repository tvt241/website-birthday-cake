import ENV from "../config/env";
import toastHelper from "~/Core/helpers/toastHelper";


export default {
    previewImage: function (event) {
        return new Promise((res, rej) => {
            const files = event.target.files
            if (files && files[0] && files[0].type.startsWith("image/")) {
                const result = {};
                result.image = files[0];
                var reader = new FileReader();
                reader.onload = function (e) {
                    result.image_src = e.target.result;
                    res(result);
                };
                reader.readAsDataURL(files[0]);
            }
            else{
                toastHelper.error("Hình ảnh không hợp lệ");
            }
        });
    },
};

export const IMG_DEFAULT = ENV.API_URL + "/assets/admin/images/img-default.jpg";
