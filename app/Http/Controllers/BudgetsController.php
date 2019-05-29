<?php

namespace App\Http\Controllers;

use App\Budget;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BudgetsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {

        $currentMonth = request('month') ?: Carbon::now()->format('M');
        $budgets = Budget::all();

        if(request()->has('month')){
            $budgets = Budget::byMonth(request('month'))->get();
         
        }else{
            $budgets = Budget::byMonth();
        }

        return view('budgets.index', compact('currentMonth', 'budgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return redirect('/budgets');
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
