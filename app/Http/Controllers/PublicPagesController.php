<?php

namespace App\Http\Controllers;

use App\Models\Pages\AboutPageContent;
use App\Models\Category;
use App\Models\Pages\ContactPageContent;
use App\Models\Pages\CustomPage;
use App\Models\Pages\HomePageContent;
use App\Models\Product;
use Inertia\Inertia;

class PublicPagesController extends Controller
{
    //
    public function homePage()
    {
        $homePageContent = HomePageContent::first();
        return Inertia::render('Public/Home', [
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

    // public function singleProductPage(Product $product)
    // {
    //     return Inertia::render('Public/SingleProduct', [
    //         'product' => $product
    //     ]);
    // }

    // public function shopPage()
    // {

    //     return Inertia::render('Public/Shop', [
    //         'products' => Product::filter(
    //             request(['categories','minPrice','maxPrice'])
    //         )->get(),
    //         'categories' => Category::all(),
    //         'selectedCategories' => request('categories'),
    //         'query'=>request()->all()
    //     ]);
    // }
}