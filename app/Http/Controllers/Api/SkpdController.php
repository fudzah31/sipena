<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skpd;

class SkpdController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q', '');

        $skpds = Skpd::where('nama', 'like', "%{$search}%")
            ->select('id', 'nama as text')   // ✅ format yang diminta Select2
            ->orderBy('nama')
            ->limit(20)
            ->get();

        return response()->json(['results' => $skpds]);
    }
}
