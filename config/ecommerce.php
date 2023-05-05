<?php

return [

    // Stripe Key
    'currency' => env('CURRENCY'),
    'enable_stripe' => env('STRIPE_SECRET_KEY', false) ? true : false,
    'enable_whatsapp' => env('WHATSAPP_NUMBER', false) ? true : false,
    'whatsapp_number' => env('WHATSAPP_NUMBER', ''),
];
