import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import {
  getAuth,
  RecaptchaVerifier,
} from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

const firebaseConfig = {
    apiKey: "AIzaSyCjfpBKktE3Yz0jtluTCCkSAImiF-1iDHE",
};
const app = initializeApp(firebaseConfig);
const auth = getAuth();
auth.languageCode = "vi";
window.recaptchaVerifier = new RecaptchaVerifier(auth, "recaptcha", {
    'size': 'invisible',
    'callback': (response) => {
        const url = $("#re_send_otp_url").val();
        const username = $("input[name='username']").val();
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                "username": username,
                "recaptcha_token": response
            },
            success:function(res){
                handleSuccess(res.message);
            },
            error:function(e){
                $(".success-message").html(e.responseJSON.message);
                $(".error-message").html("");
            }
        });
    }
});
recaptchaVerifier.render();