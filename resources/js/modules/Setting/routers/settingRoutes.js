import BusinessSetup from "../views/BusinessSetup.vue";

import SystemSetup from "../views/SystemSetup.vue";
import LanguageSettingComponent from "../views/system-setups/LanguageSettingComponent.vue";
import NotificationSettingComponent from "../views/system-setups/NotificationSettingComponent.vue";
import MailSettingComponent from "../views/system-setups/MailSettingComponent.vue";
import SmsSettingComponent from "../views/system-setups/SmsSettingComponent.vue";

import PageSetup from "../views/page-medias/PageSetup.vue";
import AboutUs from "../views/page-medias/page-setups/AboutUs.vue";
import TermsAndCondition from "../views/page-medias/page-setups/TermsAndCondition.vue";
import PrivacyPolicy from "../views/page-medias/page-setups/PrivacyPolicy.vue";
import ReturnPolicy from "../views/page-medias/page-setups/ReturnPolicy.vue";
import RefundPolicy from "../views/page-medias/page-setups/RefundPolicy.vue";
import CancellationPolicy from "../views/page-medias/page-setups/CancellationPolicy.vue";

import SocialMedia from "../views/page-medias/SocialMedia.vue";

export default [
    {
        path: "/settings",
        children: [
            {
                path: "system-setups",
                component: SystemSetup,
                children: [
                    {
                        path: "",
                        name: "admin.settings.system-setups",
                        redirect: {
                            name: "admin.settings.system-setups.languages"
                        },
                    },
                    {
                        path: "languages",
                        name: "admin.settings.system-setups.languages",
                        component: LanguageSettingComponent,
                        meta: {
                            title: "setting language"
                        }
                    },
                    {
                        path: "mail",
                        name: "admin.settings.system-setups.mail",
                        component: MailSettingComponent,
                        meta: {
                            title: "setting mail"
                        }
                    },
                    {
                        path: "notification",
                        name: "admin.settings.system-setups.notification",
                        component: NotificationSettingComponent,
                        meta: {
                            title: "setting notification"
                        }
                    },
                    {
                        path: "sms",
                        name: "admin.settings.system-setups.sms",
                        component: SmsSettingComponent,
                    },
                ],
            },
            {
                path: "page-setups",
                component: PageSetup,
                children: [
                    {
                        path: "",
                        name: "admin.settings.page-setups",
                        redirect: {
                            name: "admin.settings.page-setups.about_us"
                        },
                    },
                    {
                        path: "about-us",
                        name: "admin.settings.page-setups.about_us",
                        component: AboutUs,
                        meta: {
                            title: "setting_about_us"
                        }
                    },
                    {
                        path: "terms-and-condition",
                        name: "admin.settings.page-setups.terms_and_condition",
                        component: TermsAndCondition,
                        meta: {
                            title: "setting_mail"
                        }
                    },
                    {
                        path: "privacy-policy",
                        name: "admin.settings.page-setups.privacy_policy",
                        component: PrivacyPolicy,
                        meta: {
                            title: "setting_privacy_policy"
                        }
                    },
                    {
                        path: "return-policy",
                        name: "admin.settings.page-setups.return_policy",
                        component: ReturnPolicy,
                        meta: {
                            title: "setting_return_policy"
                        }
                    },
                    {
                        path: "refund-policy",
                        name: "admin.settings.page-setups.refund_policy",
                        component: RefundPolicy,
                        meta: {
                            title: "setting_refund_policy"
                        }
                    },
                    {
                        path: "cancellation-policy",
                        name: "admin.settings.page-setups.cancellation_policy",
                        component: CancellationPolicy,
                        meta: {
                            title: "setting_cancellation_policy"
                        }
                    },
                ],
            },
            {
                path: "social-media",
                name: "admin.settings.social_media",
                component: SocialMedia,
                meta: {
                    title: "setting_social_media"
                }
            }
        ],
    },
];
