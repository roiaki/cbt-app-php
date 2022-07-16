<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solution;

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
        $solution = $Solution->solutionStore($request);

        $data = ['solution' => $solution];

        return view('solutions.show', $data);
    }

    // 詳細ページ表示処理
    public function show($id)
    {
        $solution = Solution::find($id);
        $data = [
            'solution' => $solution,
        ];

        return view('solutions.show', $data);
    }

    // 編集ページ表示処理
    public function edit($id)
    {
        $solution = Solution::find($id);
        $data = [
            'solution' => $solution,
        ];
        return view('solutions.edit', $data);
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
        $solution = new Solution;
        $solution->updateSolution($request, $id);

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
        $solution = new Solution;
        $solution->deleteSolution($id);

        return redirect('/solutions');
    }

}
