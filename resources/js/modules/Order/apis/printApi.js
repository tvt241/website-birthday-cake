import apiHelper from "~/Core/helpers/apiHelper";

export default {
    printInvoice: function (data){
        const url = "print/invoice";
        return apiHelper.get(url, data);
    }
}