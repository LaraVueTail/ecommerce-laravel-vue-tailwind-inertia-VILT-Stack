<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\ThemeOption;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class AdminThemeOptionsController extends Controller
{
    //
    // public function __construct()
    // {
    //     $themeOption = ThemeOption::first();
    //     dd($themeOption);
    // }

    public function edit(ThemeOption $themeOption)
    {
        $hero_carousel = json_decode($themeOption->hero_carousel);
        $aboutImage = $themeOption->aboutImage;
        $themeOption->aboutImage = $this->getUrl($aboutImage); 

        $themeOption->hero_carousel = json_encode(array_map([$this, 'getUrl'],$hero_carousel));
        return Inertia::render('AdminDashboard/ThemeOptions/Edit', [
            'themeOption' => $themeOption
        ]);


    }

    public function update(ThemeOption $themeOption)
    {
        
        $attributes = $this->validateThemeOptions($themeOption);  
        if($attributes['aboutImage'][0] ?? false){
            $attributes['aboutImage'] = $this->uploadImage($attributes['aboutImage'][0] ?? false, $themeOption->aboutImage,'images/theme/about-page');    
        }
        if($attributes['hero_carousel'] ?? false){
            $attributes['hero_carousel'] = $this->uploadImage($attributes['hero_carousel'] ?? false, $themeOption->hero_carousel,'images/theme/hero-carousel');  
        }
        

        // if (request()->file('aboutImage')[0] ?? false) {
        //     $aboutImageFile = request()->file('aboutImage')[0];
        //     if(Storage::disk('public')->exists($themeOption->aboutImage)){
        //         Storage::delete($themeOption->aboutImage);
        //     }
        //     $attributes['aboutImage'] = $aboutImageFile->storeAs('images/theme/about-page','aboutImage.'. $aboutImageFile->extension());
        // }     



        // if($attributes['hero_carousel'] ?? false){
        //     $heroCarouselFiles = $attributes['hero_carousel'];

        //     $oldHeroCarousel = json_decode($themeOption->hero_carousel);
    
        //     foreach ($heroCarouselFiles as $imageFile) {
        //         array_push($oldHeroCarousel,$imageFile->store('images/theme/hero-carousel'));
        //     }
    
        //     $attributes['hero_carousel'] = $oldHeroCarousel;
        // }

        $themeOption->update($attributes);

        return back()->with('success', 'Theme Options Updated!');
    }

    public function deleteImage(ThemeOption $themeOption)
    {

        parse_url(request()->input('imageUrl'))['host'] === 'images.pexels.com' ? $image = request()->input('imageUrl') :   $image = substr(parse_url(request()->input('imageUrl'))['path'],1);
        
        $hero_carousel = json_decode($themeOption->hero_carousel);
        // dd($image, $hero_carousel);

        if (($key = array_search($image, $hero_carousel)) !== false) {
            unset($hero_carousel[$key]);
            if(parse_url(request()->input('imageUrl'))['host'] !== 'images.pexels.com'){
                Storage::delete($image);
            }
        }
        // dd($hero_carousel);
        $hero_carousel = array_values($hero_carousel);

        $themeOption->hero_carousel = json_encode($hero_carousel);
        $themeOption->save();

        return back()->with('success', 'Image Deleted!');


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
            }
            return $imageFile->storeAs($path,$storeAsName.'.'.$imageFile->extension());
        }
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/admin-dashboard/categories')->with('success', 'Category Deleted!');
    }

    protected function validateThemeOptions(?ThemeOption $themeOption = null): array
    {
        $themeOption ??= new ThemeOption();

        return request()->validate([
            'hero_carousel' => 'nullable',
            'aboutHeading' => 'required|max:50',
            'aboutText' => 'required|max:350',
            'aboutImage.*' => 'nullable|mimes:jpg,jpeg,png |max:2096',
            'hero_carousel.*' => 'nullable|mimes:jpg,jpeg,png |max:2096',
        ]);
    }

    public function getUrl($file)
    {
        return asset($file);
    }



}
