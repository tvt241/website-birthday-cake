import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getReportByYear: function (paramSearch = {}){
        const url = "reports/month-in-year";
        return apiHelper.get(url, paramSearch);
    },
    getReportByMonth: function (paramSearch = {}){
        const url = "reports/day-in-month";
        return apiHelper.get(url, paramSearch);
    },

    getReportByUser: function (paramSearch = {}){
        const url = "reports/top-user";
        return apiHelper.get(url, paramSearch);
    },
    
}