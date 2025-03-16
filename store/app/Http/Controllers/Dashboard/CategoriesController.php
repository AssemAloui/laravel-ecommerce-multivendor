<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view("dashboard.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::all();
        return view("dashboard.categories.create", compact("parents"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);

        Category::create($request->all());

        return redirect()->route("dashboard.categories.index")->with("success", "Category created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route("dashboard.categories.index")->with("info", "Category not found!");
        }
        // select * from categories where id <> $id
        // and (parent_id is null or parent_id <> $id)

        $parents = Category::where("id", "!=", $id)
            ->where(function ($query) use ($id) {
                $query->whereNull("parent_id")
                      ->orWhere("parent_id", "!=", $id);
            })->get();

        // $parents = Category::where("id", "!=", $id)->get();  
        return view("dashboard.categories.edit", compact("category", "parents"));
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Category = Category::findOrFail($id);
        $Category->update($request->all());
        return redirect()->route("dashboard.categories.index")->with("success", "Category updated!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route("dashboard.categories.index")->with("success", "Category deleted!");

    }
}
