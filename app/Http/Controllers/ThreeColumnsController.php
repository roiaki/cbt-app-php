<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\ThreeColumn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateThreeColumnRequest;
use App\Http\Requests\UpdateThreeColumnRequest;


class ThreeColumnsController extends Controller
{

    /**
     * 3コラム一覧表示処理
     * 
     * @return view('three_columns.index', $data);
     */
    public function index()
    {
        $threecolumns = new ThreeColumn;
        $data = $threecolumns->showThreecolIndex(); 

        return view('three_columns.index', $data);
    }

    /**
     * 3コラム検索処理
     * 
     * @param Request $request
     * @return view('three_columns.index', $data);
     */
    public function searchIndex(Request $request)
    {
        $threecolumns = new ThreeColumn;
        $data = $threecolumns->searchThreecolIndex($request);
        
        return view('three_columns.index', $data);
    }


    /**
     * 3コラム新規作成画面への遷移処理
     * 
     * @param int $id
     * @return view('three_columns.create', $data);
     */
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


    /**
     * 3コラム保存処理
     * 
     * @param Request $request
     * @return view('three_columns.show', $data);
     */
    public function store(CreateThreeColumnRequest $request)
    {
        // dd($request);
        $Threecolumn = new ThreeColumn;
        $three_column = $Threecolumn->storeThreecolumn($request);
        
        $id = $three_column->id;
        $data = $Threecolumn->showDetailThreecolumn($id);
       
        return view('three_columns.show', $data);
    }


    /**
     * 3コラム詳細画面へ遷移処理
     * 
     * @param int $id
     * @return view('three_columns.show', $data);
     */
    public function show($id)
    {
        $threecolumn = ThreeColumn::find($id);

        if(!isset($threecolumn)) {
            return redirect('/three_columns');
        }

        if(Auth::id() === $threecolumn->user_id) {
            $data = $threecolumn->showDetailThreecolumn($id);
            return view('three_columns.show', $data);
        } else {
            return redirect('/three_columns');
        }
    }


    /**
     * 3コラム編集画面へ遷移処理
     * 
     * @param int $id
     * @return view('three_columns.edit', $data);
     */
    public function edit($id)
    {
        $threecolumn = ThreeColumn::find($id);

        if(!isset($threecolumn)) {
            return redirect('/three_columns');
        }

        if(Auth::id() === $threecolumn->user_id) {
            $data = $threecolumn->getThreecolumn($id);
            return view('three_columns.edit', $data);
        } else {
            return redirect('/three_columns');
        }
    }
   

    /**
     * 3コラム更新処理
     * 
     * @param Request $request
     * @param int $id
     * @return redirect('/three_columns');
     */
    public function update(UpdateThreeColumnRequest $request, $id)
    {
        $threecolumn = ThreeColumn::find($id);

        if(!isset($threecolumn)) {
            return redirect('/three_columns');
        }

        if(Auth::id() === $threecolumn->user_id) {
            $threecolumn->updateThreecolumn($request, $id);
        }

        return redirect('/three_columns');
    }


    /**
     * 3コラム削除処理
     * 
     * @param int $id
     * @return redirect('/three_columns');
     */
    public function destroy($id)
    {
        $threecolumn = ThreeColumn::find($id);

        if(!isset($threecolumn)) {
            return redirect('/three_columns');
        }

        if(Auth::id() === $threecolumn->user_id) {
            $threecolumn->deleteThreecolumn($id);
        }
        return redirect('/three_columns');
    }


    /**
     * 説明画面遷移処理
     * 
     * @return view('users.info');
     */
    public function info()
    {
        return view('users.info');
    }

    public function infotest()
    {
        return view('users.infotest');
    }
}