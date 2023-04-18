<?php

return [

    // Stripe Key
    'enable_stripe' => env('STRIPE_SECRET_KEY', false) ? true : false,
    'stripe_secret_key' => env('STRIPE_SECRET_KEY', ''),
];
