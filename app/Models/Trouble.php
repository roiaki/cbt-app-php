<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trouble extends Model
{
    use HasFactory;
    // fillableに指定したカラムのみ、create()やfill()、update()で値が代入されます。
    protected $fillable = [
        'trouble'
    ];

    /**
     * Trouble(従) -> User(主)
     * Many to 1
     */
    public function user()
    {
        // 1param model 2param foreign_key 3param owner_key
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Trouble(主) -> Solution(従)
     * 1対多
     * 
     */
    public function solutions()
    {
        // hasMany
        // 1 param リレーション先モデル
        // 2 param 外部キー
        // 3 param 自分のカラム
        return $this->hasMany(Solution::class);     
    }

    /**
     * Trouble(主) -> Merit(従)
     * 1 to Many
     */
    public function merits()
    {
        // hasMany
        // 1 param リレーション先モデル. 2param 外部キー. 3param 自モデルカラム
        return $this->hasMany(Merit::class);
    }

    /**
     * Trouble(主) -> Demerit(従)
     * 1 to Many
     */
    public function demerits()
    {
        return $this->hasMany(Demerit::class);
    }
}
