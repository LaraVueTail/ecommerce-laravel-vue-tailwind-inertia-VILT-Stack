<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\ContactPageContent;
use App\Services\FileManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminContactPageContentController extends Controller
{
    public function update(ContactPageContent $contactPageContent,FileManagement $fileManagement)
    {
        $attributes = $this->validateContactPageContent($contactPageContent);  
        if($attributes['contactImage'][0] ?? false){
            if($attributes['contactImage'][0] ?? false){
                $attributes['contactImage'] = 
                $fileManagement->uploadFile(
                    file:$attributes['contactImage'][0] ?? false,
                    deleteOldFile:true, 
                    oldFile:$contactPageContent->contactImage,
                    path:'images/contact-page'
                );   
            }  
        }

        $contactPageContent->update($attributes);

        return back()->withErrors('contactPageContentsErrors')->with('success','Contact Page Updated!');

    }

    protected function validateContactPageContent(?ContactPageContent $contactPageContent = null): array
    {
        $contactPageContent ??= new ContactPageContent();

        return request()->validateWithBag('contactPageContentsErrors',[
            'contactHeading' => 'required|max:50',
            'contactSubHeading' => 'required|max:1000',
            'contactText' => 'required|max:1000',
            'contactPhoneNumbers' => 'required|max:50',
            'contactEmail' => 'required|email|max:50',
            'contactAddress' => 'required|max:100',
            'contactImage' => 'nullable',
            'contactImage.*' => 'nullable|mimes:jpg,jpeg,png |max:2096',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ],[
            'contactImage.*' =>'Please Upload a jpg/png image with size less than 2MB!'
        ]);
    }

}
