<?php

namespace App\Http\Controllers\AdminControllers\PagesControllers;
use App\Http\Controllers\Controller;
use App\Models\ContactPageContent;
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
    
    public function update(ContactPageContent $contactPageContent,FileManagement $fileManagement)
    {
        $attributes = $this->validateContactPageContent($contactPageContent);  
        if($attributes['contactImage'] ?? false){
                $attributes['contactImage'] = 
                $fileManagement->uploadFile(
                    file:$attributes['contactImage'] ?? false,
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
            'contactHeading' => 'required|max:50',
            'contactSubHeading' => 'required|max:1000',
            'contactText' => 'required|max:1000',
            'contactPhoneNumbers' => 'required|max:50',
            'contactEmail' => 'required|email|max:50',
            'contactAddress' => 'required|max:100',
            'contactImage' => 'nullable|mimes:jpg,jpeg,png |max:2096',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ],[
            'contactImage' =>'Please Upload a jpg/png image with size less than 2MB!'
        ]);
    }

}
