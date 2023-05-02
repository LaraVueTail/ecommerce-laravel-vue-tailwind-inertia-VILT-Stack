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

    public function update(AboutPageContent $aboutPageContent,FileManagement $fileManagement)
    {
        $attributes = $this->validateAboutPageContent($aboutPageContent);  

        if($attributes['aboutImage'] ?? false){
            $attributes['aboutImage'] = 
            $fileManagement->uploadFile(
                file:$attributes['aboutImage'] ?? false,
                deleteOldFile:true, 
                oldFile:$aboutPageContent->aboutImage,
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
            'aboutHeading' => 'required|max:50',
            'aboutSubHeading' => 'required|max:1000',
            'aboutText' => 'required|max:1000',
            'aboutStatuses' => 'nullable|max:300',
            'aboutImage' => 'nullable|mimes:jpg,jpeg,png |max:2096',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ],[
            'aboutImage' =>'Please Upload a jpg/png image with size less than 2MB!'
        ]);
    }

}
