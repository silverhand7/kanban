<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Column;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function index()
    {
        return Column::with('cards')->orderBy('order', 'asc')->get();
    }

    public function move(Request $request)
    {
        if ($request->oldOrder == 0) {
            Column::where('order', $request->oldOrder + 1)->update(['order' => $request->oldOrder]);
            Column::where('order', $request->newOrder)->update(['order' => $request->newOrder - 1]);
        } else {
            Column::where('order', $request->newOrder)->update(['order' => $request->oldOrder]);
        }
        Column::find($request->id)->update(['order' => $request->newOrder]);

        return true;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $columnId = Column::create([
            'name' => $request->name,
            'order' => Column::max('order') + 1,
        ])->id;

        return Column::with('cards')->find($columnId);
    }

    public function update(Request $request, $id) {
        return Column::find($id)->update([
            'name' => $request->name
        ]);
    }

    public function destroy($id) {
        Card::where('column_id', $id)->delete();
        Column::find($id)->delete();
        return true;
    }
}
