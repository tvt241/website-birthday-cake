import authRoutes from "./routers/authRoutes";
import roleRouters from "./routers/roleRouters";
import userRouter from "./routers/userRouter";
import chatRouter from "./routers/chatRouter";

export default [
    ...authRoutes,
    ...roleRouters,
    ...userRouter,
    ...chatRouter
];