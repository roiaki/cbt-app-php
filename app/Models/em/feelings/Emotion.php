<?php

namespace App\Models\em\feelings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    use HasFactory;
    /*
     * テーブルの主キー
     * @var string
     */
    protected $primaryKey = 'id';
    
    // fillableに指定したカラムのみ、create()やfill()、update()で値が代入されます。
    protected $fillable = [
        
    ];

  
}
