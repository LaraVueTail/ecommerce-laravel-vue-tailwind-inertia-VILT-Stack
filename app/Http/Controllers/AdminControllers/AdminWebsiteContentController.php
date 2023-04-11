<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\AboutPageContent;
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
        $aboutPageContent = AboutPageContent::first();
        $aboutPageContent->aboutImage = $this->getUrl($aboutPageContent->aboutImage); 

        return Inertia::render('AdminDashboard/WebsiteContents/Edit', [
            'aboutPageContent' => $aboutPageContent
        ]);
        

    }

    public function getUrl($file)
    {
        return asset($file);
    }



}
