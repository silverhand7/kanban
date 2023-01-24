<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class ApiCardController extends Controller
{
    public function get(Request $request)
    {
        if ($request->key != '8dg058opcx') {
            return abort(401);
        }

        $date = $request->date;
        $columnId = $request->column_id;

        return Card::query()
        ->when(!empty($date), function($query) use ($date){
            $query->whereDate('created_at', $date);
        })
        ->when(!empty($columnId), function($query) use($columnId) {
            $query->whereColumnId($columnId);
        })
        ->orderBy('id', 'asc')->get();
    }
}
