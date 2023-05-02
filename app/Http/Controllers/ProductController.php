<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MainMenu;
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
        // dd('ss');
        return Inertia::render(
            'Public/ShopNew',
            [
                'products' => Product::filter(
                    request(['search', 'category', 'tag','availability','brand','dateStart','dateEnd','sortBy']))
                    ->paginate(10)->withQueryString(),
                'filters' => Request::only(['search', 'sortBy', 'category','tag','availability','brands', 'dateStart', 'dateEnd']),
                'categories'=>Category::all()
            ]
        );

    }

    public function show(Product $product)
    {

        $mainMenu = new MainMenu();
        return Inertia::render('Public/Products/Show', [
            'mainMenu' => $mainMenu->publicMenu(),
            'product' => $product
        ]);

    }

}
