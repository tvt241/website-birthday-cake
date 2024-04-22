import orderRouter from "./routers/orderRouter";
import posRouter from "./routers/posRouter";

export default [
    ...orderRouter,
    ...posRouter
];