import { useToast } from "vue-toastification";

export default {
    showNotification: function(message, config = {}) {
        if (!("Notification" in window)) {
            error("Trình duyệt của bạn không hỗ trợ thông báo");
        } 
        else if (Notification.permission === "granted") {
            new Notification(message, config);
        } 
        else if (Notification.permission !== "denied") {
            Notification.requestPermission().then((permission) => {
                if (permission === "granted") {
                    new Notification(message, config);
                }
            });
        }
    },
    default: function (message = "Default", position = "top-right") {
        const toast = useToast();
        toast(message, {
            position: position,
        });
    },

    success: function (message = "Success", position = "top-right") {
        const toast = useToast();
        toast.success(message, {
            position: position,
        });
    },

    info: function (message = "abc", position = "top-right") {
        const toast = useToast();
        toast.info(message, {
            position: position,
        });
    },

    warning: function (message = "Warning", position = "top-right") {
        const toast = useToast();
        toast.warning(message, {
            position: position,
        });
    },

    error: function (message = "Error", position = "top-right") {
        const toast = useToast();
        toast.error(message, {
            position: position,
        });
    },

    successFlip: function (
        status = null,
        message = "",
        position = "top-right"
    ) {
        const toast = useToast();
        if (status != null) {
            if (status) {
                message = message + " Updated Successfully.";
            } else {
                message = message + " Created Successfully.";
            }
        } else {
            message = message + " Deleted Successfully.";
        }

        toast.success(message, {
            position: position,
        });
    },

    successInfo: function (
        status = null,
        message = "",
        position = "top-right"
    ) {
        const toast = useToast();
        toast.success(message, {
            position: position,
        });
    },
};
