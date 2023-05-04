<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\EcommerceSettings;
use App\Models\ThemeSettings\MainMenu;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        // dd('ss');
        return Inertia::render(
            'Public/Shop',
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
        return Inertia::render('Public/Products/Show', [
            'product' => $product,
            'enable_whatsapp' => EcommerceSettings::first()->enable_whatsapp,
            'whatsapp_number' => EcommerceSettings::first()->whatsapp_number,
        ]);

    }

}
