<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\App;


class EventsController extends Controller
{
    /**
     * 出来事の一覧表示
     */
    public function index()
    {
        $Event = new Event();
        $data  = $Event->showEventIndex();
        return view('events.index', $data);
    }

    /**
     * 出来事の検索機能
     */
    public function searchIndex(Request $request)
    {
        $Event = new Event();
        $data  = $Event->serchIndex($request);
        return view('events.index', $data);
    }


    /**
     * 出来事の新規作成画面へ遷移
     */
    public function create()
    {
        $locale = App::currentLocale();
        return view('events.create', ['locale' => $locale]);
    }


    /**
     * 出来事の保存機能
     */
    public function store(CreateEventRequest $request)
    {
        $Event = new Event;
        $event = $Event->storeEvent($request);
        return view('events.show', ['event' => $event]);
    }


    /**
     * 出来事の詳細画面の表示
     */
    public function show($id)
    {
        $event = Event::find($id);

        if(!isset($event)) {
            return redirect('/events');
        }

        if(Auth::id() === $event->user_id) {
            return view('events.show', ['event' => $event]);
        }

        return redirect('/events');
    }


    /**
     * 出来事の編集画面へ遷移
     */
    public function edit($id)
    {
        $event = Event::find($id);

        if(!isset($event)) {
            return redirect('/events');
        }

        if(Auth::id() === $event->user_id) {
            return view('events.edit', ['event' => $event]);
        }

        return redirect('/events');
    }


    /**
     * 出来事の更新機能
     */
    public function update(UpdateEventRequest $request, $id)
    {

        $event = Event::find($id);

        if(!isset($event)) {
            return redirect('/events');
        }

        if(Auth::id() === $event->user_id) {
            $event->updateEvent($request, $id);
        }
        
        return redirect('/events');
    }


    /**
     * 出来事の削除機能
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        if(!isset($event)) {
            return redirect('events');
        }
        if(Auth::id() === $event->user_id) {
            $event->eventDelete($id);
        }

        return redirect('events');
    }
}
