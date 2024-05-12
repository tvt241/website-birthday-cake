const swalBs = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
});

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    iconColor: 'white',
    customClass: {
      popup: 'colored-toast',
    },
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
});
const urlImageDefault = $("#image_url_order").val();

function toastOrder(text = "098765xxx1 đã mua hàng", title = "Cảm ơn"){
    Toast.fire({
        iconHtml: `<img height="70px" width="70px" style="max-width: unset; margin-left: 20px;" src="${ urlImageDefault }">`,
        icon: "success",
        position: 'bottom-start',
        timer: 5000,
        timerProgressBar: false,
        customClass: {
            popup: 'order-toast',
        },
        text,
        title,
    });
}

function toastSuccess(title = "Thành công"){
    Toast.fire({
        icon: 'success',
        title,
    });
}

function toastError(title= "Thất bại"){
    Toast.fire({
        icon: 'error',
        title,
    });
}

function toastInfo(title){
    Toast.fire({
        icon: 'info',
        title,
    });
}

function toastWarning(title){
    Toast.fire({
        icon: 'warning',
        title,
    });
}

function alertSuccess(text = "Thành công"){
    swalBs.fire({
        icon: "success",
        title: text,
        showConfirmButton: false,
        timer: 1500
    });
}

function alertError(title = "Thất bại", text= ''){
    swalBs.fire({
        icon: "error",
        title: title,
        text,
        showConfirmButton: false,
        timer: 1500
    });
}

function alertConfirm(title = "Bạn có chắc không", text = "Bạn sẽ không thể hoàn tác") {
    return Swal.fire({
        title,
        text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Hủy"
    })
}

function ajaxGet(url, query = {}){
    return $.ajax({
        method: "GET",
        url: url,
        data: query,
    });
}

function ajaxPost(url, data){
    return $.ajax({
        method: "POST",
        url: url,
        data: data
    });
}

function ajaxPostRaw(url, data){
    return $.ajax({
        method: "POST",
        url: url,
        data: data,
        headers: {
            "Content-Type": ""
        }
    });
}