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
        return $this->belongsTo(Trouble::class, 'trouble_id', 'id');
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
            $troubles  = $user->troubles()->orderBy('updated_at', 'desc')->paginate(5);
             $solutions = $user->solutions()->orderBy('updated_at', 'desc')->paginate(5);
            
            // @check
            $data = [
                'troubles'  => $troubles,
                'solutions' => $solutions,
            ];
        }
        return $data;
    }

    /**
     * 解決策保存処理
     * 
     */
    public function storeSolution($request)
    {
        $trouble = new Trouble;
        $trouble->user_id = Auth::id();
        $trouble->trouble = $request->trouble;
        $trouble->save();

        // @cheack create()　fill() マルチカラムアトリビュート対策の検討
        if(isset($request->solution[0])) {
            $solution = new Solution;
            $solution->user_id    = $trouble->user_id;
            $solution->trouble_id = $trouble->id;
            $solution->solution   = $request->solution[0];
            $solution->save();
        }
        
        if(isset($request->solution[1])) {
            $solution = new Solution;
            $solution->user_id    = $trouble->user_id;
            $solution->trouble_id = $trouble->id;
            $solution->solution   = $request->solution[1];
            $solution->save();
        }
        if(isset($request->solution[2])) {
            $solution = new Solution;
            $solution->user_id    = $trouble->user_id;
            $solution->trouble_id = $trouble->id;
            $solution->solution   = $request->solution[2];
            $solution->save();
        }
        if(isset($request->solution[3])) {
            $solution = new Solution;
            $solution->user_id    = $trouble->user_id;
            $solution->trouble_id = $trouble->id;
            $solution->solution   = $request->solution[3];
            $solution->save();
        }
        if(isset($request->solution[4])) {
            $solution = new Solution;
            $solution->user_id    = $trouble->user_id;
            $solution->trouble_id = $trouble->id;
            $solution->solution   = $request->solution[4];
            $solution->save();
        }
        
        if(isset($request->merit[0])) {
            $merit = new Merit;
            $merit->user_id    = Auth::id();
            $merit->trouble_id = $trouble->id;
            $merit->merit      = $request->merit[0];
            $merit->save();
        }
        if(isset($request->merit[1])) {
            $merit = new Merit;
            $merit->user_id    = Auth::id();
            $merit->trouble_id = $trouble->id;
            $merit->merit      = $request->merit[1];
            $merit->save();
        }
        if(isset($request->merit[2])) {
            $merit = new Merit;
            $merit->user_id    = Auth::id();
            $merit->trouble_id = $trouble->id;
            $merit->merit      = $request->merit[2];
            $merit->save();
        }
        if(isset($request->merit[3])) {
            $merit = new Merit;
            $merit->user_id    = Auth::id();
            $merit->trouble_id = $trouble->id;
            $merit->merit      = $request->merit[3];
            $merit->save();
        }
        if(isset($request->merit[4])) {
            $merit = new Merit;
            $merit->user_id    = Auth::id();
            $merit->trouble_id = $trouble->id;
            $merit->merit      = $request->merit[4];
            $merit->save();
        }

        if(isset($request->demerit[0])) {
            $demerit = new Demerit;
            $demerit->user_id = Auth::id();
            $demerit->trouble_id = $trouble->id;
            $demerit->demerit = $request->demerit[0];
            $demerit->save();
        }
        if(isset($request->demerit[1])) {
            $demerit = new Demerit;
            $demerit->user_id = Auth::id();
            $demerit->trouble_id = $trouble->id;
            $demerit->demerit = $request->demerit[1];
            $demerit->save();
        }
        if(isset($request->demerit[2])) {
            $demerit = new Demerit;
            $demerit->user_id = Auth::id();
            $demerit->trouble_id = $trouble->id;
            $demerit->demerit = $request->demerit[2];
            $demerit->save();
        }
        if(isset($request->demerit[3])) {
            $demerit = new Demerit;
            $demerit->user_id = Auth::id();
            $demerit->trouble_id = $trouble->id;
            $demerit->demerit = $request->demerit[3];
            $demerit->save();
        }
        if(isset($request->demerit[4])) {
            $demerit = new Demerit;
            $demerit->user_id = Auth::id();
            $demerit->trouble_id = $trouble->id;
            $demerit->demerit = $request->demerit[4];
            $demerit->save();
        }
    }

    
    /**
     * 解決策更新処理
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