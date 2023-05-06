<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\FileManagement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class AdminProductController extends Controller
{
    //
    public function index()
    {

        return Inertia::render(
            'AdminDashboard/Products/Index',
            [
                'products' => Product::filter(
                    request(['search', 'category', 'tag','availability','brand','dateStart','dateEnd','sortBy']))
                    ->paginate(10)->withQueryString(),
                'filters' => Request::only(['search', 'sortBy', 'categories','tags','availability','brands', 'dateStart', 'dateEnd'])
            ]
        );

    }

    public function show(Product $product)
    {
        return Inertia::render('AdminDashboard/Products/Show', [
            'product' => $product
        ]);

    }

    public function create()
    {

        return Inertia::render('AdminDashboard/Products/Create',[
            'categories' => Category::all()
        ]);

    }

    public function store(FileManagement $fileManagement)
    {   

        $attributes = $this->validateProduct();

        if($attributes['thumbnail'] ?? false){
            $attributes['thumbnail'] = 
            $fileManagement->uploadFile(
                file:$attributes['thumbnail'] ?? false,
                path:'images/products/'.$attributes['slug'].'/thumbnail'
            );
        }


        if($attributes['more_images'] ?? false){
            $attributes['more_images'] = 
            $fileManagement->uploadFile(
                files:$attributes['more_images'] ?? false,
                path:'images/products/'.$attributes['slug'].'/more_images'
            );
        }

        Product::create($attributes);

        return redirect('/admin-dashboard/products')->with('success', 'Product Created!');
    }

    public function edit(Product $product)
    {
        return Inertia::render('AdminDashboard/Products/Edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);

    }

    public function update(Product $product,FileManagement $fileManagement)
    {

        $attributes = $this->validateProduct($product);

        if($attributes['thumbnail'] ?? false){
            $attributes['thumbnail'] = 
            $fileManagement->uploadFile(
                file:$attributes['thumbnail'] ?? false,
                path:'images/products/'.$product->slug.'/thumbnail',
                deleteOldFile:true,
                oldFile:$product['thumbnail']
            );
        }

        if($attributes['more_images'] ?? false){
            $attributes['more_images'] = 
            $fileManagement->uploadFile(
                files:$attributes['more_images'] ?? false,
                appendFilesTo:$product->more_images,
                path:'images/products/'.$product->slug.'/more_images'
            );
        }

        $product->update($attributes);

        return back()->with('success', 'Product Updated!');
    }

    public function deleteImage(Product $product, FileManagement $fileManagement)
    {

        $product->more_images =
        $fileManagement->deleteFile(
            fileUrl:request()->input('imageUrl'),
            oldFilesArray:$product->more_images
        );

        $product->save();

        return back()->with('success', 'Image Deleted!');

    }


    public function destroy(Product $product)
    {
        $product->delete();
        Storage::deleteDirectory('images/products/'.$product->slug);

        return redirect('/admin-dashboard/products')->with('success', 'Product Deleted!');
    }

    protected function validateProduct(?Product $product = null): array
    {
        $product ??= new Product();

        return request()->validate([
            'name' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'brand' => 'nullable',
            'tag' => 'nullable',
            'inventory' => 'nullable',
            'availability' => 'required',
            'offer' => 'nullable',
            'price_sale' => 'nullable',
            'price' => 'required',
            'slug' => [$product->exists ? 'exclude' : 'required', Rule::unique('products', 'slug')->ignore($product)],
            'thumbnail' => $product->exists ? 'nullable|mimes:jpeg,png |max:2096' : 'required|mimes:jpeg,png |max:2096',
            'more_images.*' => $product->exists ?'nullable|mimes:jpeg,png |max:2096':'required|mimes:jpeg,png |max:2096',
            'description' => 'required',
            'short_description' => 'required',
            'product_details' => 'nullable',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ],[
            'thumbnail' => 'Upload thumbnail as jpg/png format with size less than 2MB',
            'more_images.*' => 'Upload images as jpg/png format with size less than 2MB',
        ]);
    }
}
