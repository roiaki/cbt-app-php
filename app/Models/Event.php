<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;
    /*
     * テーブルの主キー
     * 
     * @var string
     */
    //protected $primaryKey = 'event_id';
    
    // fillableに指定したカラムのみ、create()やfill()、update()で値が代入されます。
    // ブラックリスト
    protected $guarded = ['id'];

    /*
     * 1対多（逆）所属
     * 子（Event）を所有している親（user）を取得 
     */
    public function user()
    {
        // belongsTo 子から親へ　従から主へ
        // 第1引数：リレーション先の親モデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        //return $this->belongsTo(User::class, 'user_id', 'user_id');
        return $this->belongsTo(User::class);
    }

    // 親から子へ
    public function three_column()
    {
        // 第1引数：リレーション先の親モデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        //return $this->hasOne(ThreeColumn::class, 'event_id', 'event_id');
        return $this->hasMany(ThreeColumn::class, 'event_id', 'id');
    }

    /** 
     * 出来事一覧表示処理
     * 
     * ログイン済みならば表示させる。
     * 
     * @return array $data 
     * 
     */
    public function showEventIndex()
    {
        $data = [];
        if (Auth::check()) {
            $user = Auth::user();
            $events = $user->events()->orderBy('updated_at', 'desc')->paginate(5);

            $data = [
                'events' => $events,
            ];
        }
        return $data;
    }

    /**
     * 出来事一覧画面での検索処理
     * 
     * 検索ワードが空の時は更新日の降順で一覧表示する
     * 
     * @param Requset $request
     * @return array $data
     * 
     */
    public function serchIndex(Request $request)
    {   
        $keyword = $request->keyword;
        $id = Auth::user()->id;
      
        if (isset($keyword)) {           
            $events = DB::table('events')
                ->where('user_id', $id)
                ->where(function($query) use($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                          ->orWhere('content', 'like', '%' . $keyword . '%');
                  })
                  ->orderBy('updated_at', 'desc')
                  ->paginate(10);

            $data = [
                'events' => $events,
                'keyword' => $keyword
            ];
            return $data;

        } else {
            $user = Auth::user();
            $events = $user->events()->orderBy('updated_at', 'desc')->paginate(5);
            
            $data = [
                'events' => $events,
                'keyword' => $keyword
            ];
            return $data;
        } 
    }

    /**
     * 出来事保存処理
     * 
     * @param Request $request
     * @return object $event
     * 
     */
    public function eventStore(Request $request) 
    {   
        $event = new Event;
        $event->title = $request->title;
        $event->content = $request->content;
        $event->user_id = Auth::id();

        $event->save();

        return $event;
    }

    /**
     * 出来事更新処理
     * 
     * @param Request $request
     * @param int $id
     * @return objent $event
     * 
     */
    public function eventUpdate(Request $request, $id)
    {
        $event = Event::find($id);
        if(Auth::id() === $event->user_id) {
            $event->title = $request->title;
            $event->content = $request->content;
            $event->updated_at = date("Y-m-d G:i:s");
            $event->save();
        }
    }

    /**
     * 出来事削除処理
     * 
     * @param int $id
     * 
     */
    public function eventDelete($id)
    {
        $event = Event::find($id);
        if(Auth::id() === $event->user_id){
            $event->delete();
        }
    }

    /**
     * 出来事のuser_idがログインユーザーとidと同一か判定するメソッド
     * 
     */
    public function examiningUser($id)
    {
        $event = Event::find($id);
        if(Auth::id() === $event->user_id) {
            return true;
        } else {
            return false;
        }
    }
}
