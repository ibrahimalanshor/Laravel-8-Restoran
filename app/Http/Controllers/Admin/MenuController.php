<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $menus = Menu::latest()->get();
            $data = Datatables::of($menus)
                    ->addIndexColumn()
                    ->addColumn('categories', function ($data)
                    {
                        return $data->categories()->get();
                    })
                    ->addColumn('action', function ($data)
                    {
                        $btn = '
                            <button class="btn btn-success edit btn-xs">Edit</button>
                            <button class="btn btn-danger btn-xs delete">Delete</button>
                            <a href="'.route('admin.menu.show', $data->id).'" class="btn btn-warning btn-xs show">Show</a>';
                        return $btn;
                    })
                    ->make(true);
            return $data;
        }
        
        return view('admin.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
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
            'name' => 'required|string|max:255|unique:menus',
            'price' => 'required|between:1,99999999.99',
            'description' => 'required',
            'file' => 'required|image',
            'categories' => 'required'
        ]);

        $fileName = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExt = $request->file->getClientOriginalExtension();
        $fileName = $fileName.'_'.time().'.'.$fileExt;

        $request->file->storeAs('public/images', $fileName);

        $request->merge(['photo' => $fileName]);

        $menu = Menu::create($request->all());
        $menu->categories()->attach($request->categories);

        return redirect('admin/menu')->with('success', 'Success Create Menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('admin.menu.show', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:menus,name,'.$menu->id,
            'price' => 'required|between:1,99999999.99',
            'description' => 'required',
            'file' => 'image|nullable'
        ]);

        if ($request->hasFile('file')) {
            $fileName = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileExt = $request->file->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$fileExt;

            $request->file->storeAs('public/images', $fileName);

            $request->merge(['photo' => $fileName]);
        }

        $menu->update($request->all());
        $menu->categories()->sync($request->categories);

        return response()->json(['message' => 'Success Update Menu']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::destroy($id);
        return response()->json(['message' => 'Success Delete Menu']);
    }
}
