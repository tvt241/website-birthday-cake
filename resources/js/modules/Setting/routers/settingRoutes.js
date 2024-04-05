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
                path: "business-setups",
                name: "settings.business_setup",
                component: SocialMedia,
                meta: {
                    title: ""
                }
            },
            {
                path: "pages-medias",
                children: [
                    {
                        path: "page-setups",
                        component: PageSetup,
                        children: [
                            {
                                path: "",
                                name: "settings.pages-media.page-setups",
                                redirect: {
                                    name: "settings.pages-media.page-setups.about_us"
                                },
                            },
                            {
                                path: "about-us",
                                name: "settings.pages-media.page-setups.about_us",
                                component: AboutUs,
                                meta: {
                                    title: "setting_about_us"
                                }
                            },
                            {
                                path: "terms-and-condition",
                                name: "settings.pages-media.page-setups.terms_and_condition",
                                component: TermsAndCondition,
                                meta: {
                                    title: "setting_mail"
                                }
                            },
                            {
                                path: "privacy-policy",
                                name: "settings.pages-media.page-setups.privacy_policy",
                                component: PrivacyPolicy,
                                meta: {
                                    title: "setting_privacy_policy"
                                }
                            },
                            {
                                path: "return-policy",
                                name: "settings.pages-media.page-setups.return_policy",
                                component: ReturnPolicy,
                                meta: {
                                    title: "setting_return_policy"
                                }
                            },
                            {
                                path: "refund-policy",
                                name: "settings.pages-media.page-setups.refund_policy",
                                component: RefundPolicy,
                                meta: {
                                    title: "setting_refund_policy"
                                }
                            },
                            {
                                path: "cancellation-policy",
                                name: "settings.pages-media.page-setups.cancellation_policy",
                                component: CancellationPolicy,
                                meta: {
                                    title: "setting_cancellation_policy"
                                }
                            },
                        ],
                    },
                    {
                        path: "social-medias",
                        name: "settings.social_media",
                        component: SocialMedia,
                        meta: {
                            title: "setting_social_media"
                        }
                    },
                ],
            },
            {
                path: "template-setups",
                name: "settings.template_setup",
                component: SocialMedia,
                meta: {
                    title: "setting_social_media"
                }
            },
            {
                path: "system-setups",
                component: SystemSetup,
                children: [
                    {
                        path: "",
                        name: "settings.system-setups",
                        redirect: {
                            name: "settings.system-setups.languages"
                        },
                    },
                    {
                        path: "languages",
                        name: "settings.system-setups.languages",
                        component: LanguageSettingComponent,
                        meta: {
                            title: "setting language"
                        }
                    },
                    {
                        path: "mail",
                        name: "settings.system-setups.mail",
                        component: MailSettingComponent,
                        meta: {
                            title: "setting mail"
                        }
                    },
                    {
                        path: "notification",
                        name: "settings.system-setups.notification",
                        component: NotificationSettingComponent,
                        meta: {
                            title: "setting notification"
                        }
                    },
                    {
                        path: "sms",
                        name: "settings.system-setups.sms",
                        component: SmsSettingComponent,
                    },
                ],
            }
        ],
    },
];
