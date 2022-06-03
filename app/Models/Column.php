<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    /*
     * テーブルの主キー
     * 
     * @var string
     */
    //protected $primaryKey = 'column_id';

    // ホワイトリスト　
    protected $fillable = [
        'title', 
        'content', 
        'emotion_name', 
        'emotion_strength', 
        'thoughts'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
