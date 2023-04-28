<?php

namespace App\Http\Controllers\AdminControllers;

use Inertia\Inertia;
use App\Models\SiteIdentity;
use App\Models\FooterContent;
use App\Models\HomePageContent;
use App\Models\AboutPageContent;
use App\Models\ContactPageContent;
use App\Http\Controllers\Controller;
use App\Models\CustomPage;

class AdminPagesEditController extends Controller
{


    public function homePageEdit()
    {
        $homePageContent = HomePageContent::first();
        return Inertia::render('AdminDashboard/Pages/HomePageEdit', [
            'homePageContent'=>$homePageContent,
        ]);
    }

    public function aboutPageEdit()
    {
        $aboutPageContent = AboutPageContent::first();
        return Inertia::render('AdminDashboard/Pages/AboutPageEdit', [
            'aboutPageContent' => $aboutPageContent,
        ]);
    }

    public function contactPageEdit()
    {
        $contactPageContent = ContactPageContent::first();
        return Inertia::render('AdminDashboard/Pages/ContactPageEdit', [
            'contactPageContent' => $contactPageContent,
        ]);
    }

    public function morePagesEdit()
    {
        $customPages = CustomPage::all();
        return Inertia::render('AdminDashboard/Pages/MorePagesEdit', [
            'customPages' => $customPages,
        ]);
    }


    public function edit()
    {

        $siteIdentity = SiteIdentity::first();
        $footerContent = FooterContent::first();
        $homePageContent = HomePageContent::first();
        $aboutPageContent = AboutPageContent::first();
        $contactPageContent = ContactPageContent::first();
        $customPages = CustomPage::all();
        
        return Inertia::render('AdminDashboard/WebsiteContents/Edit', [
            'siteIdentity'=>$siteIdentity,
            'footerContent'=>$footerContent,
            'homePageContent'=>$homePageContent,
            'contactPageContent' => $contactPageContent,
            'aboutPageContent' => $aboutPageContent,
            'customPages' => $customPages,
        ]);
    }
}
