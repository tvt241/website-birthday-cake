
$(document).ready(function() {
    getProvinces();
});

$(document).on("change", ".provinces__input", function(e){
    const provinceId = e.target.value;
    getDistricts(provinceId);
});

$(document).on("change", ".districts__input", function(e){
    const districtId = e.target.value;
    getWards(districtId);
});

function getProvinces() {
    let url = $("#provinces_url").val();
    $.ajax({
        method: "GET",
        url: url,
        success: function(response){
            const provincesInput = $(".provinces__input");
            let provinceOptions = "<option>-- Chọn Tỉnh/ Thành phố --</option>";
            response.data.forEach(province => {
                provinceOptions += `<option value="${province.id}">${province.name}</option>`; 
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
            let wardOptions = "<option>-- Chọn Xã/ Phường --</option>";
            wardsInput.html(wardOptions);

            const districtsInput = $(".districts__input");
            let districtOptions = "<option>-- Chọn Quận/ Huyện --</option>";
            response.data.forEach(district => {
                districtOptions += `<option value="${district.id}">${district.name}</option>`; 
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
            let wardOptions = "<option>-- Chọn Xã/ Phường --</option>";
            response.data.forEach(district => {
                wardOptions += `<option value="${district.id}">${district.name}</option>`; 
            });
            wardsInput.html(wardOptions);
        },
    }); 
}
