<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = 'Dashboard - Categories';
       $categories = Category::all();

       return view('category.view')->with(compact('categories','title'));

    }

    public function view()
    {
        $title = 'Dashboard - Categories';
        return view('category.view')->with(compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Dashboard - Categories';
        return view('category.create')->with(compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $category =Category::create($request->all());
            $messageType = 1;
            $message = "Category created successfully !";

        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Category creation failed !";
        }

        return redirect(route('category.index'))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $title = 'Dashboard - Categories';
        $category = Category::where('id',$id)->first();
        return view('category.edit')->with(compact('category','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        try {

            $category = Category::find($id);

            $category->update($request->all());

            $messageType = 1;
            $message = "Category ".$category->category_name." details updated successfully !";

        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Category updation failed !";
        }

        return redirect(route('category.index'))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {

            $category = Category::find($id);

            $category->delete();

            $messageType = 1;
            $message = "Category ".$category->category_name." details deleted successfully !";

        } catch(\Illuminate\Database\QueryException $ex){
            $messageType = 2;
            $message = "Category deletion failed !";
        }

        return redirect(route('category.index'))->with('messageType',$messageType)->with('message',$message);
    }
}
