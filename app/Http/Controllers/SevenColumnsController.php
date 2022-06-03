<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SevenColumn;
use App\Models\ThreeColumn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SevenColumnsController extends Controller
{
    // 一覧画面表示
    public function index()
    {
        $data = [];
        if (Auth::check()) {
            $user = Auth::user();
            $sevencolumns = $user->seven_columns()->orderBy('updated_at', 'desc')->paginate(5);
            $event = $user->events()->get();

            $data = [
                'event' => $event,
                'seven_columns' => $sevencolumns
            ];
        }
        return view('seven_columns.index', $data);
    }

    // 検索表示
    public function searchIndex(Request $request)
    {
        $keyword = $request->keyword;
        $id = Auth::user()->id;

        if (isset($keyword)) {
            $seven_columns = DB::table('sevencolumns')
                ->where('user_id', $id)
                ->where(function ($query) use ($keyword) {
                    $query->where('basis_thinking', 'like', '%' . $keyword . '%')
                        ->orWhere('opposite_fact', 'like', '%' . $keyword . '%')
                        ->orWhere('new_thinking', 'like', '%' . $keyword . '%');
                })
                ->orderBy('updated_at', 'desc')
                ->paginate(5);
        } else {
            return view('seven_columns.index');
        }

        $data = [
            'seven_columns' => $seven_columns,
            'keyword' => $keyword
        ];
        return view('seven_columns.index', $data);
    }
    
    // 7コラム新規作成画面へ遷移
    public function create($id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $three_column = ThreeColumn::where('id', $id)->where('user_id', $user_id)->first();

        $event_id = $three_column->event_id;

        $event = Event::where('id', $event_id)
                      ->where('user_id', $user_id)
                      ->first();

        return view('seven_columns.create', [
            'three_column' => $three_column,
            'event' => $event
        ]);
    }

    // 保存処理
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'basis_thinking' => 'required',
                'opposite_fact' => 'required',
                'new_thinking' => 'required',
                'new_emotion_strength' => 'required'
            ]
        );

        DB::transaction(function () use ($request) {

            $seven_column = new SevenColumn();

            $seven_column->user_id = Auth::id();
            $seven_column->threecol_id = $request->threecol_id;
            $seven_column->event_id = $request->event_id;

            $seven_column->basis_thinking = $request->basis_thinking;
            $seven_column->opposite_fact = $request->opposite_fact;
            $seven_column->new_thinking = $request->new_thinking;
            
            $seven_column->new_emotion_name = $request->new_emotion_name;
           
            if(isset($request->new_emotion_name00)) {
                $seven_column->new_emotion_name00 = $request->new_emotion_name00;
            }

            if(isset($request->new_emotion_name01)) {
                $seven_column->new_emotion_name01 = $request->new_emotion_name01;
            }

            if(isset($request->new_emotion_name02)) {
                $seven_column->new_emotion_name02 = $request->new_emotion_name02;
            }

            $seven_column->new_emotion_strength = $request->new_emotion_strength;

            if(isset($request->new_emotion_strength00)) {
                $seven_column->new_emotion_strength00 = $request->new_emotion_strength00;
            }

            if(isset($request->new_emotion_strength01)) {
                $seven_column->new_emotion_strength01 = $request->new_emotion_strength01;
            }

            if(isset($request->new_emotion_strength02)) {
                $seven_column->new_emotion_strength02 = $request->new_emotion_strength02;
            }

            $seven_column->save();
        });

        return redirect('seven_columns');
    }

    // 詳細ページ表示処理
    public function show($id)
    {
        $seven_column = SevenColumn::find($id);
        
        $threecol_id = $seven_column->threecol_id;
        $three_column = ThreeColumn::find($threecol_id);

        $event_id = $seven_column->event_id;
        $event = Event::find($event_id);

        $habit_names = [];
        // 考え方の癖 取得
        foreach ($three_column->habit as $habit) {
            $habit_names[] = $habit->habit_name;
        }

        return view('seven_columns.show', [
            'event' => $event,
            'three_column' => $three_column,
            'seven_column' => $seven_column,
            'habit_names'  => $habit_names
        ]);
    }

    // 編集画面表示処理
    public function edit($id)
    {
        $seven_column = SevenColumn::find($id);

        $threecol_id = $seven_column->threecol_id;
        $event_id = $seven_column->event_id;

        $three_column = ThreeColumn::find($threecol_id);
        $event = Event::find($event_id);
        
        return view('seven_columns.edit', [
            'event' => $event,
            'three_column' => $three_column,
            'seven_column' => $seven_column
        ]);
    }

    // update処理
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'basis_thinking' => 'required',
                'opposite_fact' => 'required',
                'new_thinking' => 'required',
                'new_emotion_strength' => 'required'
            ]
        );

        $seven_column = SevenColumn::find($id);
        
        $seven_column->basis_thinking = $request->basis_thinking;
        $seven_column->opposite_fact = $request->opposite_fact;
        $seven_column->new_thinking = $request->new_thinking;

        $seven_column->new_emotion_strength = $request->new_emotion_strength;

        if(isset($request->new_emotion_strength00)) {
            $seven_column->new_emotion_strength00 = $request->new_emotion_strength00;
        }

        if(isset($request->new_emotion_strength01)) {
            $seven_column->new_emotion_strength01 = $request->new_emotion_strength01;
        }

        if(isset($request->new_emotion_strength02)) {
            $seven_column->new_emotion_strength02 = $request->new_emotion_strength02;
        }

        $seven_column->updated_at = date('Y-m-d G:i:s');

        $seven_column->save();

        // session()->flash('flash_message', 'kousinn が失敗しました。');

        return redirect('seven_columns');
    }

    // 削除処理
    public function destroy($id)
    {
        $seven_column = SevenColumn::find($id);
        $seven_column->delete();

        return redirect('seven_columns');
    }
}
