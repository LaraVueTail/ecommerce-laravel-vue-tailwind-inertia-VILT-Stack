<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\AboutPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAboutPageContentController extends Controller
{
    public function update(AboutPageContent $aboutPageContent)
    {
        // dd(request()->all());
        $attributes = $this->validateAboutPageContent($aboutPageContent);  
        // dd($attributes);


        if($attributes['aboutImage'][0] ?? false){
            $attributes['aboutImage'] = $this->uploadImage($attributes['aboutImage'][0] ?? false, $aboutPageContent->aboutImage,'images/about-page');    
        }

        $aboutPageContent->update($attributes);

        return back()->with('success','About Page Updated!');

    }

    protected function validateAboutPageContent(?AboutPageContent $aboutPageContent = null): array
    {
        $aboutPageContent ??= new AboutPageContent();

        return request()->validate([
            'aboutHeading' => 'required|max:50',
            'aboutSubHeading' => 'required|max:1000',
            'aboutText' => 'required|max:1000',
            'aboutImage.*' => 'nullable|mimes:jpg,jpeg,png |max:2096',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ]);
    }

    public function uploadImage($files,$oldFiles,$path,$storeAsName = false)
    {
        if(gettype($files ?? false) === "array"){
            $imageFiles = $files;

            $oldFiles = json_decode($oldFiles);
    
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

    public function getUrl($file)
    {
        return asset($file);
    }
}
