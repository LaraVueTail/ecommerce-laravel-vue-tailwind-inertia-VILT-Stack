<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\ContactPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminContactPageContentController extends Controller
{
    public function update(ContactPageContent $contactPageContent)
    {
        $attributes = $this->validateContactPageContent($contactPageContent);  
        if($attributes['contactImage'][0] ?? false){
            $attributes['contactImage'] = $this->uploadImage($attributes['contactImage'][0] ?? false, $contactPageContent->contactImage,'images/contact-page');    
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

    public function uploadImage($files,$oldFiles,$path,$storeAsName = false)
    {
        if(gettype($files ?? false) === "array"){
            $imageFiles = $files;    
            foreach ($imageFiles as $imageFile) {
                array_push($oldFiles,$imageFile->store($path));
            }
            return $oldFiles;

        } else{
            $imageFile = $files;
            if(Storage::disk('public')->exists($oldFiles)){
                Storage::delete($oldFiles);
            }
            if(!$storeAsName){
                $storeAsName = $imageFile->getClientOriginalName();
            } else {
                $storeAsName = $storeAsName.'.'.$imageFile->extension();
            }
            return $imageFile->storeAs($path,$storeAsName);
        }
    }

}
