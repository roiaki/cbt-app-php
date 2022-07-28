<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solution;
use Illuminate\Support\Facades\Auth;
use Session;

class SolutionsController extends Controller
{
    // 解決策一覧画面表示
    public function index()
    {
        $solution = new Solution;
       //dd($solution);
        $data = $solution->showSolutionIndex();

        return view('solutions.index', $data);
    }

    // 解決策作成画面表示
    public function create()
    {
        return view('solutions.create');
    }

    /**
     * 解決策保存処理
     * 
     */
    public function store(Request $request) 
    {
        // @cheack バリデーションがきかない
        $this->validate(
            $request,
            [
                'trouble' => 'required|max:500',
                'solution.*' => 'required|max:500',
                'merit.*' => 'required|max:500',
                'demerit.*' => 'required|max:500',
            ]
        );
        
        $Solution = new Solution;
        //dd($request);
        if(isset($request->solution[0])) {
            $solution = $Solution->solutionStore($request);
            $data = ['solution' => $solution];
            return view('solutions.show', $data);
        } else {
            return redirect('/solution/create');
        }
        
    }

    // 詳細ページ表示処理
    public function show($id)
    {
        $solution = Solution::find($id);
        
        if(!isset($solution)) {
            return redirect('/solutions');
        }

        if(Auth::id() === $solution->user_id) {
            $data = [
                'solution' => $solution,
            ];
            return view('solutions.show', $data);
        }
        return redirect('/solutions');
    }

    // 編集ページ表示処理
    public function edit($id)
    {
        $solution = Solution::find($id);
        
        if(!isset($solution)) {
            return redirect('/solutions');
        }

        if(Auth::id() === $solution->user_id) {
            $data = [
                'solution' => $solution,
            ];
            return view('solutions.edit', $data);
        }
    }

    /**
     * 解決策更新処理
     * 
     * @param Request $request
     * @param int $id
     * @return redirect('/three_columns');
     */
    public function update(Request $request, $id)
    {
        $solution = Solution::find($id);

        if(!isset($solution)) {
            return redirect('/solutions');
        }
        
        if(Auth::id() === $solution->user_id) {
            $solution->updateSolution($request, $id);
            return redirect('/solutions');
        }
        return redirect('/solutions');
    }

    /**
     * 解決策削除処理
     * 
     * @param int $id
     * @return redirect('/solutions');
     */
    public function destroy($id)
    {
        $solution = Solution::find($id);
        if(Auth::id() === $solution->user_id) {
            $solution->deleteSolution($id);
        }
        return redirect('/solutions');
    }

}
