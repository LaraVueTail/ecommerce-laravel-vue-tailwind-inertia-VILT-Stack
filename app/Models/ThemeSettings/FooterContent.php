<?php

namespace App\Models\ThemeSettings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FooterContent extends Model
{
    use HasFactory;
    protected $casts = [
        'page_links' => 'array'
    ];
    protected $appends = ['site_logo','site_name'];

    protected function siteLogo(): Attribute
    {
        return Attribute::make(
        get: function($value) {
            $logo = SiteIdentity::first()->logo_image;
            return asset($logo);
        },
        );
    }

    protected function siteName(): Attribute
    {
        return Attribute::make(
        get: function($value) {
            return SiteIdentity::first()->site_name;
        },
        );
    }

}
