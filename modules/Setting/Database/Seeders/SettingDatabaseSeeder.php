<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Models\BusinessSetting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                "name" => "company",
                "setting"=> [
                    ["key" => "company_name", "value" => "Bánh sinh nhật việt"],
                    ["key" => "company_email", "value" => "banhsinhnhatviet@gmail.com"],
                    ["key" => "company_phone", "value" => "0987654321"],
                    ["key" => "company_address", "value" => " Hà Nội"],
                    ["key" => "company_latitude", "value" => "123434"],
                    ["key" => "company_longitude", "value" => "65423"],
                ],
            ],
            [
                "name" => "theme",
                "setting"=> [
                    ["key" => "theme_logo", "value" => ""],
                    ["key" => "theme_favicon_logo", "value" => ""],
                    ["key" => "theme_footer_logo", "value" => "0987654321"],
                    ["key" => "company_address", "value" => " Hà Nội"],
                    ["key" => "company_latitude", "value" => "123434"],
                    ["key" => "company_longitude", "value" => "65423"],
                ],
            ],
            [
                "name" => "site",
                "setting"=> [
                    ["key" => "site_about_us", "value" => ""],
                    ["key" => "site_privacy_policy", "value" => ""],
                    ["key" => "site_terms_and_condition", "value" => "0987654321"],
                    ["key" => "site_cancellation_policy", "value" => " Hà Nội"],
                    ["key" => "site_refund_policy", "value" => "123434"],
                    ["key" => "site_return_policy", "value" => "65423"],
                ],
            ],
            [
                "name" => "social_media",
                "setting"=> [
                    ["key" => "social_media_facebook", "value" => ""],
                    ["key" => "social_media_youtube", "value" => ""],
                    ["key" => "social_media_instagram", "value" => "0987654321"],
                    ["key" => "social_media_twitter", "value" => " Hà Nội"],
                ],
            ],
            [
                "name" => "mail",
                "setting"=> [
                    ["key" => "mail_services", "value" => json_encode(["stmp"])],
                    ["key" => "mail_using", "value" => "stmp"],
                ],
            ],
            [
                "name" => "notification",
                "setting"=> [
                    ["key" => "notification_services", "value" => json_encode(["pusher", "firebase"])],
                    ["key" => "notification_using", "value" => "pusher"],
                ],
            ],
            [
                "name" => "sms",
                "setting"=> [
                    ["key" => "sms_services", "value" => json_encode(["firebase", "stringee", "twilio"])],
                ],
            ],
            [
                "name" => "services",
                "setting"=> [
                    [
                        "key" => "pusher", 
                        "value" => json_encode([
                            "pusher_app_id" => 123,
                            "pusher_app_key" => 123,
                            "pusher_app_secret" => 123,
                            "pusher_host" => 123,
                            "pusher_schema" => 123,
                            "pusher_app_cluster" => 123,
                        ])
                    ],
                    [
                        "key" => "firebase",
                        "value" => json_encode([
                            "pusher_app_id" => 123,
                            "pusher_app_key" => 123,
                            "pusher_app_secret" => 123,
                            "pusher_host" => 123,
                            "pusher_schema" => 123,
                            "pusher_app_cluster" => 123,
                        ])
                    ],
                    [
                        "key" => "stmp",
                        "value" => json_encode([
                            "mail_host" => 123,
                            "mail_port" => 123,
                            "mail_username" => 123,
                            "mail_password" => 123,
                            "mail_encryption" => 123,
                            "mail_from_name" => 123,
                            "mail_from_email" => 123,
                        ])
                    ],
                    [
                        "key" => "vnpay",
                        "value" => json_encode([
                            "mail_host" => 123,
                            "mail_port" => 123,
                            "mail_username" => 123,
                            "mail_password" => 123,
                            "mail_encryption" => 123,
                            "mail_from_name" => 123,
                            "mail_from_email" => 123,
                        ])
                    ],
                    [
                        "key" => "giao hàng nhanh",
                        "value" => json_encode([
                            "mail_host" => 123,
                            "mail_port" => 123,
                            "mail_username" => 123,
                            "mail_password" => 123,
                            "mail_encryption" => 123,
                            "mail_from_name" => 123,
                            "mail_from_email" => 123,
                        ])
                    ]

                ]
            ],
        ];
        BusinessSetting::insert();
    }
}
