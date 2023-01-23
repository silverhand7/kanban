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

    public function store(Request $request) {
        return Card::create([
            'title' => $request->title,
            'description' => $request->description,
            'column_id' => $request->column_id,
            'order' => Card::where('column_id', $request->column_id)->max('order') + 1,
        ]);
    }

    public function update(Request $request, $id) {
        $card = Card::findOrFail($id);
        $card->title = $request->title;
        $card->description = $request->description;
        $card->save();
        return $card;
    }

    public function delete($id)
    {
        return Card::findOrFail($id)->delete();
    }
}
