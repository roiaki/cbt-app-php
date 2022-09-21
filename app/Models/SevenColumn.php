<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\NewEmotion;

class SevenColumn extends Model
{
    // ブラックリスト
    protected $guarded = ['id'];

    // テーブルの紐付け(テーブル名がモデル名の複数形の場合は記述の必要なし)
    protected $table = 'sevencolumns';

    // プライマリキー(主キーカラム名がidの場合は記述の必要なし)
    //protected $primaryKey = 'id';

    // Userモデルとの紐づけ
    public function user() 
    {     
        return $this->belongsTo(User::class);
    }

    /**
     * Sevencolumn(従) -> Event(主)
     * Many to 1
     */
    public function event()
    {
        // belongsTo 子から親へ　従から主へ
        // 第1引数：リレーション先の親モデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        return $this->belongsTo(Event::class, 'event_id', 'id'); 
    }

    /**
     * Sevencolumn(従) -> Threecolumn(主)
     * Many to 1
     */
    public function threecolumn()
    {
        // belongsTo 子から親へ　従から主へ
        // 第1引数：リレーション先の親モデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        return $this->belongsTo(Threecolumn::class, 'threecol_id', 'id');
    }

    /**
     * Sevencolumn(主) -> NewEmotion(従)
     * 1 to Many
     */
    public function new_emotions()
    {
        return $this->hasMany(NewEmotion::class, 'sevencolumn_id', 'id');
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
                'event'         => $event,
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
        $emotions     = Emotion::where('threecolumn_id', $id)->get();
        $event_id     = $three_column->event_id;

        $event = Event::where('id', $event_id)
                      ->where('user_id', $user_id)
                      ->first();
        
        $data = [
            'event' => $event,
            'three_column' => $three_column,
            'emotions'     => $emotions
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

            $seven_column->user_id        = Auth::id();
            $seven_column->threecol_id    = $request->threecol_id;
            $seven_column->event_id       = $request->event_id;
            $seven_column->basis_thinking = $request->basis_thinking;
            $seven_column->opposite_fact  = $request->opposite_fact;
            $seven_column->new_thinking   = $request->new_thinking;
            
            $seven_column->save();
           
            if(isset($request->new_emotion_name00)) {
                $new_emotion = new NewEmotion;
                $new_emotion->user_id              = Auth::id();
                $new_emotion->event_id             = $request->event_id;
                $new_emotion->threecolumn_id       = $request->threecol_id;
                $new_emotion->sevencolumn_id       = $seven_column->id;
                $new_emotion->new_emotion_name     = $request->new_emotion_name00;
                $new_emotion->new_emotion_strength = $request->new_emotion_strength00;

                $new_emotion->save();
            }

            if(isset($request->new_emotion_name01)) {
                $new_emotion = new NewEmotion;
                $new_emotion->user_id              = Auth::id();
                $new_emotion->event_id             = $request->event_id;
                $new_emotion->threecolumn_id       = $request->threecol_id;
                $new_emotion->sevencolumn_id       = $seven_column->id;
                $new_emotion->new_emotion_name     = $request->new_emotion_name01;
                $new_emotion->new_emotion_strength = $request->new_emotion_strength01;

                $new_emotion->save();
            }

            if(isset($request->new_emotion_name02)) {
                $new_emotion = new NewEmotion;
                $new_emotion->user_id              = Auth::id();
                $new_emotion->event_id             = $request->event_id;
                $new_emotion->threecolumn_id       = $request->threecol_id;
                $new_emotion->sevencolumn_id       = $seven_column->id;
                $new_emotion->new_emotion_name     = $request->new_emotion_name02;
                $new_emotion->new_emotion_strength = $request->new_emotion_strength02;

                $new_emotion->save();
            }
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
            $threecol_id  = $seven_column->threecol_id;
            $three_column = ThreeColumn::find($threecol_id);
            $event_id     = $seven_column->event_id;
            $event        = Event::find($event_id);
            $emotions     = Emotion::where('threecolumn_id', $threecol_id)->get();
            $newemotions  = NewEmotion::where('sevencolumn_id', $id)->get();

            $habit_names = [];
            // 考え方の癖 取得
            foreach ($three_column->habit as $habit) {
                $habit_names[] = $habit->habit_name;
            }
            $data = [
                'event'        => $event,
                'three_column' => $three_column,
                'seven_column' => $seven_column,
                'habit_names'  => $habit_names,
                'emotions'     => $emotions,
                'newemotions'  => $newemotions,
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
                $threecol_id  = $seven_column->threecol_id;
                $event_id     = $seven_column->event_id;
                $event        = Event::find($event_id);
                $three_column = ThreeColumn::find($threecol_id);
                $emotions     = Emotion::where('threecolumn_id', $threecol_id)->get();
                $new_emotions = NewEmotion::where('sevencolumn_id', $id)->get();
        
                $data = [
                    'event'        => $event,
                    'three_column' => $three_column,
                    'seven_column' => $seven_column,
                    'emotions'     => $emotions,
                    'new_emotions' => $new_emotions,
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
        $seven_column->opposite_fact  = $request->opposite_fact;
        $seven_column->new_thinking   = $request->new_thinking;
        $seven_column->updated_at     = date('Y-m-d G:i:s');
        $seven_column->save();

        $sevencolumn_id = $id;
        $new_emotions   = NewEmotion::where('sevencolumn_id', $sevencolumn_id)->get();

        if(isset($request->new_emotion_strength00)) {
            $new_emotions[0]->new_emotion_strength = $request->new_emotion_strength00;
            $new_emotions[0]->save();
        }

        if(isset($request->new_emotion_strength01)) {
            $new_emotions[1]->new_emotion_strength = $request->new_emotion_strength01;
            $new_emotions[1]->save();
        }

        if(isset($request->new_emotion_strength02)) {
            $new_emotions[2]->new_emotion_strength = $request->new_emotion_strength02;
            $new_emotions[2]->save();
        }
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
