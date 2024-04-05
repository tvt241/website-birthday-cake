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
    error: function (title, text = "") {
        Swal.fire({
            icon: "error",
            title,
            text,
            showConfirmButton: false,
            timer: 1500
        })
    },
    confirmDelete: function (title) {
        return Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        })
    }
};
