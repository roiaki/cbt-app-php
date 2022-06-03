<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\ThreeColumn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ThreeColumnsController extends Controller
{
    // 一覧表示
    public function index()
    {
        $data = [];
        if (Auth::check()) {
            $user = Auth::user();
            $three_columns = $user->three_columns()
                ->orderBy('updated_at', 'desc')
                ->paginate(5);

            $data = [
                'three_columns' => $three_columns,
            ];
        }

        return view('three_columns.index', $data);
    }

    // 検索表示
    public function searchIndex(Request $request)
    {
        if (Auth::check()) {
            $keyword = $request->keyword;
            $id = Auth::user()->id;
            
            if (isset($keyword)) {
                $three_columns = ThreeColumn::where('user_id', $id)
                    ->where(function($query) use($keyword) {
                        $query->orwhere('emotion_name', 'like', '%' . $keyword . '%')
                              ->orWhere('thinking', 'like', '%' . $keyword . '%');
                       
                    })
                ->orderBy('updated_at', 'desc')
                ->paginate(5);
            } else {
                return view('three_columns.index');
            }
            
            $data = [
                'three_columns' => $three_columns,
                'keyword' => $keyword
            ];
        }
        return view('three_columns.index', $data);
    }

    // getでアクセスされた場合の「新規登録画面表示処理」
    public function create($id)
    {
        $user = Auth::user();
        $user_id = $user->id;
//dd($id);
        $event = Event::where('id', $id)->where('user_id', $user_id)->first();
//dd($event);
        $data = [
            'event' => $event,
        ];

        return view('three_columns.create', $data);
    }

    // 保存処理
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'emotion_name_def' => 'required',
                'emotion_strength_def' => 'required',
                'thinking' => 'required',
                'habit' => 'required'
            ]
        );

        //dd($request);
        $three_column = new ThreeColumn;

        // クロージャでトランザクション処理
        DB::transaction(function () use ($three_column, $request) {

            $three_column->user_id = Auth::id();
            $three_column->event_id = $request->eventid;

            $three_column->emotion_name = $request->emotion_name_def;
            $three_column->emotion_strength = $request->emotion_strength_def;

            //dd($three_column->emotion_strength[0]);
            if(isset($request->emotion_name[0])) {
                $three_column->emotion_name00 = $request->emotion_name[0];   
            }
           
            if(isset($request->emotion_name[1])) {
                $three_column->emotion_name01 = $request->emotion_name[1];
            }

            if(isset($request->emotion_name[2])) {
                $three_column->emotion_name02 = $request->emotion_name[2];
            }

            if( isset($request->emotion_strength[0])) {
                $three_column->emotion_strength00 = $request->emotion_strength[0];
            }

            if(isset($request->emotion_strength[1])) {
                $three_column->emotion_strength01 = $request->emotion_strength[1];
            }

            if(isset($request->emotion_strength[2])) {
                $three_column->emotion_strength02 = $request->emotion_strength[2];
            }
           

            $three_column->thinking = $request->thinking;

            // 中間テーブルの保存はthree_column保存の後でないとidがない
            $three_column->save();

            if (isset($request->habit[0])) {
                if ($request->habit[0] == "on") {
                    $three_column->habit()->attach(1);
                }
            }

            if (isset($request->habit[1])) {
                if ($request->habit[1] == "on") {
                    $three_column->habit()->attach(2);
                }
            }

            if (isset($request->habit[2])) {
                if ($request->habit[2] == "on") {
                    $three_column->habit()->attach(3);
                }
            }

            if (isset($request->habit[3])) {
                if ($request->habit[3] == "on") {
                    $three_column->habit()->attach(4);
                }
            }

            if (isset($request->habit[4])) {
                if ($request->habit[4] == "on") {
                    $three_column->habit()->attach(5);
                }
            }

            if (isset($request->habit[5])) {
                if ($request->habit[5] == "on") {
                    $three_column->habit()->attach(6);
                }
            }

            if (isset($request->habit[6])) {
                if ($request->habit[6] == "on") {
                    $three_column->habit()->attach(7);
                }
            }

            $three_column->save();
        });
        // end transaction

        return redirect('/three_columns');
    }

    // 詳細ページ表示処理
    public function show($id)
    {
        $three_column = ThreeColumn::find($id);
        $event_id = $three_column->event_id;
        $event = Event::find($event_id);
        $habit_id = [];

        // 考え方の癖 id 取得
        foreach ($three_column->habit as $habit) {
            $habit_id[] = $habit->id;
        }

        $user = Auth::user();

        $data = [
            'user' => $user,
            'event' => $event,
            'habit_id' => $habit_id,
            'three_column' => $three_column
        ];

        // $data 配列そのまま渡すか、連想配列として渡すかでbladeでのアクセス方法が変わる
        // return view('three_columns, ['data' => $data]);
        return view('three_columns.show', $data);
    }

    // 編集処理
    public function edit($id)
    {
        //dd($id);
        $three_column = ThreeColumn::find($id);

        $event_id = $three_column->event_id;
        $event = Event::find($event_id);

        $habit_id = [];
        
        // 考え方の癖 id 取得
        foreach ($three_column->habit as $habit) {
            $habit_id[] = $habit->id;
        }

        $data = [
            'three_column' => $three_column,
            'habit_id' => $habit_id,
            'event' => $event
        ];

        //dd($three_column);
        return view('three_columns.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'emotion_name' => 'required',
            'emotion_strength' => 'required',
            'thinking' => 'required',
            'habit' => 'required'
        ]);

        // クロージャでトランザクション処理開始
        DB::transaction(function () use ($request, $id) {

            $three_column = ThreeColumn::find($id);

            $three_column->emotion_name = $request->emotion_name;
            $three_column->emotion_strength = $request->emotion_strength;

            if(isset($request->emotion_name00)) {
                $three_column->emotion_name00 = $request->emotion_name00;
            }
            
            if(isset($request->emotion_name01)) {
                $three_column->emotion_name01 = $request->emotion_name01;
            }
            
            if(isset($request->emotion_name02)) {
                $three_column->emotion_name02 = $request->emotion_name02;
            }

            if(isset($request->emotion_strength00)) {
                $three_column->emotion_strength00 = $request->emotion_strength00;
            }

            if(isset($request->emotion_strength01)) {
                $three_column->emotion_strength01 = $request->emotion_strength01;
            }

            if(isset($request->emotion_strength02)) {
                $three_column->emotion_strength02 = $request->emotion_strength02;
            }

            
            $three_column->thinking = $request->thinking;

            $three_column->updated_at = date("Y-m-d G:i:s");

            $three_column->save();

            // 考えの癖を中間テーブルで更新
            if (isset($request->habit[0])) {
                if ($request->habit[0] == "on") {
                    $three_column->habit()->syncWithoutDetaching(1);
                }
            } else {
                $three_column->habit()->detach(1);
            }

            if (isset($request->habit[1])) {
                if ($request->habit[1] == "on") {
                    $three_column->habit()->syncWithoutDetaching(2);
                }
            } else {
                $three_column->habit()->detach(2);
            }

            if (isset($request->habit[2])) {
                if ($request->habit[2] == "on") {
                    $three_column->habit()->syncWithoutDetaching(3);
                }
            } else {
                $three_column->habit()->detach(3);
            }

            if (isset($request->habit[3])) {
                if ($request->habit[3] == "on") {
                    $three_column->habit()->syncWithoutDetaching(4);
                }
            } else {
                $three_column->habit()->detach(4);
            }

            if (isset($request->habit[4])) {
                if ($request->habit[4] == "on") {
                    $three_column->habit()->syncWithoutDetaching(5);
                }
            } else {
                $three_column->habit()->detach(5);
            }

            if (isset($request->habit[5])) {
                if ($request->habit[5] == "on") {
                    $three_column->habit()->syncWithoutDetaching(6);
                }
            } else {
                $three_column->habit()->detach(6);
            }

            if (isset($request->habit[6])) {
                if ($request->habit[6] == "on") {
                    $three_column->habit()->syncWithoutDetaching(7);
                }
            } else {
                $three_column->habit()->detach(7);
            }
            //dd($three_column->habit());
        });
        // end transaction

        return redirect('/three_columns');
    }

    // deleteでcolumn/id　にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $three_column = ThreeColumn::find($id);
        $three_column->delete();

        return redirect('/three_columns');
    }

    // 説明ページ表示
    public function info()
    {
        return view('/users/info');
    }
}
