import Swal from "sweetalert2";

export default {
    success: function (title) {
        Swal.fire({
            icon: "success",
            title,
            showConfirmButton: false,
            timer: 1500
        });
    },
    info: function (title) {
        Swal.fire({
            icon: "info",
            title,
            showConfirmButton: false,
            timer: 1500
        });
    },
    error: function (title, text = "") {
        Swal.fire({
            icon: "error",
            title,
            text,
            showConfirmButton: false,
            timer: 1500
        })
    },
    confirmDelete: function (title = "Bạn có chắc không", text = "Bạn sẽ không thể hoàn tác") {
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
};
