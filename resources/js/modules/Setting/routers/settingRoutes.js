import BusinessSetup from "../views/BusinessSetup.vue";
import BusinessSetupChild from "../views/business-setups/BusinessSetup.vue";
import BranchSetup from "../views/business-setups/BranchSetup.vue";
import NotificationSetup from "../views/business-setups/NotificationSetup.vue";


import SystemSetup from "../views/SystemSetup.vue";
// import LanguageSettingComponent from "../views/system-setups/LanguageSettingComponent.vue";
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
                component: BusinessSetup,
                children: [
                    {
                        path: "",
                        redirect: {
                            name: "settings.business_setup.page_setup"
                        },
                    },
                    {
                        path: "page-setup",
                        component: BusinessSetupChild,
                        name: "settings.business_setup.page_setup"
                    },
                    {
                        path: "branch-setup",
                        component: BranchSetup,
                        name: "settings.business_setup.branch_setup"
                    },
                    {
                        path: "notification-setup",
                        component: NotificationSetup,
                        name: "settings.business_setup.notification_setup"
                    }
                ],
            },
            {
                path: "page-medias",
                children: [
                    {
                        path: "page-setups",
                        component: PageSetup,
                        children: [
                            {
                                path: "",
                                name: "settings.page_medias.page_setups",
                                redirect: {
                                    name: "settings.page_medias.page_setups.about_us"
                                },
                            },
                            {
                                path: "about-us",
                                name: "settings.page_medias.page_setups.about_us",
                                component: AboutUs,
                            },
                            {
                                path: "terms-and-condition",
                                name: "settings.page_medias.page_setups.terms_and_condition",
                                component: TermsAndCondition,
                            },
                            {
                                path: "privacy-policy",
                                name: "settings.page_medias.page_setups.privacy_policy",
                                component: PrivacyPolicy,
                            },
                            {
                                path: "return-policy",
                                name: "settings.page_medias.page_setups.return_policy",
                                component: ReturnPolicy,
                            },
                            {
                                path: "refund-policy",
                                name: "settings.page_medias.page_setups.refund_policy",
                                component: RefundPolicy,
                            },
                            {
                                path: "cancellation-policy",
                                name: "settings.page_medias.page_setups.cancellation_policy",
                                component: CancellationPolicy,
                            },
                        ],
                    },
                    {
                        path: "social-medias",
                        name: "settings.social_media",
                        component: SocialMedia,
                    },
                ],
            },
            {
                path: "template-setups",
                name: "settings.template_setups",
                component: SocialMedia,
            },
            {
                path: "system-setups",
                component: SystemSetup,
                children: [
                    {
                        path: "",
                        name: "settings.system_setups",
                        redirect: {
                            name: "settings.system_setups.mail"
                        },
                    },
                    // {
                    //     path: "languages",
                    //     name: "settings.system-setups.languages",
                    //     component: LanguageSettingComponent,
                    //     meta: {
                    //         title: "setting language"
                    //     }
                    // },
                    {
                        path: "mail",
                        name: "settings.system_setups.mail",
                        component: MailSettingComponent,
                    },
                    {
                        path: "notification",
                        name: "settings.system_setups.notification",
                        component: NotificationSettingComponent,
                    },
                    {
                        path: "sms",
                        name: "settings.system_setups.sms",
                        component: SmsSettingComponent,
                    },
                ],
            }
        ],
    },
];
