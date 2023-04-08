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

class AdminProductController extends Controller
{
    //
    public function index()
    {
        return Inertia::render(
            'AdminDashboard/Products/Index',
            [
                'products' => Product::query()
                
                    ->when(
                        Request::input('search') ?? false,fn($query, $search) =>
                        $query
                            ->where(fn($query) =>
                            $query
                                ->where('name', 'like', "%{$search}%")
                                    ->orWhere('description', 'like', "%{$search}%")
                                        ->orWhere('short_description', 'like', "%{$search}%")
                                            ->orWhere('id', '=', $search)
                        )
                        )
                                
                                          
                    ->when(Request::input('category') ?? false, fn($query, $categories) =>
                                $query
                                    ->whereHas(
                                        'category', fn($query) =>
                                        $query
                                            ->whereIn('slug', json_decode($categories))
                                )
                                )

                    ->when(Request::input('tag') ?? false, fn($query, $tags) =>
                        $query
                            ->whereIn('tag', json_decode($tags))
                    
                    )

                    ->when(Request::input('availability') ?? false, fn($query, $availability) =>
                        $query
                            ->whereIn('availability', json_decode($availability))
                
                    )

                    ->when(Request::input('brand') ?? false, fn($query, $brands) =>
                        $query
                            ->whereIn('brand', json_decode($brands))
                
                    )


                    ->when(Request::input('dateStart') ?? false, function ($query, $dateStart) {
                            $dateStart = Carbon::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
                            $query
                                ->whereDate('created_at', '>=', $dateStart);
                        }
                    )

                    ->when(
                        Request::input('dateEnd') ?? false,
                        function ($query, $dateEnd) {
                            // dd($dateEnd);
                            $dateEnd = Carbon::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
                            $query
                                ->whereDate('created_at', '<=', $dateEnd);
                        }
                    )

                    ->when(
                        Request::input('sortBy') ?? 'default',
                        function ($query, $sortBy) {
                            // dd($dateStart)
                            if ($sortBy === 'date-dsc') {
                                $query->latest();
                            }
                            if ($sortBy === 'date-asc') {
                                $query->oldest();
                            }
                            if ($sortBy === 'price-dsc') {
                                $query->orderBy('price', 'desc');
                            }
                            if ($sortBy === 'price-asc') {
                                $query->orderBy('price', 'asc');
                            }
                            if ($sortBy === 'inventory-asc') {
                                $query->orderBy('inventory', 'asc');
                            }
                            if ($sortBy === 'inventory-dsc') {
                                $query->orderBy('inventory', 'dsc');
                            }
                            if ($sortBy === 'default') {
                                $query->latest();
                            }
                        }
                    )
                    ->paginate(10)
                    ->withQueryString(),
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

    public function create(Product $product)
    {


        return Inertia::render('AdminDashboard/Products/Create',[
            'categories' => Category::all()
        ]);

    }

    public function store()
    {   
        // dd(request()->input('product_details'));
        $attributes = $this->validateProduct();

        $thumbnailFile = $attributes['thumbnail'][0];
        $moreImagesFiles = $attributes['more_images'];

        $moreImageUrls = array();

        foreach ($moreImagesFiles as $imageFile) {
            array_push($moreImageUrls,$imageFile->store('images/products/'.$attributes['slug'].'/more_images'));
        }

        Product::create(array_merge($this->validateProduct(), [
            'thumbnail' => $thumbnailFile->store('images/products/'.$attributes['slug'].'/thumbnail'),
            'more_images'=>json_encode($moreImageUrls)
        ]));


        return redirect('/admin-dashboard/products')->with('success', 'Product Created!');
    }

    public function edit(Product $product)
    {
        $more_images = json_decode($product->more_images);

        // $product->thumbnail = asset($product->thumbnail);

        $product->more_images = json_encode(array_map([$this, 'getUrl'],$more_images));

        return Inertia::render('AdminDashboard/Products/Edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);

    }

    public function update(Product $product)
    {


        $attributes = $this->validateProduct($product);


        if (request()->file('thumbnail')[0] ?? false) {
            $thumbnailFile = request()->file('thumbnail')[0];
            Storage::delete($product->thumbnail);
            $attributes['thumbnail'] = $thumbnailFile->store('images/products/'.$product->slug.'/thumbnail');
        }


        if($attributes['more_images'] ?? false){
            $moreImagesFiles = $attributes['more_images'];

            $oldMoreImages = json_decode($product->more_images);
    
            foreach ($moreImagesFiles as $imageFile) {
                array_push($oldMoreImages,$imageFile->store('images/products/'.$product->slug.'/more_images'));
            }
    
            $attributes['more_images'] = $oldMoreImages;
        }

   

        $product->update($attributes);

        return back()->with('success', 'Product Updated!');
    }

    public function deleteImage(Product $product)
    {
        $image = parse_url(request()->input('imageUrl'))['path'];
        $image = substr($image, 1);
        // Storage::delete($image);
        // $image=json_encode($image);
        $more_images = json_decode($product->more_images);
        // dd($image, $more_images);

        if (($key = array_search($image, $more_images)) !== false) {
            unset($more_images[$key]);
        Storage::delete($image);

        }
        // dd($more_images);
        $more_images = array_values($more_images);

        $product->more_images = json_encode($more_images);
        $product->save();

        return back()->with('success', 'Image Deleted!');


    }

    public function updateProductStatus(Product $product)
    {

        $attributes = request()->validate([
            'status' => 'required',
        ]);

        $product->update($attributes);

        return back()->with('success', 'Product Updated!');
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
            'link' => 'nullable',
            'thumbnail' => $product->exists ? 'nullable' : 'required',
            'more_images' => $product->exists ? 'nullable' : 'required',
            'thumbnail.*' => 'required|mimes:jpeg,png |max:2096',
            'more_images.*' => 'mimes:jpeg,png |max:2096',
            'description' => 'required',
            'short_description' => 'required',
            'product_details' => 'nullable',
        ],[
            'thumbnail.*.mimes' => 'Upload thumbnail as jpg/png format with size less than 2MB',
            'thumbnail.*.max' => 'Upload thumbnail with size less than 2MB',
            'more_images.*.mimes' => 'Upload images as jpg/png format with size less than 2MB',
            'more_images.*.max' => 'Upload images with size less than 2MB',
        ]);
    }

    public function getUrl($file)
    {
        return asset($file);
    }


}
