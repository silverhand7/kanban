<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function move(Request $request)
    {
        if ($request->type == 'added' || $request->type == 'moved') {
            Card::find($request->id)->update([
                'column_id' => $request->columnId,
            ]);

            foreach($request->cards as $card) {
                Card::find($card['id'])->update([
                    'order' => $card['order'],
                ]);
            }
        }

        return true;
    }
}
