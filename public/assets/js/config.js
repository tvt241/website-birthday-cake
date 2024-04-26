$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    beforeSend: function(xhr) {
        $(".loader").show();
        $("#preloder").show();
    },
    complete : function(xhr){
        $(".loader").hide();
        $("#preloder").hide();
    }
});

function showNotification(message) {
    if (!("Notification" in window)) {
        toastError("Trình duyệt của bạn không hỗ trợ thông báo");
    } 
    else if (Notification.permission === "granted") {
        new Notification(message);
    } 
    else if (Notification.permission !== "denied") {
        Notification.requestPermission().then((permission) => {
            if (permission === "granted") {
                new Notification(message);
            }
        });
    }
}

window.Pusher = Pusher;
// Pusher.logToConsole = true;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "8eb4d4fe9728617074f6",
    cluster: "ap1",
    forceTLS: 'https',
});

Echo.channel(`notifications`)
    .listen('.notifications', (e) => {
        toastOrder(e.message);
    });

// Echo.channel(`private-notifications`)
//     .listen('.notifications', (e) => {
//         console.log("private");
//         console.log(e);
// });

// Echo.join(`chats`)
//     .here((users) => {
//         console.log(users);
//     })
//     .joining((user) => {
//         console.log(user);
//     })
//     .leaving((user) => {
//         console.log(user);
//     })
//     .error((error) => {
//         console.error(error);
//     });