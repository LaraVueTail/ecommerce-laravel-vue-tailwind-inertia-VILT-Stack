<?php

namespace App\Http\Controllers;

use App\Models\AboutPageContent;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ContactPageContent;
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
        $mainMenu = new MainMenu();
        return Inertia::render('Public/HomeNew', [
            'mainMenu' => $mainMenu->publicMenu(),
            'homePageContent' => $homePageContent,
            'products' => Product::all()
        ]);
    }

    public function aboutPage()
    {

        $aboutPageContent = AboutPageContent::first();
        $aboutPageContent->aboutImage = $this->getUrl($aboutPageContent->aboutImage);
        $mainMenu = new MainMenu();
        return Inertia::render('Public/About',[
            'mainMenu' => $mainMenu->publicMenu(),
            'aboutPageContent' => $aboutPageContent,
        ]);
    }

    public function contactPage()
    {
        // dd($cart->cart_data);
        $contactPageContent = ContactPageContent::first();
        // dd($contactPageContent);
        $contactPageContent->contactImage = $this->getUrl($contactPageContent->contactImage);
        // dd($contactPageContent);
        $mainMenu = new MainMenu();
        return Inertia::render('Public/Contact',[
            'mainMenu' => $mainMenu->publicMenu(),
            'contactPageContent' => $contactPageContent,
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
        // dd(json_decode(request('categories')));
        $mainMenu = new MainMenu();
        return Inertia::render('Public/Shop', [
            'mainMenu' => $mainMenu->publicMenu(),
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