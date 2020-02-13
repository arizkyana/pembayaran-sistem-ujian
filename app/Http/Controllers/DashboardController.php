<?php

namespace App\Http\Controllers;

use App\Semester;
use App\ItemPembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $this->authorize('dashboard');
        // semester
        $semester = Semester::all();
        $item_pembayaran = ItemPembayaran::all();

        return view('dashboard.index')->with([
        'semester' => $semester,
        'item_pembayaran' => $item_pembayaran
        ]);
    }
}
