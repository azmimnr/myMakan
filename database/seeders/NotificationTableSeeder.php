<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\NotificationSetting;
use Dipokhalder\EnvEditor\EnvEditor;
use Dipokhalder\Settings\Facades\Settings;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $envService = new EnvEditor();
        Settings::group('notification')->set([
            'notification_fcm_public_vapid_key'    => $envService->getValue('DEMO') ? 'YOUR_FIREBASE_PUBLIC_VAPID_KEY' : '',
            'notification_fcm_api_key'             => $envService->getValue('DEMO') ? 'YOUR_FIREBASE_API_KEY' : '',
            'notification_fcm_auth_domain'         => $envService->getValue('DEMO') ? 'YOUR_FIREBASE_AUTH_DOMAIN' : '',
            'notification_fcm_project_id'          => $envService->getValue('DEMO') ? 'YOUR_FIREBASE_PROJECT_ID' : '',
            'notification_fcm_storage_bucket'      => $envService->getValue('DEMO') ? 'YOUR_FIREBASE_STORAGE_BUCKET' : '',
            'notification_fcm_messaging_sender_id' => $envService->getValue('DEMO') ? 'YOUR_FIREBASE_MESSAGING_SENDER_ID' : '',
            'notification_fcm_app_id'              => $envService->getValue('DEMO') ? 'YOUR_FIREBASE_APP_ID' : '',
            'notification_fcm_measurement_id'      => $envService->getValue('DEMO') ? 'YOUR_FIREBASE_MEASUREMENT_ID' : '',
            'notification_fcm_json_file'           => '',
        ]);

        if ($envService->getValue('DEMO') && file_exists(public_path('/file/service-account-file.json'))) {
            $setting = NotificationSetting::where('key', 'notification_fcm_json_file')->first();
            $setting->addMedia(public_path('/file/service-account-file.json'))->preservingOriginal()->usingFileName('service-account-file.json')->toMediaCollection('notification-file');
        }
    }
}
