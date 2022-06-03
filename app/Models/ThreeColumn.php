<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // ホワイトリスト　
    protected $fillable = [
    
    ];

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
}

