import { app } from "~/Core/app"
import router from "./routers/route";

app.use(router);
app.mount('#app');
