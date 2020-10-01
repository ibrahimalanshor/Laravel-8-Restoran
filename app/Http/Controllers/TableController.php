<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Table;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::with('order')->get();

        return view('table.index', compact('tables'));
    }
}
