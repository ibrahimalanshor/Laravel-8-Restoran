<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Models\Table;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tables = Table::withCount(['order as status' => function ($order)
            {
                $order->whereActive(true);
            }])->get();
            return Datatables::of($tables)
                    ->addIndexColumn()
                    ->addColumn('action', '<button class="btn btn-xs btn-danger delete">Delete</delete>')
                    ->make(true);
        }
        return view('admin.table.index');
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
            'no' => 'required|integer|unique:tables'
        ]);

        Table::create($request->all());

        return response()->json(['message' => 'Success Create Table']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Table::destroy($id);
        return response()->json(['message' => 'Success Delete Table']);
    }
}
