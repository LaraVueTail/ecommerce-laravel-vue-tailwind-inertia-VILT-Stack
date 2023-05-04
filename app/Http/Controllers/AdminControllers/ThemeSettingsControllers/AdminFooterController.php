<?php

namespace App\Http\Controllers\AdminControllers\ThemeSettingsControllers;
use App\Http\Controllers\Controller;
use App\Models\ThemeSettings\FooterContent;
use Inertia\Inertia;

class AdminFooterController extends Controller
{

    public function edit()
    {
        $footerContent = FooterContent::first();
        return Inertia::render('AdminDashboard/ThemeSettings/Footer', [
            'footerContent'=>$footerContent,
        ]);
    }

    public function update()
    {
        $footerContent = FooterContent::first();

        $attributes = $this->validateFooterContent($footerContent);  

        $footerContent->update($attributes);

        return back()->with('success','Footer Updated!');

    }

    protected function validateFooterContent(?FooterContent $footerContent = null): array
    {
        $footerContent ??= new FooterContent();

        return request()->validate([
            'pageLinks' => 'nullable',
            'pageLinks.*' => 'nullable | max:200',
            'socialLinks' => 'nullable',
            'socialLinks.*' => 'nullable | max:200',
        ]);
    }

}
