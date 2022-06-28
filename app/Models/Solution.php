<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Solution extends Model
{
    use HasFactory;

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

    /**
     * 一覧表示処理
     * 
     * @return array $data
     */
    public function showSolutionIndex()
    {
        $data = [];
        if (Auth::check()) {
            $user = Auth::user();
            $solutions = $user->solutions()->orderBy('updated_at', 'desc')->paginate(5);
            
            // @check
            $data = [
                'solutions' => $solutions,
            ];
        }
        return $data;
    }
}