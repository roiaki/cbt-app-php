<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Session;

class EventsController extends Controller
{
    // event一覧表示
    public function index()
    {
        $Event = new Event();
        $data = $Event->showEventIndex();

        return view('events.index', $data);
    }

    // 検索機能
    public function searchIndex(Request $request)
    {
        $Event = new Event();
        $data = $Event->serchIndex($request);

        return view('events.index', $data);
    }

    // getでevents/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        return view('events.create');
    }


    // 保存処理
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required|max:30',
                'content' => 'required|max:500',
            ]
        );

        $Event = new Event;
        $event = $Event->eventStore($request);

        return view('events.show', ['event' => $event]);
    }


    // 詳細ページ表示処理
    public function show($id)
    {
        $event = Event::find($id);
        return view('events.show', ['event' => $event]);
    }

    // 編集処理
    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', ['event' => $event]);
    }

    // 出来事更新処理
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:30',
            'content' => 'required|max:500',
        ]);

       $event = new Event;
       $event->eventUpdate($request, $id);
    
        return redirect('/events');
    }

    // deleteでcolumn/id　にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $event = new Event;
        $event->eventDelete($id);

        return redirect('events');
    }
}
