<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habits extends Model
{
    use HasFactory;

    /**
     * 多対多
     */
    public function three_columns()
    {
        /**
         * 第一引数：得られるModelクラス
         * 第二引数：中間テーブル
         * 第三引数：中間テーブルに保存されている自分のidを示すカラム名
         * 第四引数：中間テーブルに保存されている関係先のidを示すカラム名
         */ 
        return $this->belongsToMany(ThreeColumn::class, 'habit_threecolumn', 'habit_id', 'threecol_id')->withTimestamps();;
    }
}
