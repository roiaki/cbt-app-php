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
    
    public function user()
    {
        // belongsTo 子から親へ　従から主へ
        // 第1引数：リレーション先の親モデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        //return $this->belongsTo(User::class, 'user_id', 'user_id');
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

    public function sevencolumn()
    {
        // 第1引数：リレーション先の親モデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルのカラム名」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム
        return $this->hasMany(SevenColumn::class, 'threecol_id', 'id'); 
    }

    public function emotion()
    {
        // belongsToMany()
        // 第一引数：得られるModelクラス
        // 第二引数：中間テーブル
        // 第三引数：中間テーブルに保存されている自分のidを示すカラム名
        // 第四引数：中間テーブルに保存されている関係先のidを示すカラム名
        //return $this->belongsToMany(Emotion::class, 'includes', 'threecol_id', 'emotion_id');
        return $this->belongsToMany(Emotion::class);
    }

    public function habit()
    {
        // belongsToMany()
        // 第一引数：得られるModelクラス
        // 第二引数：中間テーブル
        // 第三引数：中間テーブルに保存されている自分のidを示すカラム名
        // 第四引数：中間テーブルに保存されている関係先のidを示すカラム名
        //return $this->belongsToMany(Habits::class, 'thinks', 'threecol_id', 'habit_id');
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
     * 
     * 検索ワードが空の場合は更新日の降順で一覧表示する
     * 
     * @param Request $request
     * 
     */
     public function searchThreecolIndex($request)
     {
        if (Auth::check()) {
            $keyword = $request->keyword;
            $id = Auth::user()->id;
            
            if (isset($keyword)) {
                $three_columns = ThreeColumn::where('user_id', $id)
                    ->where(function($query) use($keyword) {
                        $query->orwhere('emotion_name', 'like', '%' . $keyword . '%')
                              ->orWhere('thinking', 'like', '%' . $keyword . '%');
                       
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

        // クロージャでトランザクション処理
        DB::transaction(function () use ($three_column, $request) {

            $three_column->user_id = Auth::id();
            $three_column->event_id = $request->eventid;

            $three_column->emotion_name = $request->emotion_name_def;
            $three_column->emotion_strength = $request->emotion_strength_def;

            //dd($three_column->emotion_strength[0]);
            if(isset($request->emotion_name[0])) {
                $three_column->emotion_name00 = $request->emotion_name[0];   
            }
           
            if(isset($request->emotion_name[1])) {
                $three_column->emotion_name01 = $request->emotion_name[1];
            }

            if(isset($request->emotion_name[2])) {
                $three_column->emotion_name02 = $request->emotion_name[2];
            }

            if(isset($request->emotion_strength[0])) {
                $three_column->emotion_strength00 = $request->emotion_strength[0];
            }

            if(isset($request->emotion_strength[1])) {
                $three_column->emotion_strength01 = $request->emotion_strength[1];
            }

            if(isset($request->emotion_strength[2])) {
                $three_column->emotion_strength02 = $request->emotion_strength[2];
            }
           

            $three_column->thinking = $request->thinking;

            // 中間テーブルの保存はthree_column保存の後でないとidがない
            $three_column->save();

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
        $event_id = $three_column->event_id;
        $event = Event::find($event_id);
        $habit_id = [];

        // 考え方の癖 id 取得
        foreach ($three_column->habit as $habit) {
            $habit_id[] = $habit->id;
        }

        $user = Auth::user();

        $data = [
            'user' => $user,
            'event' => $event,
            'habit_id' => $habit_id,
            'three_column' => $three_column
        ];

        // $data 配列そのまま渡すか、連想配列として渡すかでbladeでのアクセス方法が変わる
        // return view('three_columns, ['data' => $data]);
        return $data;
    }

    /**
     *  3コラム更新処理
     *
     * @param Reqest $request
     * @param int $id
     */
    public function updateThreecolumn($request, $id)
    {
        // クロージャでトランザクション処理開始
        DB::transaction(function () use ($request, $id) {

            $three_column = ThreeColumn::find($id);

            $three_column->emotion_name = $request->emotion_name;
            $three_column->emotion_strength = $request->emotion_strength;

            if(isset($request->emotion_name00)) {
                $three_column->emotion_name00 = $request->emotion_name00;
            }
            
            if(isset($request->emotion_name01)) {
                $three_column->emotion_name01 = $request->emotion_name01;
            }
            
            if(isset($request->emotion_name02)) {
                $three_column->emotion_name02 = $request->emotion_name02;
            }

            if(isset($request->emotion_strength00)) {
                $three_column->emotion_strength00 = $request->emotion_strength00;
            }

            if(isset($request->emotion_strength01)) {
                $three_column->emotion_strength01 = $request->emotion_strength01;
            }

            if(isset($request->emotion_strength02)) {
                $three_column->emotion_strength02 = $request->emotion_strength02;
            }

            
            $three_column->thinking = $request->thinking;

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
            //dd($three_column->habit());
        });
        // end transaction
    }

    /**
     * 3コラム編集画面表示処理
     * 
     * @param int $id
     * @return array $data
     */
    public function showEditThreecolumn($id)
    {
        $three_column = ThreeColumn::find($id);

        $event_id = $three_column->event_id;
        $event = Event::find($event_id);

        $habit_id = [];
        
        // 考え方の癖 id 取得
        foreach ($three_column->habit as $habit) {
            $habit_id[] = $habit->id;
        }

        $data = [
            'three_column' => $three_column,
            'habit_id' => $habit_id,
            'event' => $event
        ];

        return $data;
    }

    /**
     * 3コラム削除処理
     * 
     * @param int $id
     * 
     */
    public function deleteThreecolumn($id)
    {
        $three_column = ThreeColumn::find($id);
        $three_column->delete();
    }
}

