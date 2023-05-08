<?php

namespace App\Http\Controllers\AdminControllers\PagesControllers;
use App\Http\Controllers\Controller;
use App\Models\Pages\AboutPageContent;
use App\Services\FileManagement;
use Inertia\Inertia;

class AdminAboutPageContentController extends Controller
{
    public function edit()
    {
        $aboutPageContent = AboutPageContent::first();
        return Inertia::render('AdminDashboard/Pages/AboutPageEdit', [
            'aboutPageContent' => $aboutPageContent,
        ]);
    }

    public function update(FileManagement $fileManagement)
    {
        $aboutPageContent = AboutPageContent::first();
        $attributes = $this->validateAboutPageContent($aboutPageContent);  

        if($attributes['about_image'] ?? false){
            $attributes['about_mage'] = 
            $fileManagement->uploadFile(
                file:$attributes['about_image'] ?? false,
                deleteOldFile:true, 
                oldFile:$aboutPageContent->about_image,
                path:'images/about-page'
            );   
        }

        $aboutPageContent->update($attributes);

        return back()->with('success','About Page Updated!');

    }

    protected function validateAboutPageContent(?AboutPageContent $aboutPageContent = null): array
    {
        $aboutPageContent ??= new AboutPageContent();

        return request()->validate([
            'about_heading' => 'required|max:50',
            'about_sub_heading' => 'required|max:1000',
            'about_text' => 'required|max:1000',
            'about_statuses' => 'nullable|max:300',
            'about_image' => 'nullable|mimes:jpg,jpeg,png |max:2096',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ],[
            'about_image' =>'Please Upload a jpg/png image with size less than 2MB!'
        ]);
    }

}
