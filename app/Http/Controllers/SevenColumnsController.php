<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SevenColumn;
use App\Models\ThreeColumn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateSevenColumnRequest;
use App\Http\Requests\UpdateSevenColumnRequest;
use App\Models\Emotion;

class SevenColumnsController extends Controller
{
    // 7コラム一覧画面表示
    public function index()
    {
        $sevencolumns = new SevenColumn;
        $data = $sevencolumns->showSevencolumnIndex();

        return view('seven_columns.index', $data);
    }

    // 7コラム検索表示
    public function searchIndex(Request $request)
    {
        $sevencolumns = new SevenColumn;
        $data = $sevencolumns->searchSevencolumnIndex($request);
        return view('seven_columns.index', $data);
    }
    
    // 7コラム新規作成画面へ遷移
    public function create($id)
    {
        $sevencolumn = new SevenColumn;
        $data = $sevencolumn->createSevencolumn($id);

        return view('seven_columns.create', $data);
    }

    // 7コラム保存処理
    public function store(CreateSevenColumnRequest $request)
    {
        $sevencolumn = new sevencolumn;
        $sevencolumn->storeSevencolumn($request);

        return redirect('seven_columns');
    }

    // 7コラム詳細ページ表示処理
    public function show($id)
    {
        $sevencolumn = SevenColumn::find($id);

        if(!isset($sevencolumn)) {
            return redirect('seven_columns');
        }

        if(Auth::id() === $sevencolumn->user_id) {
            $data = $sevencolumn->showDetailSevencolumn($id);
            return view('seven_columns.show', $data);
        } else {
            return redirect('seven_columns');
        }    
    }

    // 7コラム編集画面表示処理
    public function edit($id)
    {
        $sevencolumn = SevenColumn::find($id);

        if(!isset($sevencolumn)) {
            return redirect('seven_columns');
        }

        if(Auth::id() === $sevencolumn->user_id) {
            $data = $sevencolumn->showEditSevencolumn($id);
            return view('seven_columns.edit', $data);
        } else {
            return redirect('seven_columns');
        } 
    }

    // 7コラム更新処理
    public function update(UpdateSevenColumnRequest $request, $id)
    {
        $sevencolumn = new SevenColumn;

        if(!isset($sevencolumn)) {
            return redirect('seven_columns');
        }

        $sevencolumn->updateSevencolumn($request, $id);

        return redirect('seven_columns');
    }

    // 7コラム削除処理
    public function destroy($id)
    {
        $sevencolumn = SevenColumn::find($id);

        if(!isset($sevencolumn)) {
            return redirect('seven_columns');
        }
        
        if(Auth::id() === $sevencolumn->user_id) {
            $sevencolumn->deleteSevencolumn($id);
        }
       
        return redirect('seven_columns');
    }
}
