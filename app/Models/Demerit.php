<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demerit extends Model
{
    use HasFactory;
    
    // ブラックリスト
    protected $guarded = ['id'];

    /*
     * Demerit(従) -> User(主)
     * Many to １
     */
    public function user()
    { 
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Demerit(従) -> Trouble(主)
     * Many to 1
     */
    public function trouble()
    {
        return $this->belongsTo(Trouble::class, 'trouble_id', 'id');
    }
}
