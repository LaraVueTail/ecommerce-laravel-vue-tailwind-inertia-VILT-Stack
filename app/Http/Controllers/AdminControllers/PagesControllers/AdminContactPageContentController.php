<?php

namespace App\Http\Controllers\AdminControllers\PagesControllers;
use App\Http\Controllers\Controller;
use App\Models\Pages\ContactPageContent;
use App\Services\FileManagement;
use Inertia\Inertia;

class AdminContactPageContentController extends Controller
{
    public function edit()
    {
        $contactPageContent = ContactPageContent::first();
        return Inertia::render('AdminDashboard/Pages/ContactPageEdit', [
            'contactPageContent' => $contactPageContent,
        ]);
    }
    
    public function update(FileManagement $fileManagement)
    {
        $contactPageContent = ContactPageContent::first();
        $attributes = $this->validateContactPageContent($contactPageContent);  
        if($attributes['contact_image'] ?? false){
                $attributes['contact_image'] = 
                $fileManagement->uploadFile(
                    file:$attributes['contact_image'] ?? false,
                    deleteOldFile:true, 
                    oldFile:$contactPageContent->contactImage,
                    path:'images/contact-page'
                );    
        }

        $contactPageContent->update($attributes);

        return back()->with('success','Contact Page Updated!');

    }

    protected function validateContactPageContent(?ContactPageContent $contactPageContent = null): array
    {
        $contactPageContent ??= new ContactPageContent();

        return request()->validate([
            'contact_heading' => 'required|max:50',
            'contact_sub_heading' => 'required|max:1000',
            'contact_text' => 'required|max:1000',
            'contact_phone_numbers' => 'required|max:50',
            'contact_email' => 'required|email|max:50',
            'contact_address' => 'required|max:100',
            'contact_image' => 'nullable|mimes:jpg,jpeg,png |max:2096',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ],[
            'contact_image' =>'Please Upload a jpg/png image with size less than 2MB!'
        ]);
    }

}
