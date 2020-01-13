<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Report;
use Auth;
use Carbon\Carbon;
class PageController extends Controller
{
    //Konstruktor za provjeru auth.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function about() {
        //return view('pages.about');
    }

    public function reports() {
        return view('pages.reports');
    }

    public function edit_profile($id) {
        $user_data = User::find($id);
        if (Auth::user()->id != $id ) {
            return redirect('home');
        }
        return view('pages.edit_profile')->with('user_data', $user_data);   
    }

    public function update_profile(Request $request, $id) {
        $user_data_update = User::find($id);
        $user_data_update->name = $request->input('name');
        $user_data_update->surname = $request->input('surname');
        $user_data_update->phone = $request->input('phone');
        $user_data_update->update();
        return redirect('home');
    }

    public function create_report() {

        return view('pages.create_report');
    }

    public function store_report(Request $request) {
        $this->validate($request, [
            'image_user' => 'image|nullable|max:1999'
        ]);
        if ($request ->hasFile('image_user')) {
            $filenameWithExt = $request->file('image_user')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image_user')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image_user')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $report_data = new Report;
        $report_data->description = $request->input('description');
        $report_data->address = $request->input('address');
        $report_data->latitude = $request->input('latitude');
        $report_data->longitude = $request->input('longitude');
        $report_data->image_user = $fileNameToStore;
        $report_data->reported_at = Carbon::now()->toDateTimeString();
        $report_data->user_id = auth()->id();
        $report_data->save();
        return redirect('home');
    }

    public function imbex()
    {

        $reportsProcessed = Report::take(200)->whereNull('solved_at')->orderBy('reported_at', 'desc')->get();
        $reportsSolved = Report::take(200)->whereNotNull('solved_at')->orderBy('reported_at', 'desc')->get();
       // $reportsS = Report::whereNotNull('solved_at')->orderBy('solved_at', 'desc')->take(100)->get();
       //dd($reports);
        return view('pages.imbex', compact('reportsProcessed', 'reportsSolved'));
    }
}
