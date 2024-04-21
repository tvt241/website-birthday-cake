let timeDefault = 60;
let timeCountDown = timeDefault;
let flag = true;
let countDown;

$(document).ready(function () {
    let now = new Date();
    let timeUpdate = new Date(document.querySelector("#time_send_verify_old").value);
    let diff = ((now - timeUpdate) / 1000).toFixed();
    timeCountDown = diff > timeDefault ? 1 : timeDefault - diff;
    if(timeCountDown === 1){
        $(".view-resend-otp").show();
        $(".view-count-down").hide();
    }
    startCountdown();
});


function startCountdown() {
    $(".view-count-down span").html(timeCountDown);
    countDown = setInterval(updateCountdown, 1000);
}

function updateCountdown() {
    $(".view-count-down span").html(timeCountDown);
    timeCountDown--;
    if (timeCountDown <= 0) {
        clearInterval(countDown);
        flag = false;
        $(".view-resend-otp").show();
        $(".view-count-down").hide();
    }
}

$(document).on("click", ".view-resend-otp a", function (e) {
    recaptchaVerifier.recaptcha.execute();
});

function handleSuccess(message){
    if (!flag) {
        timeCountDown = timeDefault;
        flag = true;
        startCountdown();
    }
    $(".view-resend-otp").hide();
    $(".view-count-down").show();
    $(".success-message").html(message);
    $(".error-message").html("");
}