<?php

namespace App\Http\Controllers\AdminControllers\ThemeSettingsControllers;
use App\Http\Controllers\Controller;
use App\Models\ThemeSettings\SiteIdentity;
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
    
    public function update(FileManagement $fileManagement)
    {
        $siteIdentity = SiteIdentity::first();

        $attributes = $this->validateSiteIdentity($siteIdentity);

        if($attributes['logo_image'] ?? false){
            $attributes['logo_image'] = 
            $fileManagement->uploadFile(
                file:$attributes['logo_image'] ?? false,
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
            'site_name' => 'required|max:50',
            'site_domain' => 'required|max:50',
            'site_email' => 'required|max:50',
            'site_owner_name' => 'required|max:50',
            'site_owner_email' => 'required|max:50',
            'logo_image' => [$siteIdentity->exists ? 'nullable' : 'required','mimes:jpg,jpeg,png','max:2096'],
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ],[
            'logo_image' =>'Please Upload a jpg/png image with size less than 2MB!'
        ]);
    }

}
