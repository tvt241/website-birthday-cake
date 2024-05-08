const optionDefault = "<option>-- Chọn --</option>";

$(document).ready(function() {
    getProvinces();
});

$(".icon__copy").on("click", function(){
    var copyText = $("input[name='order-code']").val();
    navigator.clipboard.writeText(copyText);
    toastSuccess("copy thành công");
});

$(document).on("change", ".provinces__input", function(e){
    const provinceId = $("option:selected", this).attr("data-id");
    getDistricts(provinceId);
});

$(document).on("change", ".districts__input", function(e){
    const districtId = $("option:selected", this).attr("data-id");
    getWards(districtId);
});

$(document).on("change", ".wards__input", function(e){
    const districtId = $(".districts__input option:selected").attr("data-id");
    const wardId = $("option:selected", this).attr("data-id");
    getFee(districtId, wardId);
});

function getProvinces() {
    let url = $("#provinces_url").val();
    $.ajax({
        method: "GET",
        url: url,
        success: function(response){
            const provincesInput = $(".provinces__input");
            let provinceOptions = optionDefault;
            response.data.forEach(province => {
                provinceOptions += `<option data-id="${province.id}" value="${province.name}">${province.name}</option>`; 
            });
            provincesInput.html(provinceOptions);
        },
    });
}

function getDistricts(id) {
    let url = $("#districts_url").val();
    url = url.replace(":province", id);
    $.ajax({
        method: "GET",
        url: url,
        success: function(response){
            const wardsInput = $(".wards__input");
            let wardOptions = optionDefault;
            wardsInput.html(wardOptions);

            const districtsInput = $(".districts__input");
            let districtOptions = optionDefault;
            response.data.forEach(district => {
                districtOptions += `<option data-id="${district.id}" value="${district.name}">${district.name}</option>`; 
            });
            districtsInput.html(districtOptions);
        },
    }); 
}

function getWards(id) {
    let url = $("#wards_url").val();
    url = url.replace(":district", id);

    $.ajax({
        method: "GET",
        url: url,
        success: function(response){
            const wardsInput = $(".wards__input");
            let wardOptions = optionDefault;
            response.data.forEach(ward => {
                wardOptions += `<option data-id="${ward.id}" value="${ward.name}">${ward.name}</option>`; 
            });
            wardsInput.html(wardOptions);
        },
    }); 
}

function getFee(districtId, wardId){
    let url = $("#fee_url").val();
    const data = {
        "district_code": districtId,
        "ward_code": wardId,
    };
    // $.ajax({
    //     method: "GET",
    //     url: url,
    //     data,
    //     success: function(response){
    //         const data = response.data;
    //         $(".checkout__order__shipping span").html(formatCurrency(data.total));
    //     },
    // }); 
}
