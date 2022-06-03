<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    protected $fillable = [
        'title',
        'content'   
    ];

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
}
