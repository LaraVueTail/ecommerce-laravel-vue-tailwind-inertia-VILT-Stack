<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $more_images = json_decode($product->more_images);

        // $product->thumbnail = asset($product->thumbnail);

        $product->more_images = json_encode(array_map([$this, 'getUrl'],$more_images));
        // dd($more_images);

        return Inertia::render('Public/Products/Show', [
            'product' => $product
        ]);

    }

    public function getUrl($file)
    {
        return asset($file);
    }

}
