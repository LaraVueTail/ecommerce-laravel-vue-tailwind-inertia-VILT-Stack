<?php
namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\FooterContent;
use App\Services\FileManagement;

class AdminFooterContentController extends Controller
{
    public function update(FooterContent $footerContent)
    {
        $attributes = $this->validateFooterContent($footerContent);  

        $footerContent->update($attributes);

        return back()->withErrors('FooterContentErrors')->with('success','Footer Updated!');

    }

    protected function validateFooterContent(?FooterContent $footerContent = null): array
    {
        $footerContent ??= new FooterContent();

        return request()->validateWithBag('FooterContentErrors',[
            'pageLinks' => 'nullable',
            'pageLinks.*' => 'nullable | max:200',
            'socialLinks' => 'nullable',
            'socialLinks.*' => 'nullable | max:200',
        ]);
    }

}
