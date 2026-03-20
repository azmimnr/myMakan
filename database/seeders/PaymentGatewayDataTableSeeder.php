<?php

namespace Database\Seeders;

use App\Enums\GatewayMode;
use App\Enums\Activity;
use App\Models\GatewayOption;
use App\Models\PaymentGateway;
use Dipokhalder\EnvEditor\EnvEditor;
use Illuminate\Database\Seeder;

class PaymentGatewayDataTableSeeder extends Seeder
{

    public array $gateways = [
        [
            "slug" => "paypal",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'paypal_app_id',
                    "value" => 'demo-paypal-app-id',
                ],
                [
                    "option" => 'paypal_client_id',
                    "value" => 'demo-paypal-client-id'
                ],
                [
                    "option" => 'paypal_client_secret',
                    "value" => 'demo-paypal-client-secret'
                ],
                [
                    "option" => 'paypal_mode',
                    "value" => GatewayMode::SANDBOX
                ],
                [
                    "option" => 'paypal_status',
                    "value" => Activity::ENABLE
                ],
            ]
        ],
        [
            "slug" => "stripe",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'stripe_key',
                    "value" => 'demo-stripe-public-key',
                ],
                [
                    "option" => 'stripe_secret',
                    "value" => 'demo-stripe-secret-key',
                ],
                [
                    "option" => 'stripe_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'stripe_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "flutterwave",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'flutterwave_public_key',
                    "value" => 'demo-flutterwave-public-key',
                ],
                [
                    "option" => 'flutterwave_secret_key',
                    "value" => 'demo-flutterwave-secret-key',
                ],
                [
                    "option" => 'flutterwave_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'flutterwave_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "paystack",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'paystack_public_key',
                    "value" => 'demo-paystack-public-key',
                ],
                [
                    "option" => 'paystack_secret_key',
                    "value" => 'demo-paystack-secret-key',
                ],
                [
                    "option" => 'paystack_payment_url',
                    "value" => 'https://api.paystack.co',
                ],
                [
                    "option" => 'paystack_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'paystack_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "sslcommerz",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'sslcommerz_store_name',
                    "value" => 'demo-sslcommerz-store-name',
                ],
                [
                    "option" => 'sslcommerz_store_id',
                    "value" => 'demo-sslcommerz-store-id',
                ],
                [
                    "option" => 'sslcommerz_store_password',
                    "value" => 'demo-sslcommerz-store-password',
                ],
                [
                    "option" => 'sslcommerz_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'sslcommerz_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "mollie",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'mollie_api_key',
                    "value" => 'demo-mollie-api-key',
                ],
                [
                    "option" => 'mollie_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'mollie_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "senangpay",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'senangpay_merchant_id',
                    "value" => 'demo-senangpay-merchant-id',
                ],
                [
                    "option" => 'senangpay_secret_key',
                    "value" => 'demo-senangpay-secret-key',
                ],
                [
                    "option" => 'senangpay_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'senangpay_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "bkash",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'bkash_app_key',
                    "value" => 'demo-bkash-app-key',
                ],
                [
                    "option" => 'bkash_app_secret',
                    "value" => 'demo-bkash-app-secret',
                ],
                [
                    "option" => 'bkash_username',
                    "value" => 'sandboxTokenizedUser02'
                ],
                [
                    "option" => 'bkash_password',
                    "value" => 'sandboxTokenizedUser02@12345'
                ],
                [
                    "option" => 'bkash_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'bkash_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "paytm",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'paytm_merchant_id',
                    "value" => 'demo-paytm-merchant-id',
                ],
                [
                    "option" => 'paytm_merchant_key',
                    "value" => 'demo-paytm-merchant-key',
                ],
                [
                    "option" => 'paytm_merchant_website',
                    "value" => 'WEBSTAGING',
                ],
                [
                    "option" => 'paytm_channel',
                    "value" => 'WEB',
                ],
                [
                    "option" => 'paytm_industry_type',
                    "value" => 'Retail',
                ],
                [
                    "option" => 'paytm_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'paytm_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "razorpay",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'razorpay_key',
                    "value" => 'demo-razorpay-key',
                ],
                [
                    "option" => 'razorpay_secret',
                    "value" => 'demo-razorpay-secret',
                ],
                [
                    "option" => 'razorpay_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'razorpay_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "mercadopago",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'mercadopago_client_id',
                    "value" => 'demo-mercadopago-client-id',
                ],
                [
                    "option" => 'mercadopago_client_secret',
                    "value" => 'demo-mercadopago-client-secret',
                ],
                [
                    "option" => 'mercadopago_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'mercadopago_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "cashfree",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'cashfree_app_id',
                    "value" => 'demo-cashfree-app-id',
                ],
                [
                    "option" => 'cashfree_secret_key',
                    "value" => 'demo-cashfree-secret-key',
                ],
                [
                    "option" => 'cashfree_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'cashfree_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "payfast",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'payfast_merchant_id',
                    "value" => '10004002',
                ],
                [
                    "option" => 'payfast_merchant_key',
                    "value" => 'demo-payfast-merchant-key',
                ],
                [
                    "option" => 'payfast_passphrase',
                    "value" => 'payfast',
                ],
                [
                    "option" => 'payfast_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'payfast_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "skrill",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'skrill_merchant_email',
                    "value" => 'demoqco@sun-fish.com',
                ],
                [
                    "option" => 'skrill_merchant_api_password',
                    "value" => 'demo-skrill-api-password',
                ],
                [
                    "option" => 'skrill_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'skrill_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "phonepe",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'phonepe_client_id',
                    "value" => 'PGTESTPAYUAT',
                ],
                [
                    "option" => 'phonepe_merchant_user_id',
                    "value" => 'MUID123',
                ],
                [
                    "option" => 'phonepe_key_index',
                    "value" => '1',
                ],
                [
                    "option" => 'phonepe_secret_key',
                    "value" => 'demo-phonepe-secret-key',
                ],
                [
                    "option" => 'phonepe_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'phonepe_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "pesapal",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'pesapal_consumer_key',
                    "value" => 'demo-pesapal-consumer-key',
                ],
                [
                    "option" => 'pesapal_consumer_secret',
                    "value" => 'demo-pesapal-consumer-secret',
                ],
                [
                    "option" => 'pesapal_ipn_id',
                    "value" => '928cdd37-c730-488b-aa81-dd4f101d1783',
                ],
                [
                    "option" => 'pesapal_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'pesapal_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "telr",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'telr_store_id',
                    "value" => 'sandbox_store_id',
                ],
                [
                    "option" => 'telr_store_auth_key',
                    "value" => 'sandbox_auth_key',
                ],
                [
                    "option" => 'telr_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'telr_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "iyzico",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'iyzico_api_key',
                    "value" => 'demo-iyzico-api-key',
                ],
                [
                    "option" => 'iyzico_secret_key',
                    "value" => 'demo-iyzico-secret-key',
                ],
                [
                    "option" => 'iyzico_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'iyzico_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "pesapal",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'pesapal_consumer_key',
                    "value" => 'demo-pesapal-consumer-key',
                ],
                [
                    "option" => 'pesapal_consumer_secret',
                    "value" => 'demo-pesapal-consumer-secret',
                ],
                [
                    "option" => 'pesapal_ipn_id',
                    "value" => '928cdd37-c730-488b-aa81-dd4f101d1783',
                ],
                [
                    "option" => 'pesapal_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'pesapal_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "midtrans",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'midtrans_server_key',
                    "value" => 'demo-midtrans-server-key',
                ],
                [
                    "option" => 'midtrans_client_key',
                    "value" => 'demo-midtrans-client-key',
                ],
                [
                    "option" => 'midtrans_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'midtrans_status',
                    "value" => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "myfatoorah",
            "status" => Activity::ENABLE,
            "options" => [

                [
                    "option" => 'myfatoorah_api_key',
                    "value"  => 'demo-myfatoorah-api-key',
                ],
                [
                    "option" => 'myfatoorah_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'myfatoorah_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "easypaisa",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option"     => 'easypaisa_store_id',
                    "value"      => '641',
                ],
                [
                    "option"     => 'easypaisa_hash_key',
                    "value"      => "demo-easypaisa-hash-key",
                ],
                [
                    "option" => 'easypaisa_username',
                    "value"  => "pg-systems",

                ],
                [
                    "option" => 'easypaisa_password',
                    "value"  => "demo-easypaisa-password",

                ],
                [
                    "option"     => 'easypaisa_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option"     => 'easypaisa_status',
                    "value"      => Activity::ENABLE,
                ],
            ]
        ]
    ];

    public function run(): void
    {
        $envService = new EnvEditor();
        if ($envService->getValue('DEMO')) {
            foreach ($this->gateways as $gateway) {
                $payment = PaymentGateway::where(['slug' => $gateway['slug']])->first();
                if ($payment) {
                    $payment->status = $gateway['status'];
                    $payment->save();
                }
                $this->gatewayOption($gateway['options']);
            }
        }
    }

    public function gatewayOption($options): void
    {
        if (!blank($options)) {
            foreach ($options as $option) {
                $gatewayOption = GatewayOption::where(['option' => $option['option']])->first();
                if ($gatewayOption) {
                    $gatewayOption->value = $option['value'];
                    $gatewayOption->save();
                }
            }
        }
    }
}
