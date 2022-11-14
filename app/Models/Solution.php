<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

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
            
            $data = [
                'troubles'  => $troubles,
                'solutions' => $solutions,
            ];
        }
        return $data;
    }

    /**
     * 解決策保存処理
     */
    public function storeSolution($request)
    {
        try {
            DB::beginTransaction();

            $trouble = new Trouble;
            $trouble->user_id = Auth::id();
            $trouble->trouble = $request->trouble;
            $trouble->save();

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
                $demerit->user_id    = Auth::id();
                $demerit->trouble_id = $trouble->id;
                $demerit->demerit    = $request->demerit[0];
                $demerit->save();
            }
            if(isset($request->demerit[1])) {
                $demerit = new Demerit;
                $demerit->user_id    = Auth::id();
                $demerit->trouble_id = $trouble->id;
                $demerit->demerit    = $request->demerit[1];
                $demerit->save();
            }
            if(isset($request->demerit[2])) {
                $demerit = new Demerit;
                $demerit->user_id    = Auth::id();
                $demerit->trouble_id = $trouble->id;
                $demerit->demerit    = $request->demerit[2];
                $demerit->save();
            }
            if(isset($request->demerit[3])) {
                $demerit = new Demerit;
                $demerit->user_id    = Auth::id();
                $demerit->trouble_id = $trouble->id;
                $demerit->demerit    = $request->demerit[3];
                $demerit->save();
            }
            if(isset($request->demerit[4])) {
                $demerit = new Demerit;
                $demerit->user_id    = Auth::id();
                $demerit->trouble_id = $trouble->id;
                $demerit->demerit    = $request->demerit[4];
                $demerit->save();
            }
        
            DB::commit();

        } catch (Throwable $e) {
            echo $e->getMessage();
            DB::rollBack();
    }
}

    
    /**
     * 解決策更新処理
     */
    public function updateSolution($request, $id)
    {
        //$user_id = Auth::id();
        // クエリの制約に一致する最初のモデルを取得
        $trouble  = Trouble::find($id);

        $solutions = Solution::where('trouble_id', $trouble->id)->get();
        $merits    = Merit::where('trouble_id', $trouble->id)->get();
        $demerits  = Demerit::where('trouble_id', $trouble->id)->get();
        
        try {
            DB::beginTransaction();
            
            $trouble->trouble = $request->trouble;
            $trouble->save();

            if(isset($request->solution00)) {
                $solutions[0]->solution = $request->solution00;
                $solutions[0]->save();
            }
            if(isset($request->solution01)) {
                $solutions[1]->solution = $request->solution01;
                $solutions[1]->save();
            }
            if(isset($request->solution02)) {
                $solutions[2]->solution = $request->solution02;
                $solutions[2]->save();
            }
            if(isset($request->solution03)) {
                $solutions[3]->solution = $request->solution03;
                $solutions[3]->save();
            }
            if(isset($request->solution04)) {
                $solutions[4]->solution = $request->solution04;
                $solutions[4]->save();
            }
            if(isset($request->merit00)) {
                $merits[0]->merit = $request->merit00;
                $merits[0]->save();
            }
            if(isset($request->merit01)) {
                $merits[1]->merit = $request->merit01;
                $merits[1]->save();
            }
            if(isset($request->merit02)) {
                $merits[2]->merit = $request->merit02;
                $merits[2]->save();
            }
            if(isset($request->merit03)) {
                $merits[3]->merit = $request->merit03;
                $merits[3]->save();
            }
            if(isset($request->merit04)) {
                $merits[4]->merit = $request->merit04;
                $merits[4]->save();
            }
            if(isset($request->demerit00)) {
                $demerits[0]->demerit = $request->demerit00;
                $demerits[0]->save();
            }
            if(isset($request->demerit01)) {
                $demerits[1]->demerit = $request->demerit01;
                $demerits[1]->save();
            }
            if(isset($request->demerit02)) {
                $demerits[2]->demerit = $request->demerit02;
                $demerits[2]->save();
            }
            if(isset($request->demerit03)) {
                $demerits[3]->demerit = $request->demerit03;
                $demerits[3]->save();
            }
            if(isset($request->demerit04)) {
                $demerits[4]->demerit = $request->demerit04;
                $demerits[4]->save();
            }

            DB::commit();

        } catch (Throwable $e) {
            DB::rollBack();
        }
    }

    /**
     * 解決策削除処理
     * @param $id 解決策のID
     */
    public function deleteSolution($id)
    {
        $trouble = Trouble::find($id);
        if(Auth::id() === $trouble->user_id) {
            $trouble->delete();
        }
    }
}