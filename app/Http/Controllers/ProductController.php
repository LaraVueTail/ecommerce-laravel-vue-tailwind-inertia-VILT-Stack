<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
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
                                
                                          
                    ->when(Request::input('categories') ?? false, fn($query, $categories) =>
                                $query
                                    ->whereHas(
                                        'category', fn($query) =>
                                        $query
                                            ->whereIn('slug', json_decode($categories))
                                )
                                )

                    ->when(Request::input('tags') ?? false, fn($query, $tags) =>
                        $query
                            ->whereIn('tag', json_decode($tags))
                    
                    )

                    ->when(Request::input('availability') ?? false, fn($query, $availability) =>
                        $query
                            ->whereIn('availability', json_decode($availability))
                
                    )

                    ->when(Request::input('brands') ?? false, fn($query, $brands) =>
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
                                $query->orderBy('total_price', 'desc');
                            }
                            if ($sortBy === 'price-asc') {
                                $query->orderBy('total_price', 'asc');
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

        return Inertia::render('AdminDashboard/products/Show', [
            'product' => $product
        ]);

    }

    public function create(Product $product)
    {

        return Inertia::render('AdminDashboard/products/Create');

    }

    public function store()
    {

        $attributes = $this->validateProduct();

        Product::create($attributes);

        return redirect('/admin-dashboard/products')->with('success', 'Product Created!');
    }

    public function edit(Product $product)
    {

        return Inertia::render('AdminDashboard/products/Edit', [
            'product' => $product
        ]);

    }

    public function update(Product $product)
    {

        $attributes = $this->validateProduct($product);

        $product->update($attributes);

        return back()->with('success', 'Product Updated!');
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

        return redirect('/admin-dashboard/products')->with('success', 'Product Deleted!');
    }

    protected function validateProduct(?Product $post = null): array
    {
        $post ??= new Product();

        return request()->validate([
            'shipping_address' => 'required',
            'user_id' => ['required', Rule::exists('users', 'id')],
            'cart_content' => 'required',
            'session_id' => 'nullable',
            'status' => 'required',
            'total_price' => 'required'
        ]);
    }



}
