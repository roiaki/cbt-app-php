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
                'solution00' => 'required|max:500',
                'merit00' => 'required|max:500',
                'demerit00' => 'required|max:500',
            ]
        );

        $Solution = new Solution;
        $solution = $Solution->solutionStore($request);
        
    }

}
