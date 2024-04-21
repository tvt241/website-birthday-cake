import authRoutes from "./routers/authRoutes";
import roleRouters from "./routers/roleRouters";
import userRouter from "./routers/userRouter";

export default [
    ...authRoutes,
    ...roleRouters,
    ...userRouter
];