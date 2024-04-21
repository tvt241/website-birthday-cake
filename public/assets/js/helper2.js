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

function alertConfirm(text, text_delete = "Có", ){
    return swalBs.fire({
        title:"Bạn có muốn",
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: text_delete,
        cancelButtonText: text_delete,
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