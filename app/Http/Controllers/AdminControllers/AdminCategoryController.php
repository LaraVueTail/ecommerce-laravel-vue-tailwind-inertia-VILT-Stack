<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class AdminCategoryController extends Controller
{
    //
    public function index()
    {
        return Inertia::render(
            'AdminDashboard/Categories/Index',
            [
                'categories' => Category::query()
                
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
                    ->withQueryString(),
                'filters' => Request::only(['search'])
            ]
        );

    }


    public function create(Category $category)
    {


        return Inertia::render('AdminDashboard/Categories/Create');

    }

    public function store()
    {   
        // dd(request()->input('product_details'));
        $attributes = $this->validateCategory();

        Category::create($attributes);

        return redirect('/admin-dashboard/categories')->with('success', 'Category Created!');
    }

    public function edit(Category $category)
    {

        return Inertia::render('AdminDashboard/Categories/Edit', [
            'category' => $category
        ]);

    }

    public function update(Category $category)
    {
        $attributes = $this->validateCategory($category);

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
            'slug' => [$category->exists ? 'exclude' : 'required', Rule::unique('categories', 'slug')->ignore($category)],
        ]);
    }


}
