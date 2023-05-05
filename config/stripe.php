<?php

return [

    // Stripe Key ans Webhook secret
    'stripe_secret_key' => env('STRIPE_SECRET_KEY', ''),
    'stripe_webhook_secret' => env('STRIPE_WEBHOOK_SECRET', ''),
];