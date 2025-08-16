<?php

namespace App\Http\Controllers;

use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::where('is_visible', true)
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        return view('promo.index', compact('promos'));
    }
}