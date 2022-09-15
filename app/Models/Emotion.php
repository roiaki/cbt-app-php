<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    use HasFactory;
    /*
     * テーブルの主キー
     * 
     * @var string
     */
    protected $primaryKey = 'emotion_id';
    
    // fillableに指定したカラムのみ、create()やfill()、update()で値が代入されます。
    protected $fillable = [
        'threecolumn_id',
        'event_id',
        'user_id',
        'emotion_name',
        'emotion_strength'
    ];

    /**
     * Emotion(従) -> Threecolumn(主)
     * many to one
     */
    public function threecolumns()
    {
        return $this->belongsTo(ThreeColumn::class);
    }
}
