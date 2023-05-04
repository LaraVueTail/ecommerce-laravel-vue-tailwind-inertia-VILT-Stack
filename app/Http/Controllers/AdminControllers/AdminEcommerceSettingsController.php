<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\EcommerceSettings;
use Inertia\Inertia;

class AdminEcommerceSettingsController extends Controller
{

    public function edit()
    {
        $ecommerceSettings =EcommerceSettings::first();
        return Inertia::render('AdminDashboard/EcommerceSettings/EcommerceSettings', [
            'ecommerceSettings'=>$ecommerceSettings
        ]);
    }
    
    public function update()
    {
        $ecommerceSettings =EcommerceSettings::first();
        $attributes = $this->validateEcommerceSettings($ecommerceSettings);
        $ecommerceSettings->update($attributes);

        return back()->with('success','E-Commerce Settings Updated!');

    }

    protected function validateEcommerceSettings(?EcommerceSettings $ecommerceSettings = null): array
    {
        $ecommerceSettings ??= new EcommerceSettings();

        return request()->validate([
            'enable_stripe' => 'required',
            'stripe_secret_key' => 'required',
            'enable_whatsapp' => 'required',
            'whatsapp_number' => 'required',
            'currency'=> 'required',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ]);
    }

}
