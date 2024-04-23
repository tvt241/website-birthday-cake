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
        $data = [
            ["group" => "company", "key" => "name", "value" => "Tiệm bánh kem Hương vị Việt"],
            ["group" => "company", "key" => "email", "value" => "tiembanhkemhuongviviet@gmail.com"],
            ["group" => "company", "key" => "phone", "value" => "0919677164"],
            ["group" => "company", "key" => "address", "value" => "Số 49, Ngõ 93, Vương Thừa Vũ, Khương Trung, Thanh Xuân, Hà Nội"],
            ["group" => "company", "key" => "latitude", "value" => "26.6389992"],
            ["group" => "company", "key" => "longitude", "value" => "101.1926887"],
            ["group" => "company", "key" => "zoom", "value" => "17"],
            ["group" => "company", "key" => "logo", "value" => "http://localhost:8000/storage/setup/logo.png"],
            ["group" => "company", "key" => "fav_icon", "value" => "http://localhost:8000/storage/setup/logo.png"],

            ["group" => "site", "key" => "about_us", "value" => "Chúng tôi là "],
            ["group" => "site", "key" => "privacy_policy", "value" => "abc"],
            ["group" => "site", "key" => "terms_and_condition", "value" => "abc"],
            ["group" => "site", "key" => "cancellation_policy", "value" => "abc"],
            ["group" => "site", "key" => "refund_policy", "value" => "abc"],
            ["group" => "site", "key" => "return_policy", "value" => "abc"],

            ["group" => "social_media", "key" => "zalo", "value" => "abc"],
            ["group" => "social_media", "key" => "facebook", "value" => "Chúng tôi là "],
            ["group" => "social_media", "key" => "messager", "value" => "abc"],
            ["group" => "social_media", "key" => "instagram", "value" => "abc"],
            ["group" => "social_media", "key" => "twitter", "value" => "abc"],

            ["group" => "mail", "key" => "services", "value" => "stmp"],
            ["group" => "mail", "key" => "using", "value" => "stmp"],

            ["group" => "notification", "key" => "services", "value" => "pusher,firebase"],
            ["group" => "notification", "key" => "using", "value" => "pusher"],

            ["group" => "sms", "key" => "services", "value" => "firebase,stringee,twilio"],
            ["group" => "sms", "key" => "using", "value" => "firebase"],

            [
                "group" => "services", 
                "key" => "stmp", 
                "value" => json_encode([
                    "mail_host" => "smtp.gmail.com", 
                    "mail_port" => "587", 
                    "mail_username" => "tuoilinksok@gmail.com", 
                    "mail_password" => "yxymmnvbkjqdlfhh", 
                    "mail_encryption" => "tls",
                    "mail_from_name" => "tvt.thuan241@gmail.com", 
                    "mail_from_email" => "Tiệm bánh kem Hương vị Việt"
                ])
            ],

            [
                "group" => "services", 
                "key" => "pusher", 
                "value" => json_encode([
                    "pusher_app_id" => "1789956",
                    "pusher_app_key" => "8eb4d4fe9728617074f6",
                    "pusher_app_secret" => "b66c49e18ee6a87c5687",
                    "pusher_host" => "",
                    "pusher_port" => "443",
                    "pusher_schema" => "https",
                    "pusher_app_cluster" => "ap1",
                ])
            ],

            [
                "group" => "services", 
                "key" => "firebase", 
                "value" => json_encode([
                    "api_key" => "AIzaSyDbeI_pIT6O2yULtWlqFCT_j1Kbc3ai8Ig",
                    "auth_domain" => "shop-391205.firebaseapp.com",
                    "database_url" => "https://shop-391205-default-rtdb.asia-southeast1.firebasedatabase.app",
                    "project_id" => "shop-391205",
                    "storage_bucket" => "shop-391205.appspot.com",
                    "messaging_sender_id" => "227858009033",
                    "app_id" => "1:227858009033:web:00c14b9d19e20df3fe7618"
                ])
            ],

            [
                "group" => "services", 
                "key" => "VNPAY", 
                "value" => json_encode([
                    "url" => "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html",
                    "hash_secret" => "LJWXVAIGPCSWAJCIJNIDMQOFSVEMWSTS",
                    "tmn_code" => "9VPAP1AM",
                ])
            ],

            [
                "group" => "services", 
                "key" => "ghn", 
                "value" => json_encode([
                    "token" => "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html",
                    "shop_id" => "LJWXVAIGPCSWAJCIJNIDMQOFSVEMWSTS",
                    "phone" => "9VPAP1AM",
                    "address" => "Số 49, Ngõ 93, Vương Thừa Vũ",
                    "ward_name" => "Phường Khương Trung",
                    "ward_code" => "1A0704",
                    "district_name" => "Quận Thanh Xuân",
                    "district_code" => "1493",
                    "provice_name" => "Hà Nội",
                    "provice_code" => "201"
                ])
            ],

        ];

        BusinessSetting::insert($data);
    }
}
