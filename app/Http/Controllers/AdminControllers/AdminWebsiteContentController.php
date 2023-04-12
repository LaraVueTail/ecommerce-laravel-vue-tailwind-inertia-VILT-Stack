<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\AboutPageContent;
use App\Models\ContactPageContent;
use App\Models\HomePageContent;
use App\Models\ThemeOption;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class AdminWebsiteContentController extends Controller
{

    public function edit()
    {

        $homePageContent = HomePageContent::first();
        $aboutPageContent = AboutPageContent::first();
        $contactPageContent = ContactPageContent::first();
        
        return Inertia::render('AdminDashboard/WebsiteContents/Edit', [
            'homePageContent'=>$homePageContent,
            'contactPageContent' => $contactPageContent,
            'aboutPageContent' => $aboutPageContent
        ]);
    }
}
