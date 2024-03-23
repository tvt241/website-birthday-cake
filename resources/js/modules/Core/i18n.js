import { createI18n } from "vue-i18n";
// import datetimeFormats from "./lang/dateTimeFormat";

const loadMessages = () => {
    const messages = {};
    const langs = import.meta.glob("./lang/*.json", { eager: true });
    for (const path in langs) {
        const key = path.split("/")[2].slice(0, -5);
        messages[key] = { ...langs[path] };
    }
    return { messages };
};
const { messages } = loadMessages();

const i18n = createI18n({
    locale: "vi",
    fallbackLocale: "vi",
    messages,
});

export default i18n;
