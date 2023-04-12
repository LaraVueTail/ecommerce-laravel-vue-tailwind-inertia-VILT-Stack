<?php

namespace App\Http\Controllers\AdminControllers;


use App\Http\Controllers\Controller;
use App\Models\Category;
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

    public function edit(Category $category)
    {
        // $category->img = asset($category->img);

        return Inertia::render('AdminDashboard/Categories/Edit', [
            'category' => $category
        ]);

    }

    public function update(Category $category)
    {
        $attributes = $this->validateCategory($category);

        if (request()->file('img')[0] ?? false) {
            $img = request()->file('img')[0];
            Storage::delete($category->img);
            $attributes['img'] = $img->storeAs('images/categories/'.$category['slug'].'/img','img.'.$img->extension());
        }
        if($category->slug !== $attributes['slug']){
            Storage::move('images/categories/'.$category['slug'].'/img', 'images/categories/'.$attributes['slug'].'/img');
            $attributes['img'] = array_key_exists("img",$attributes) ? str_replace($category['slug'],$attributes['slug'],$attributes['img']): str_replace($category['slug'],$attributes['slug'],$category['img']);
            Storage::deleteDirectory('images/categories/'.$category['slug']);
        }

        $category->update($attributes);

        return back()->with('success', 'Category Updated!');
    }


    public function destroy(Category $category)
    {
        $category->delete();

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
