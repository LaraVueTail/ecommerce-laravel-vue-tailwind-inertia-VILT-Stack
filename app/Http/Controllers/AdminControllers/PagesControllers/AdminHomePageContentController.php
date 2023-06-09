<?php

namespace App\Http\Controllers\AdminControllers\PagesControllers;
use App\Http\Controllers\Controller;
use App\Models\Pages\HomePageContent;
use App\Services\FileManagement;
use Inertia\Inertia;

class AdminHomePageContentController extends Controller
{
    public function edit()
    {
        $homePageContent = HomePageContent::first();
        return Inertia::render('AdminDashboard/Pages/HomePageEdit', [
            'homePageContent'=>$homePageContent,
        ]);
    }
    
    public function update(FileManagement $fileManagement)
    {
        $homePageContent = HomePageContent::first();
        $attributes = $this->validateHomePageContent($homePageContent);

        if($attributes['hero_carousel'] ?? false){
            $attributes['hero_carousel'] = 
            $fileManagement->uploadFile(
                files:$attributes['hero_carousel'] ?? false,
                appendFilesTo:$homePageContent->hero_carousel,
                path:'images/home-page/hero-slides'
            );
        }
        // dd($attributes);  


        $homePageContent->update($attributes);

        return back()->with('success','Home Page Updated!');

    }

    public function deleteImage(FileManagement $fileManagement)
    {   
        $homePageContent = HomePageContent::first();
        $homePageContent->hero_carousel =
        $fileManagement->deleteFile(
            fileUrl:request()->input('imageUrl'),
            oldFilesArray:$homePageContent->hero_carousel
        );
        $homePageContent->save();

        return back()->with('success', 'Image Deleted!');

    }

    protected function validateHomePageContent(?HomePageContent $homePageContent = null): array
    {
        $homePageContent ??= new HomePageContent();

        return request()->validate([
            'hero_carousel' => 'nullable',
            'hero_carousel.*' => 'nullable|mimes:jpg,jpeg,png |max:2096',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ],[
            'hero_carousel.*' =>'Please Upload a jpg/png image with size less than 2MB!'
        ]);
    }

}
