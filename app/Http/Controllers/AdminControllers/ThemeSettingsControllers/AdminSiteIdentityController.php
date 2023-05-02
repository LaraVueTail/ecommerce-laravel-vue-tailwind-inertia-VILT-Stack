<?php

namespace App\Http\Controllers\AdminControllers\ThemeSettingsControllers;
use App\Http\Controllers\Controller;
use App\Models\SiteIdentity;
use App\Services\FileManagement;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AdminSiteIdentityController extends Controller
{

    public function edit()
    {
        $siteIdentity = SiteIdentity::first();
        return Inertia::render('AdminDashboard/ThemeSettings/SiteIdentity', [
            'siteIdentity'=>$siteIdentity
        ]);
    }
    
    public function update(SiteIdentity $siteIdentity,FileManagement $fileManagement)
    {
        $attributes = $this->validateSiteIdentity($siteIdentity);

        if($attributes['logoImage'] ?? false){
            $attributes['logoImage'] = 
            $fileManagement->uploadFile(
                file:$attributes['logoImage'] ?? false,
                deleteOldFile:true, 
                oldFile:$siteIdentity->logoImage,
                path:'images/logo'
            );   
        }

        $siteIdentity->update($attributes);

        return back()->with('success','Site Info Updated!');

    }

    protected function validateSiteIdentity(?SiteIdentity $siteIdentity = null): array
    {
        $siteIdentity ??= new SiteIdentity();

        return request()->validate([
            'siteName' => 'required|max:50',
            'siteDomain' => 'required|max:50',
            'siteEmail' => 'required|max:50',
            'siteOwnerName' => 'required|max:50',
            'siteOwnerEmail' => 'required|max:50',
            'logoImage' => [$siteIdentity->exists ? 'nullable' : 'required','mimes:jpg,jpeg,png','max:2096'],
            // 'enable_stripe' => 'required',
            // 'stripe_secret_key' => 'required',
            // 'currency'=> 'required',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ],[
            'logoImage.*' =>'Please Upload a jpg/png image with size less than 2MB!'
        ]);
    }

}
