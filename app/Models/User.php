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

    
    // fillableに指定したカラムのみ、create()やfill()、update()で値が代入されます。
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified', 
        'email_verify_token', // 追加
        'is_guest' // 追加
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
     * User(主) -> Event(従)
     * 1対多
     */
    public function events()
    {
        // 1対多のリレーション （主->従）
        // 第1引数：リレーション先のモデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルの外部キー」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム（userテーブルの主キーを指定）
        return $this->hasMany(Event::class);
    }

    /**
     * User(主) -> Threecolumn(従)
     * 1対多
     */
    public function three_columns() 
    {
        // 1対多のリレーション （主->従）
        // 第1引数：リレーション先のモデル
        // 第2引数：外部キー「親を判別するための値が格納されている、子テーブルの外部キー」
        // 第3引数：親を判別する値が格納された「親がもつ」カラム（userテーブルの主キーを指定）
        return $this->hasMany(ThreeColumn::class);
    }

    /**
     * User(主) -> Sevencolumn(従)
     * 1対多
     */
    public function seven_columns() 
    {
        // 1th param Model, 2th param foreign_key, 3th param owner_key
        return $this->hasMany(SevenColumn::class);   
    }

    /**
     * User(主) -> Trouble(従)
     * 1 to Many
     */
    public function troubles()
    {
        return $this->hasMany('Trouble::class');
    }

    /**
     * User(主) -> Solution(従)
     * 1対多
     */
    public function solutions() 
    {
        // 1th param Model, 2th param foreign_key, 3th param owner_key
        return $this->hasMany(Solution::class);   
    }

    /**
     * User(主) -> Merit(従)
     * 1対多
     */
    public function merits() 
    {
        // 1th param Model, 2th param foreign_key, 3th param owner_key
        return $this->hasMany(Merit::class);   
    }

     /**
     * User(主) -> Demerit(従)
     * 1対多
     */
    public function demerits() 
    {
        // 1th param Model, 2th param foreign_key, 3th param owner_key
        return $this->hasMany(Demerit::class);   
    }


}
