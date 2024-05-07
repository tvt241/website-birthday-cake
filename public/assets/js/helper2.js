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

function toastOrder(text = "098765xxx1 đã mua hàng", title = "Cảm ơn"){
    Toast.fire({
        iconHtml: '<img height="70px" width="70px" style="max-width: unset; margin-left: 20px;" src="http://localhost:8000/storage/categories/phu-kien.jpg">',
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

function alertError(text = "Thất bại"){
    swalBs.fire({
        icon: "error",
        title: text,
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