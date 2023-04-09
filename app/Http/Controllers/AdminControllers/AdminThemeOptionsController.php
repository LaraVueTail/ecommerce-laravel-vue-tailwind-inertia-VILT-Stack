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
    public function index()
    {
        $categories =  Category::query()
                
        ->when(
            Request::input('search') ?? false,fn($query, $search) =>
            $query
                ->where(fn($query) =>
                $query
                    ->where('name', 'like', "%{$search}%")
                        ->orWhere('id', '=', $search)
            )
            )
        ->when(true,fn($query) =>
                $query->latest()
            )

        ->paginate(10)

        ->withQueryString();

        return Inertia::render(
            'AdminDashboard/Categories/Index',
            [
                'categories' => $categories,

                'filters' => Request::only(['search'])
            ]
        );

    }


    public function create()
    {


        return Inertia::render('AdminDashboard/ThemeOptions/Create');

    }

    public function store()
    {   
        // dd(request()->input('product_details'));
        $attributes = $this->validateCategory();
        $img = $attributes['img'][0];
        Category::create(array_merge($this->validateCategory(), [
            'img' => $img->storeAs('images/categories/'.$attributes['slug'].'/img','img.'.$img->extension()),
        ]));

        return redirect('/admin-dashboard/categories')->with('success', 'Category Created!');
    }

    public function edit(ThemeOption $themeOption)
    {
        // $category->img = asset($category->img);

        return Inertia::render('AdminDashboard/ThemeOptions/Edit', [
            'themeOption' => $themeOption
        ]);

    }

    public function update(ThemeOption $themeOption)
    {
        $attributes = $this->validateThemeOptions($themeOption);
        dd($attributes);

        if($attributes['hero_carousel'] ?? false){
            $heroCarouselFiles = $attributes['hero_carousel'];

            $oldHeroCarousel = json_decode($themeOption->hero_carousel);
    
            foreach ($heroCarouselFiles as $imageFile) {
                array_push($oldHeroCarousel,$imageFile->store('images/theme/hero-carousel'));
            }
    
            $attributes['hero_carousel'] = $oldHeroCarousel;
        }

        $themeOption->update($attributes);

        return back()->with('success', 'Theme Options Updated!');
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
            'hero_carousel.*' => 'nullable|mimes:jpeg,png |max:2096',
        ],
        [
            'hero_carousel.*.mimes' => 'Upload image as jpg/png format with size less than 2MB',
            'hero_carousel.*.max' => 'Upload image with size less than 2MB',
        ]);
    }


}
