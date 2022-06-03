<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /*
     * テーブルの主キー
     * 
     * @var string
     */
    //protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // fillableに指定したカラムのみ、create()やfill()、update()で値が代入されます。
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified', 'email_verify_token', // 追加
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];

    /*
     * 1対多（逆）所属
     * 子（Event）を所有している親（user）を取得 
     */
    public function events()
    {
        // 1対多のリレーション （主->従）
        // 第1引数：リレーション先のモデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルの外部キー」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム（userテーブルの主キーを指定）
        //return $this->hasMany(Event::class, 'user_id', 'user_id');
        return $this->hasMany(Event::class);
    }

    // user->columns()->get() が書けるようになる　
    // Columnモデルとの紐づけ
    public function three_columns() 
    {
        // 1対多のリレーション （主->従）
        // 第1引数：リレーション先のモデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルの外部キー」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム（userテーブルの主キーを指定）
        //return $this->hasMany(ThreeColumn::class, 'user_id', 'user_id');
        return $this->hasMany(ThreeColumn::class);
    }

    // user->seven_columns()->get()　が書けるようになる　
    // SevenColumnモデルとの紐づけ
    public function seven_columns() {

        return $this->hasMany(SevenColumn::class);
        
    }
}
