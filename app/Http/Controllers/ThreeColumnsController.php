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
        $threecolumns = new ThreeColumn;
        $data = $threecolumns->showThreecolIndex(); 

        return view('three_columns.index', $data);
    }

    // 検索表示
    public function searchIndex(Request $request)
    {
        $threecolumns = new ThreeColumn;
        $data = $threecolumns->searchThreecolIndex($request);
        
        return view('three_columns.index', $data);
    }

    // getでアクセスされた場合の「新規登録画面表示処理」
    public function create($id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $event = Event::where('id', $id)->where('user_id', $user_id)->first();

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
                'thinking' => 'required|max:500',
                'habit' => 'required'
            ]
        );

        $threecolumn = new ThreeColumn;
        $threecolumn->storeThreecolumn($request);

        return redirect('/three_columns');
    }

    // 詳細ページ表示処理
    public function show($id)
    {
        $threecolumn = new ThreeColumn;
        $data = $threecolumn->showDetailThreecolumn($id);

        return view('three_columns.show', $data);
    }

    // 3コラム編集画表示処理
    public function edit($id)
    {
        $threecolumn = new ThreeColumn;
        $data = $threecolumn->showEditThreecolumn($id);

        return view('three_columns.edit', $data);
    }

    // 3コラム更新処理
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'emotion_name' => 'required',
            'emotion_strength' => 'required',
            'thinking' => 'required|max:500',
            'habit' => 'required'
        ]);
        $threecolumns = new ThreeColumn;
        $threecolumns->updateThreecolumn($request, $id);

        return redirect('/three_columns');
    }

    // deleteでcolumn/id　にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $threecolumn = new ThreeColumn;
        $threecolumn->deleteThreecolumn($id);

        return redirect('/three_columns');
    }

    // 説明ページ表示
    public function info()
    {
        return view('/users/info');
    }
}