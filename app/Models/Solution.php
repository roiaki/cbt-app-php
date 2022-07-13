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

    /**
     * 解決策保存処理
     * 
     */
    public function solutionStore($request)
    {
        $solution = new Solution;

        $solution->user_id = Auth::id();
        
        $solution->trouble = $request->trouble;
        
        // @cheack create()　fill() マルチカラムアトリビュート対策の検討
        if(isset($request->solution[0])) {
            $solution->solution00 = $request->solution[0];
        }
        if(isset($request->solution[1])) {
            $solution->solution01 = $request->solution[1];
        }
        if(isset($request->solution[2])) {
            $solution->solution02 = $request->solution[2];
        }
        if(isset($request->solution[3])) {
            $solution->solution03 = $request->solution[3];
        }
        if(isset($request->solution[4])) {
            $solution->solution04 = $request->solution[4];
        }

        if(isset($request->merit[0])) {
            $solution->merit00 = $request->merit[0];
        }
        if(isset($request->merit[1])) {
            $solution->merit01 = $request->merit[1];
        }
        if(isset($request->merit[2])) {
            $solution->merit02 = $request->merit[2];
        }
        if(isset($request->merit[3])) {
            $solution->merit03 = $request->merit[3];
        }
        if(isset($request->merit[4])) {
            $solution->merit04 = $request->merit[4];
        }

        if(isset($request->demerit[0])) {
            $solution->demerit00 = $request->demerit[0];
        }
        if(isset($request->demerit[1])) {
            $solution->demerit01 = $request->demerit[1];
        }
        if(isset($request->demerit[2])) {
            $solution->demerit02 = $request->demerit[2];
        }
        if(isset($request->demerit[3])) {
            $solution->demerit03 = $request->demerit[3];
        }
        if(isset($request->demerit[4])) {
            $solution->demerit04 = $request->demerit[4];
        }

        $solution->save();

        return $solution;

    }

    public function updateSolution()
    {
        
    }
}