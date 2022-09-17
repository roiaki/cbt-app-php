<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Solution extends Model
{
    use HasFactory;
    
    // ブラックリスト
    protected $guarded = ['id'];

    /*
     * Solution(従) -> User(主)
     * Many to １
     */
    public function user()
    { 
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Solution(従) -> Trouble(主)
     * Many to 1
     */
    public function trouble()
    {
        return $this->belongsTo('Trouble::class', 'trouble_id', 'id');
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

    
    /**
     * 解決策保存処理
     * 
     */
    public function updateSolution($request, $id)
    {
        
        $user_id = Auth::id();
        // クエリの制約に一致する最初のモデルを取得
        $solution = Solution::where('id', $id)->where('user_id', $user_id)->first();
        
        $solution->trouble = $request->trouble;
        
        // @cheack create()　fill() マルチカラムアトリビュート対策の検討
        if(isset($request->solution00)) {
            $solution->solution00 = $request->solution00;
        }
        if(isset($request->solution01)) {
            $solution->solution01 = $request->solution01;
        }
        if(isset($request->solution02)) {
            $solution->solution02 = $request->solution02;
        }
        if(isset($request->solution03)) {
            $solution->solution03 = $request->solution03;
        }
        if(isset($request->solution04)) {
            $solution->solution04 = $request->solution04;
        }

        if(isset($request->merit00)) {
            $solution->merit00 = $request->merit00;
        }
        if(isset($request->merit01)) {
            $solution->merit01 = $request->merit01;
        }
        if(isset($request->merit02)) {
            $solution->merit02 = $request->merit02;
        }
        if(isset($request->merit03)) {
            $solution->merit03 = $request->merit03;
        }
        if(isset($request->merit04)) {
            $solution->merit04 = $request->merit04;
        }

        if(isset($request->demerit00)) {
            $solution->demerit00 = $request->demerit00;
        }
        if(isset($request->demerit01)) {
            $solution->demerit01 = $request->demerit01;
        }
        if(isset($request->demerit02)) {
            $solution->demerit02 = $request->demerit02;
        }
        if(isset($request->demerit03)) {
            $solution->demerit03 = $request->demerit03;
        }
        if(isset($request->demerit04)) {
            $solution->demerit04 = $request->demerit04;
        }

        $solution->save();

        return $solution;
    }

    /**
     * 解決策削除処理
     * @param $id
     */
    public function deleteSolution($id)
    {
        $solution = Solution::find($id);
        if(Auth::id() === $solution->user_id) {
            $solution->delete();
        }
    }
}