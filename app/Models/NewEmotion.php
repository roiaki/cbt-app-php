<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEmotion extends Model
{
    use HasFactory;

    // テーブルの紐付け(テーブル名がモデル名の複数形の場合は記述の必要なし)
    protected $table = 'newemotions';

    // ブラックリスト
    protected $guarded = ['id'];

    /**
     * NewEmotion(従) -> user(主)
     * Many to 1
     */
    public function user()
    {
        return $this->belongsTo('User::class', 'user_id', 'id');
    }

    /**
     * NewEmotion(従) -> Event(主)
     * Many to 1
     */
    public function event()
    {
        return $this->belongsTo('Event::class', 'event_id', 'id');
    }

    /**
     * NewEmotion(従) -> Threecolumn(主)
     * Many to 1
     */
    public function threecolumn()
    {
        return $this->belongsTo('Threecolumn::class', 'threecolumn_id', 'id');
    }

    /**
     * NewEmotion(従) -> Sevencolumn(主)
     * Many to 1
     */
    public function sevencolumn()
    {
        return $this->belongsTo('Sevencolumn::class', 'sevencolumn_id', 'id');
    }

    

}
