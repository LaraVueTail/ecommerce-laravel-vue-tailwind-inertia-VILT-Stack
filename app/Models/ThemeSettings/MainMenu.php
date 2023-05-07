<?php

namespace App\Models\ThemeSettings;

use App\Models\ThemeSettings\SiteIdentity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class MainMenu extends Model
{
    use HasFactory;

    public function publicMenu()
    {
        $publicMenu = [
            'logo' => [ 
              "name"=> SiteIdentity::first()->site_name,
              "imageSrc"=> SiteIdentity::first()->logo_image, 
              "href" => asset('')
             ],
            'categories'=> [
              [
                "id"=> "category",
                "name"=> "Category",
                "featured"=> [
                  [
                    "name"=> "Best Seller",
                    "href"=> asset('').'shop?tag=%5B"best_seller"%5D',
                    "imageSrc"=>
                      "https://images.pexels.com/photos/5650017/pexels-photo-5650017.jpeg?auto=compress"
                  ],
                  [
                    "name"=> "New Arrivals",
                    "href"=> asset('').'shop?tag=%5B"new_arrival"%5D',
                    "imageSrc"=>
                      "https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg"
                  ],

                ],
                "sections"=> [
                  [
                    "id"=> "categories",
                    "name"=> "Categories",
                    "items"=> Category::all()
                  ],
                ],
            ],
            ],
            "pages"=> [
              [ "name"=> "Shop", "href" => asset('').'shop' ],
              [ "name"=> "About", "href" => asset('').'about' ],
              [ "name"=> "Contact", "href" => asset('').'contact' ],
            ],
        ];
        return json_encode($publicMenu);
    }
}
