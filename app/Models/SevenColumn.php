<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SevenColumn extends Model
{
    // ブラックリスト
    protected $guarded = ['id'];

    // テーブルの紐付け(テーブル名がモデル名の複数形の場合は記述の必要なし)
    protected $table = 'sevencolumns';

    // プライマリキー(主キーカラム名がidの場合は記述の必要なし)
    //protected $primaryKey = 'id';

    // Userモデルとの紐づけ
    public function user() {
        
        return $this->belongsTo(User::class);

    }

    public function event()
    {
        // belongsTo 子から親へ　従から主へ
        // 第1引数：リレーション先の親モデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        //return $this->belongsTo(Event::class, 'event_id', 'event_id'); 
        return $this->belongsTo(Event::class, 'event_id', 'id'); 
    }

    public function threecolumn()
    {
        // belongsTo 子から親へ　従から主へ
        // 第1引数：リレーション先の親モデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        return $this->belongsTo(Threecolumn::class, 'threecol_id', 'id');
    }

    /**
     * 一覧表示処理
     * 
     * @return array $data
     */
    public function showSevencolumnIndex()
    {
        $data = [];
        if (Auth::check()) {
            $user = Auth::user();
            $sevencolumns = $user->seven_columns()->orderBy('updated_at', 'desc')->paginate(5);
            $event = $user->events()->get();
            // @check
            $data = [
                'event' => $event,
                'seven_columns' => $sevencolumns
            ];
        }
        return $data;
    }

    /**
     * 7コラム検索一覧表示処理
     * 
     * @param Request $request
     * @return array $data
     * 
     */
    public function searchSevencolumnIndex($request)
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
            $data = [
                'seven_columns' => $seven_columns,
                'keyword' => $keyword
            ];
            return $data;
        } else {
            $sevencolumns = new SevenColumn;
            $data = $sevencolumns->showSevencolumnIndex();
            return $data;
        }

    }

    /**
     * 7コラム作成画面表示処理
     * 
     * @param int $id
     */
    public function createSevencolumn($id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $three_column = ThreeColumn::where('id', $id)->where('user_id', $user_id)->first();

        $event_id = $three_column->event_id;

        $event = Event::where('id', $event_id)
                      ->where('user_id', $user_id)
                      ->first();
        $data = [
            'event' => $event,
            'three_column' => $three_column,
        ];
        return $data;
    }

    /**
     * 7コラム保存処理
     * 
     * @param Request $request
     */
    public function storeSevencolumn($request)
    {
        DB::transaction(function () use ($request) {

            $seven_column = new SevenColumn();

            $seven_column->user_id     = Auth::id();
            $seven_column->threecol_id = $request->threecol_id;
            $seven_column->event_id    = $request->event_id;

            $seven_column->basis_thinking = $request->basis_thinking;
            $seven_column->opposite_fact  = $request->opposite_fact;
            $seven_column->new_thinking   = $request->new_thinking;
            
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
    }

    /**
     * 7コラム詳細ページ表示処理
     * 
     * @param int $id
     * @return array $data
     */
    public function showDetailSevencolumn($id)
    {
        $seven_column = SevenColumn::find($id);
        if(Auth::id() === $seven_column->user_id) {
            $threecol_id = $seven_column->threecol_id;
            $three_column = ThreeColumn::find($threecol_id);
            $event_id = $seven_column->event_id;
            $event = Event::find($event_id);
    
            $habit_names = [];
            // 考え方の癖 取得
            foreach ($three_column->habit as $habit) {
                $habit_names[] = $habit->habit_name;
            }
            $data = [
                'event' => $event,
                'three_column' => $three_column,
                'seven_column' => $seven_column,
                'habit_names'  => $habit_names
            ];
            return $data;
        }
    }

    /**
     * 7コラム編集画面表示処理
     * 
     * @param int $id
     * @return array $data
     * 
     */
    public function showEditSevencolumn($id)
    {
        $seven_column = SevenColumn::find($id);
        if(isset($seven_column)) {
            if(Auth::id() === $seven_column->user_id) {
                $threecol_id = $seven_column->threecol_id;
                $event_id = $seven_column->event_id;
                $three_column = ThreeColumn::find($threecol_id);
                $event = Event::find($event_id);
                $data = [
                    'event' => $event,
                    'three_column' => $three_column,
                    'seven_column' => $seven_column  
                ];
                return $data;
            }
        } 
    }

    /**
     * 7コラム更新処理
     * 
     * @param Request $request
     * @param int $id
     * 
     */
    public function updateSevencolumn($request, $id) 
    {
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
    }

    /**
     * 7コラム削除処理
     * @param int $id
     */
    public function deleteSevencolumn($id)
    {
        $seven_column = SevenColumn::find($id);
        if(Auth::id() === $seven_column->user_id) {
            $seven_column->delete();
        }
    }
}
