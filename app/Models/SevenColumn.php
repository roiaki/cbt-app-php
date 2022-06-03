<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SevenColumn extends Model
{
    // ブラックリスト
    protected $guarded = [];

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
}
