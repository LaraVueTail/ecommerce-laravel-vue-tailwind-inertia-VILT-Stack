<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class MainMenu extends Model
{
    use HasFactory;
    public function publicMenu()
    {
        $publicMenu = [
            'categories'=> [
              [
                "id"=> "category",
                "name"=> "Category",
                "featured"=> [
                  [
                    "name"=> "Best Seller",
                    "href"=> "#",
                    "imageSrc"=>
                      "https://images.pexels.com/photos/5650017/pexels-photo-5650017.jpeg?auto=compress"
                  ],
                  [
                    "name"=> "New Arrivals",
                    "href"=> "#",
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
              [ "name"=> "About", "href" => asset('').'about' ],
              [ "name"=> "Contact", "href" => asset('').'contact' ],
            ],
        ];
        return json_encode($publicMenu);
    }
}
