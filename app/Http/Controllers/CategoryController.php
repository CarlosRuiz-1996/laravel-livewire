<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class CategoryController extends Controller
{
    public function  index()  {
        $categories = Category::orderBy('id','desc')->paginate(10);

        return view('categorias.index', compact('categories'));
    }

    public function  create()  {

        return view('categorias.form');
    }

    public function  save(Request $request)  {
       
        $validate = $this->validate($request, [
            'name'=>'required|max:20'
        ],['name'=>'campo requerido']);

        $category = new Category();

        $category->name = $request->name;

        $category->save();

        return redirect()->route('category');
    }


    
    public function  edit(Category $category)  {
        return view('categorias.form', compact('category'));
    }


    public function  update(Request $request)  {

        
       $id = $request->input('id');

       
       $category = Category::findOrFail($id);

        $validate = $this->validate($request, [
            'name'=>'required|max:20'
        ],['name'=>'campo requerido']);


        $category->name = $request->name;

        
        $category->update();

        return redirect()->route('category');
    }


    public function delete(Category $category){

        $category->delete();
        return redirect()->route('category');

    }
}
