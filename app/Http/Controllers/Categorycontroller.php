<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller 
{
    public function index()
    {
        $this->authorize('viewAny',new Categories());
        $categories=Categories::get();
        return view('category.index',compact('categories'));
    }

    public function create(Request $request)
    {
        
        $this->authorize('create',Categories::class);
        return view('category.create');
        
        //if($request->user()->cannot('create',Categories::class)){
        //    return view('categories.create');
        
        
        //}else{
        //    abort(403,'You cannot create beacuse you have no permission');
        //}
        
       
    }

    public function store(Request $request)
    {
        
        $this->authorize('create',Categories::class);

        $request->validate([
            'name' => 'required|max:255|string',//required, string and maximum no ofcharacter is 255
            'description' => 'required|max:255|string',//required, string and maximum no ofcharacter is 255
            'is_active' => 'sometimes'//optional, no validation will triggeer
        ]);

        Categories::create([ 
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0, // an if-else statement
        ]);

        return redirect('categories/create')->with('status', 'Category Created');//redirected to the 
                                                                                 //'categories/create' page and display a message
    }

    public function edit(Categories $category)
    {
        $this->authorize('update',$category);

       
        return view('category.edit',compact('category'));
    }

    public function update(Request $request, Categories $category)
    {
        $this->authorize('update',$category);


        $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'is_active' => 'sometimes'
        ]);
        Categories::findOrFail($category)->update([ 
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0, 
        ]);
        return redirect()->back()->with('status', 'Category Update'); 
    }

    public function destroy(int $id)
    {
        
       $category=Categories::findOrFail($id);
       $this->authorize('delete',$category);

       $category->delete();
       return redirect()->back()->with('status', 'Category Delete');
    }
}