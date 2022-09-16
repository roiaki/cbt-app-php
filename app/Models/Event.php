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

    /**
     * Evnet(従) -> User(主)
     * 多対１
     */
    public function user()
    {
        // belongsTo 子から親へ　従から主へ
        // 第1引数：リレーション先の親モデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        return $this->belongsTo(User::class);
    }

    /**
     * Event(主) -> Threecolumn(従)
     * 1対多
     */
    public function three_column()
    {
        // 第1引数：リレーション先の親モデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        return $this->hasMany(ThreeColumn::class, 'event_id', 'id');
    }

    /**
     * Event(主) -> Sevencolumn(従)
     * 1対多
     */
    public function seven_columns()
    {
        return $this->hasMany(SevenColumn::class, 'event_id', 'id');
    }

    /**
     * Event(主) -> NewEmotion(従)
     * 1 to Many
     */
    public function new_emotions()
    {
        return $this->hasMany(NewEmotion::class, 'event_id', 'id');
    }


    /** 
     * 出来事一覧表示処理
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
                'events'  => $events,
                'keyword' => $keyword
            ];
            return $data;

        } else {
            $user = Auth::user();
            $events = $user->events()->orderBy('updated_at', 'desc')->paginate(5);
            
            $data = [
                'events'  => $events,
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
    public function storeEvent(Request $request) 
    {   
        $event = Event::create([
            'title'   => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ]);
        
        // 二重送信対策
        $request->session()->regenerateToken();

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
    public function updateEvent(Request $request, $id)
    {
        $event = Event::find($id);
        if(Auth::id() === $event->user_id) {
            $event->title      = $request->input('title');
            $event->content    = $request->input('content');
            $event->updated_at = date("Y-m-d G:i:s");
            
            // 二重送信対策
            $request->session()->regenerateToken();

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
