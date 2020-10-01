<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::latest()->get();
            return Datatables::of($categories)
                    ->addIndexColumn()
                    ->addColumn('action', function ()
                    {
                        $btn = '
                            <button class="btn btn-xs btn-success edit">Edit</button>
                            <button class="btn btn-xs btn-danger delete">Delete</button>
                        ';
                        return $btn;
                    })
                    ->make(true);
        }
        return view('admin.category.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories'
        ]);

        Category::create($request->all());

        return response()->json(['message' => 'Success Create Category']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,'.$category->id
        ]);

        $category->update($request->all());

        return response()->json(['message' => 'Success Edit Category']);
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

        return response()->json(['message' => 'Success Delete Category']);
    }

    // Select2
    public function get(Request $request)
    {
        $name = $request->name;
        $categories = Category::where('name', 'like', '%'.$name.'%')->get(['id', 'name as text']);
        return $categories;
    }
}
