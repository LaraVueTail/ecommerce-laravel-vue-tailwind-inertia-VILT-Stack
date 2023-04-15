<?php

namespace App\Http\Controllers\AdminControllers;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\FileManagement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class AdminCategoryController extends Controller
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
        return Inertia::render('AdminDashboard/Categories/Create');

    }

    public function store(FileManagement $fileManagement)
    {   
        $attributes = $this->validateCategory();
        $attributes['img'] = 
        $fileManagement->uploadFile(
            file:$attributes['img'][0] ?? false,
            path:'images/categories/'.$attributes['slug'].'/img',
            storeAsName: 'thumbnail'

        );  

        Category::create($attributes);

        return redirect('/admin-dashboard/categories')->with('success', 'Category Created!');
    }

    public function edit(Category $category)
    {
        return Inertia::render('AdminDashboard/Categories/Edit', [
            'category' => $category
        ]);

    }

    public function update(Category $category, FileManagement $fileManagement)
    {
        $attributes = $this->validateCategory($category);
        if($attributes['img'][0] ?? false) {
            $attributes['img'] = 
            $fileManagement->uploadFile(
                file:$attributes['img'][0] ?? false,
                deleteOldFile:true, 
                oldFile:$category->img,
                path:'images/categories/'.($category['slug'] !== $attributes['slug'] ? $attributes['slug'] : $category['slug']).'/img',
                storeAsName: 'thumbnail'

            );  
        }
        if($category->slug !== $attributes['slug']){
            $fileManagement->moveFiles(
                oldPath:'images/categories/'.$category['slug'].'/img',
                newPath:'images/categories/'.$attributes['slug'].'/img',
                deleteDirectory: 'images/categories/'.$category['slug']
            );
            $attributes['img'] = str_replace($category['slug'],$attributes['slug'],$category['img']);
        }

        $category->update($attributes);

        return back()->with('success', 'Category Updated!');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        Storage::deleteDirectory('images/categories/'.$category['slug']);

        return redirect('/admin-dashboard/categories')->with('success', 'Category Deleted!');
    }

    protected function validateCategory(?Category $category = null): array
    {
        $category ??= new Category();

        return request()->validate([
            'name' => 'required',
            'slug' => ['required', Rule::unique('categories', 'slug')->ignore($category)],
            'img' => $category->exists ? 'nullable' : 'required',
            'img.*' => 'required|mimes:jpeg,png |max:2096',
        ],
        [
            'img.required' => 'Add an Image for Category',
            'img.*.mimes' => 'Upload image as jpg/png format with size less than 2MB',
            'img.*.max' => 'Upload image with size less than 2MB',
        ]);
    }


}
