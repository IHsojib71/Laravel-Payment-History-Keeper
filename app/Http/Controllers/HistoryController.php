<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_history = History::all();
        return view('showHistory', compact('all_history'));
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
    public function store(Request $request)
    {
    
        $a = new History;
        $a->room_number = $request->add_room_no;
        $a->save();
        return redirect('history')->with('status','Room Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $history= History::find($id);
       
        if($request->accepted_by != ''){
            $history->paid_to = $request->accepted_by;
            $history->paid_at = $request->accepted_date;
            $history->save();
        }else{
            $history->paid_to ="";
            $history->paid_at ="";
            $history->save();
        }
            
        
        return redirect('history')->with('status','Payment Action Updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aa = History::find($id);
        $aa->delete();
        return redirect('/history')->with('status','Room deleted Successfully!');
    }
}
