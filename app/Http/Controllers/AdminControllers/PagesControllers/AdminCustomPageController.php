<?php

namespace App\Http\Controllers\AdminControllers\PagesControllers;
use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use App\Services\FileManagement;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AdminCustomPageController extends Controller
{

    public function edit()
    {
        $customPages = CustomPage::all();
        return Inertia::render('AdminDashboard/Pages/MorePagesEdit', [
            'customPages' => $customPages,
        ]);
    }
    
    public function store()
    {
        $attributes = $this->validateCustomPage();
        CustomPage::create($attributes);

        return back()->withErrors('CustomPagesErrors')->with('success','Page Created!');

    }
    
    public function update(CustomPage $customPage,FileManagement $fileManagement)
    {
        $attributes = $this->validateCustomPage($customPage);  

        if($attributes['image'] ?? false){
            $attributes['image'] = 
            $fileManagement->uploadFile(
                file:$attributes['image'] ?? false,
                deleteOldFile:true, 
                oldFile:$customPage->image,
                path:'images/custom-pages/'.($customPage['slug'] !== $attributes['slug'] ? $attributes['slug'] : $customPage['slug']),
                storeAsName: 'image'
            );   
        }

        if($customPage->slug !== $attributes['slug']){
            $fileManagement->moveFiles(
                oldPath:'images/custom-pages/'.$customPage['slug'],
                newPath:'images/custom-pages/'.$attributes['slug'],
                deleteDirectory: 'images/custom-pages/'.$customPage['slug']
            );
            $attributes['image'] = str_replace($customPage['slug'],$attributes['slug'],$customPage['image']);
        }

        $customPage->update($attributes);

        return back()->withErrors('CustomPagesErrors')->with('success','Page Updated!');

    }

    protected function validateCustomPage(?CustomPage $customPage = null): array
    {
        $customPage ??= new CustomPage();

        return request()->validateWithBag('customPagesErrors_'.$customPage->id,[
            'name' => 'required|max:50',
            'slug' => ['required', Rule::unique('custom_pages', 'slug')->ignore($customPage)],
            'title' => 'required|max:1000',
            'sub_title' => 'nullable|max:1000',
            'content' => 'nullable|max:5000',
            'image' => 'nullable|mimes:jpg,jpeg,png |max:2096',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
        ]);
    }

}
