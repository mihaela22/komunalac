<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\User;
use App\Report;
class DisplayDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users(Request $request)
    {


        if ($request->ajax()) {
            $data = Report::join('users','users.id','=','reports.user_id')->select('reports.id','reports.address','reports.user_id', 'reports.solved_at', 'reports.processed_at','users.email')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if(!$row->solved_at && $row->processed_at)
                           $btn = '<a href="/admin/report/completed/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fas fa-long-arrow-alt-right"></i></a>';
                        else
                            $btn = '<a href="/admin/report/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fas fa-long-arrow-alt-right"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
           
        }
        
        return view('pages.statistics');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
