import VueSimpleAlert from "vue-sweetalert2";
import i18n from "~/Core/i18n";

export default {
    confirmDelete: function () {
        return new VueSimpleAlert.confirm(
            "You will not be able to recover the deleted record!",
            i18n.t("label.are_you_sure"),
            "warning",
            {
                confirmButtonText: i18n.t("button.confirm"),
                cancelButtonText: i18n.t("button.cancel"),
                confirmButtonColor: "#696cff",
                cancelButtonColor: "#8592a3",
            }
        );
    },
};
