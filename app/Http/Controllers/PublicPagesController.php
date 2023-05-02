<?php

namespace App\Http\Controllers;

use App\Models\AboutPageContent;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ContactPageContent;
use App\Models\CustomPage;
use App\Models\HomePageContent;
use App\Models\MainMenu;
use App\Models\Product;
use App\Models\ThemeOption;
use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PublicPagesController extends Controller
{
    //
    public function homePage()
    {
        $homePageContent = HomePageContent::first();
        return Inertia::render('Public/HomeNew', [
            'homePageContent' => $homePageContent,
            'categories' => Category::all(),
            'productBestSellers'=>Product::whereIn('tag',['best_seller','new_arrival'])->paginate(10)->withQueryString()
        ]);
    }

    public function aboutPage()
    {

        $aboutPageContent = AboutPageContent::first();
        return Inertia::render('Public/About',[
            'aboutPageContent' => $aboutPageContent,
        ]);
    }

    public function contactPage()
    {
        $contactPageContent = ContactPageContent::first();
        return Inertia::render('Public/Contact',[
            'contactPageContent' => $contactPageContent,
        ]);
    }

    public function customPage(CustomPage $customPage)
    {
        return Inertia::render('Public/CustomPage',[
            'customPageContent' => $customPage,
        ]);
    }

    public function singleProductPage(Product $product)
    {
        return Inertia::render('Public/SingleProduct', [
            'product' => $product
        ]);
    }

    public function shopPage()
    {

        return Inertia::render('Public/Shop', [
            'products' => Product::filter(
                request(['categories','minPrice','maxPrice'])
            )->get(),
            'categories' => Category::all(),
            'selectedCategories' => request('categories'),
            'query'=>request()->all()
        ]);
    }
    public function getUrl($file)
    {
        return asset($file);
    }
}