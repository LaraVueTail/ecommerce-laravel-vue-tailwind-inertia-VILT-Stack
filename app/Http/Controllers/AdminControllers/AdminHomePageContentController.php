<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\HomePageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHomePageContentController extends Controller
{
    public function update(HomePageContent $homePageContent)
    {
        $attributes = $this->validateHomePageContent($homePageContent);  

        if($attributes['hero_carousel'] ?? false){
            $attributes['hero_carousel'] = $this->uploadImage($attributes['hero_carousel'] ?? false, $homePageContent->hero_carousel,'images/home-page/hero-slides');  
        }

        $homePageContent->update($attributes);

        return back()->withErrors('homePageContentsErrors')->with('success','Home Page Updated!');

    }

    public function deleteImage(HomePageContent $homePageContent)
    {
        $homePageContent->hero_carousel = $this->removeImage(request()->input('imageUrl'),$homePageContent->hero_carousel);
        $homePageContent->save();

        return back()->with('success', 'Image Deleted!');


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

    public function removeImage($imageUrl,$oldImagesArray)
    {
        parse_url($imageUrl)['host'] === 'images.pexels.com' ? $image = $imageUrl :   $image = substr(parse_url($imageUrl)['path'],1);

        if(gettype($oldImagesArray) === "array"){
            if (($key = array_search($image, $oldImagesArray)) !== false) {
                unset($oldImagesArray[$key]);
                if(parse_url($imageUrl)['host'] !== 'images.pexels.com'){
                    Storage::delete($image);
                }
            }
            $newImages = array_values($oldImagesArray);
            return $newImages;
        } else {
            if(Storage::exists($imageUrl)){
                Storage::delete($imageUrl);
            }
            $newImage = '';
            return $newImage;
        }
    }

    protected function validateHomePageContent(?HomePageContent $homePageContent = null): array
    {
        $homePageContent ??= new HomePageContent();

        return request()->validateWithBag('homePageContentsErrors',[
            'hero_carousel' => 'nullable',
            'hero_carousel.*' => 'nullable|mimes:jpg,jpeg,png |max:2096',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ],[
            'hero_carousel.*' =>'Please Upload a jpg/png image with size less than 2MB!'
        ]);
    }

}
