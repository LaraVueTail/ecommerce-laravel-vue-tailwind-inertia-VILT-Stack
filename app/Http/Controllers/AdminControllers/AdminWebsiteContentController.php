<?php

namespace App\Http\Controllers\AdminControllers;

use Inertia\Inertia;
use App\Models\SiteIdentity;
use App\Models\FooterContent;
use App\Models\HomePageContent;
use App\Models\AboutPageContent;
use App\Models\ContactPageContent;
use App\Http\Controllers\Controller;


class AdminWebsiteContentController extends Controller
{

    public function edit()
    {

        $siteIdentity = SiteIdentity::first();
        $footerContent = FooterContent::first();
        $homePageContent = HomePageContent::first();
        $aboutPageContent = AboutPageContent::first();
        $contactPageContent = ContactPageContent::first();
        
        return Inertia::render('AdminDashboard/WebsiteContents/Edit', [
            'siteIdentity'=>$siteIdentity,
            'footerContent'=>$footerContent,
            'homePageContent'=>$homePageContent,
            'contactPageContent' => $contactPageContent,
            'aboutPageContent' => $aboutPageContent
        ]);
    }
}
