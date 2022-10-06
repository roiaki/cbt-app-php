<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThreeColumn extends Model
{
    use HasFactory;

    /*
     * テーブルの主キー
     * 
     * @var string
     */
    //protected $primaryKey = 'threecol_id';
    
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'threecolumns';

    // ブラックリスト
    protected $guarded = ['id'];
    
    /**
     * Threecolumn(従) -> User(主)
     * 多対1
     */
    public function user()
    {
        // belongsTo 子から親へ　従から主へ
        // 第1引数：リレーション先のモデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        //return $this->belongsTo(User::class, 'user_id', 'id');
        return $this->belongsTo(User::class);
    }

    /**
     * Threecolumn(従) -> Event(主)
     * 多対1
     */
    public function event()
    {
        // belongsTo 子から親へ　従から主へ
        // 第1引数：リレーション先のモデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        return $this->belongsTo(Event::class, 'event_id', 'id'); 
    }

    /**
     * Threecolumn(主) -> Sevencolumn(従)
     * 1対多
     */
    public function sevencolumn()
    {
        // hasMany 主から従へ
        // 第1引数：リレーション先の従モデル
        // 第2引数：対象先（従）がもつ外部キー　foreign_key
        // 第3引数：自モデルカラム　owner_key
        return $this->hasMany(SevenColumn::class, 'threecol_id', 'id'); 
    }

    /**
     * Threecolumn(主) -> NewEmotion(従)
     * 1 to Many
     * 
     */
    public function new_emotions()
    {
        return $this->hasMany(NewEmotion::class, 'threecolumn_id', 'id');
    }

   
    /**
     * Threecolumn(主) -> Emotion(従)
     * 1対多
     */
    public function emotions()
    {
        // hasMany 主から従へ
        // 第1引数：リレーション先の従モデル
        // 第2引数：対象先（従）がもつ外部キー　foreign_key
        // 第3引数：自モデルカラム　owner_key
        return $this->hasMany(Emotion::class);
    }

    /**
     * Threecolumn(主) -> habit_threecolumn(中間) -> Habit(従)
     * 多対多
     */
    public function habit()
    {
        // belongsToMany()
        // 第一引数：得られるModelクラス
        // 第二引数：中間テーブル
        // 第三引数：中間テーブルに保存されている自分のidを示すカラム名
        // 第四引数：中間テーブルに保存されている関係先のidを示すカラム名
        return $this->belongsToMany(Habits::class, 'habit_threecolumn', 'threecol_id', 'habit_id')->withTimestamps();;
    }

    /**
     * 3コラム一覧表示処理
     * 
     * @return array $data
     */
    public function showThreecolIndex()
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
        return $data;
    }

    /**
     * 3コラム検索表示処理
     * 検索ワードが空の場合は更新日の降順で一覧表示する
     * 
     * @param Request $request
     */
     public function searchThreecolIndex($request)
     {
        if (Auth::check()) {
            $keyword = $request->keyword;
            $id = Auth::user()->id;
            
            if (isset($keyword)) {
                $three_columns = ThreeColumn::where('user_id', $id)
                    ->where(function($query) use($keyword) {
                        $query->orWhere('thinking', 'like', '%' . $keyword . '%');
                    })
                    ->orderBy('updated_at', 'desc')
                    ->paginate(5);

                $data = [
                    'three_columns' => $three_columns,
                    'keyword' => $keyword
                ];
                return $data;
    
            } else {
                $data = [];
                if (Auth::check()) {
                    $user = Auth::user();
                    $three_columns = $user->three_columns()
                        ->orderBy('updated_at', 'desc')
                        ->paginate(5);
    
                    $data = [
                        'three_columns' => $three_columns,
                        'keyword' => $keyword
                    ];
                }
                return $data;
            }
        }
    }

    /**
     * 3コラム保存処理
     * 
     * @param Request $request
     * @return object $three_column
     */
    public function storeThreecolumn($request)
    {
        $three_column = new ThreeColumn;

        DB::transaction(function () use ($three_column, $request) {
            
            $three_column->user_id  = Auth::id();
            $three_column->event_id = $request->eventid;
            $three_column->thinking = $request->thinking;

            // 中間テーブルの保存はthree_column保存の後でないとidがない
             $three_column->save();
            
            // 中間テーブル
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

            if(isset($request->emotion_name[0])) {
                $emotion = new Emotion;
                $emotion->emotion_name     = $request->emotion_name[0]; 
                $emotion->emotion_strength = $request->emotion_strength[0];
                $emotion->event_id         = $request->eventid;
                $emotion->user_id          = Auth::id();
                $emotion->threecolumn_id   = $three_column->id;
                $emotion->save();
            }
           
            if(isset($request->emotion_name[1])) {
                $emotion = new Emotion;
                $emotion->emotion_name     = $request->emotion_name[1]; 
                $emotion->emotion_strength = $request->emotion_strength[1];
                $emotion->event_id         = $request->eventid;
                $emotion->user_id          = Auth::id();
                $emotion->threecolumn_id   = $three_column->id;
                $emotion->save();
            }

            if(isset($request->emotion_name[2])) {
                $emotion = new Emotion;
                $emotion->emotion_name     = $request->emotion_name[2]; 
                $emotion->emotion_strength = $request->emotion_strength[2];
                $emotion->event_id         = $request->eventid;
                $emotion->user_id          = Auth::id();
                $emotion->threecolumn_id   = $three_column->id;
                $emotion->save();
            }
        });
        // end transaction
        return $three_column;
    }

    /**
     * 3コラム詳細画面表示処理
     * 
     * @param int $id
     * @return array $data
     */
    public function showDetailThreecolumn($id)
    {
        $three_column = ThreeColumn::find($id);
    
        if(Auth::id() === $three_column->user_id) {
            $event_id = $three_column->event_id;
            $event    = Event::find($event_id);
            $habit_id = [];
            $emotion  = Emotion::where('threecolumn_id', $id)->get();       

            // 考え方の癖 id 取得
            foreach ($three_column->habit as $habit) {
                $habit_id[] = $habit->id;
            }
    
            $user = Auth::user();
            
            $data = [
                'user' => $user,
                'event' => $event,
                'habit_id' => $habit_id,
                'three_column' => $three_column,
                'emotion' => $emotion
            ];
    
            // $data 配列そのまま渡すか、連想配列として渡すかでbladeでのアクセス方法が変わる
            // return view('three_columns, ['data' => $data]);
            return $data;
        }
    }

    /**
     * 3コラム編集画面表示処理
     * 
     * @param int $id
     * @return array $data
     */
    public function getThreecolumn($id)
    {
        $three_column = ThreeColumn::find($id);

        if(Auth::id() === $three_column->user_id) {
            $event_id = $three_column->event_id;
            $event    = Event::find($event_id);
            $emotions = Emotion::where('threecolumn_id', $three_column->id)->get(); 
            $habit_id = [];
            
            // 考え方の癖 id 取得
            foreach ($three_column->habit as $habit) {
                $habit_id[] = $habit->id;
            }
    
            $data = [
                'three_column' => $three_column,
                'habit_id'     => $habit_id,
                'event'        => $event,
                'emotions'     => $emotions,
            ];
            return $data;
        } 
    }

    /**
     *  3コラム更新処理
     *
     * @param Reqest $request
     * @param int $id
     */
    public function updateThreecolumn($request, $id)
    {
        $three_column = ThreeColumn::find($id);
       
        // dd($request);
        if(Auth::id() === $three_column->user_id) {
            // クロージャでトランザクション処理開始
            // @refact
            DB::transaction(function () use ($request, $id, $three_column) {
                
                $emotions     = Emotion::where('threecolumn_id', $id)->get();
// dd($emotions[0]->emotion_name);
                if(isset($request->emotion_name[0])) {
                    $emotions[0]->emotion_name = $request->emotion_name[0];
                    $emotions[0]->save();
                }
                
                if(isset($request->emotion_name0[1])) {
                    $emotions[1]->emotion_name = $request->emotion_name[1];
                    $emotions[1]->save();
                }
                
                if(isset($request->emotion_name[2])) {
                    $emotions[2]->emotion_name = $request->emotion_name[2];
                    $emotions[2]->save();
                }
    
                if(isset($request->emotion_strength00)) {
                    $emotions[0]->emotion_strength = $request->emotion_strength00;
                    $emotions[0]->save();
                }
    
                if(isset($request->emotion_strength01)) {
                    $emotions[1]->emotion_strength = $request->emotion_strength01;
                    $emotions[1]->save();
                }
    
                if(isset($request->emotion_strength02)) {
                    $emotions[2]->emotion_strength = $request->emotion_strength02;
                    $emotions[2]->save();
                }
    
                $three_column->thinking   = $request->thinking;
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
            });
            // end transaction
        }
    }

    /**
     * 3コラム削除処理
     * 
     * @param int $id
     */
    public function deleteThreecolumn($id)
    {
        $three_column = ThreeColumn::find($id);
        if(Auth::id() === $three_column->user_id) {
            $three_column->delete();
        }
       
    }
}

