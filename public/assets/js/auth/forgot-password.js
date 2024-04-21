import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import {
  getAuth,
  RecaptchaVerifier,
  signInWithPhoneNumber
} from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

const firebaseConfig = {
    apiKey: "AIzaSyDbeI_pIT6O2yULtWlqFCT_j1Kbc3ai8Ig",
};
const app = initializeApp(firebaseConfig);
window.auth = getAuth();
auth.languageCode = "vi";
window.recaptchaVerifier = new RecaptchaVerifier(auth, "recaptcha", {
    'size': 'invisible',
    'callback': (response) => {
        document.querySelector("input[name='recaptcha_token']").value = response;
        document.querySelector(".form-forgot-password").submit();
    }
});
window.signInWithPhoneNumber = signInWithPhoneNumber;
recaptchaVerifier.render();