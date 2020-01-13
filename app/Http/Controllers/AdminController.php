<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Report;
use App\Category;
use Auth;
use DataTables;

use Carbon\Carbon;
class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
    	$reports = Report::orderBy('id', 'desc')->get();
        //$reports = Report::all();
        return view('pages.admin', compact('reports'));
    }

    public function report($id) {        
        $report_data = Report::find($id);
        $user_id = Report::select('user_id')->where('id', $id)->get();
        $user_data = User::find($user_id); 
        return view('pages.report', compact('report_data', 'user_data'));
        
    }

    public function processed(Request $request, $id) {
        $report_data = Report::find($id);
        $report_data->processed_at = Carbon::now()->toDateTimeString();     
        $report_data->save();
        return redirect('admin');
    }

    public function completed($id) {        
        $user_id = Report::select('user_id')->where('id', $id)->get();
        $user_data = User::find($user_id);
        $report_data = Report::find($id); 
        $categories = Category::all();
        return view('pages.completed', compact('report_data', 'user_data', 'categories'));
    }

    public function finish(Request $request, $id) {   
        $user_id = Report::select('user_id')->where('id', $id)->get();  
        $user_data = User::find($user_id);  

        $user_data_update = Report::find($id);
        $user_data_update->solved_description = $request->input('solved_description');
        $user_data_update->solved_at = Carbon::now()->toDateTimeString();
        $user_data_update->category_id = $request->input('category_id');

        $this->validate($request, [
            'image_solved' => 'image|nullable|max:5999'
        ]);
        if ($request ->hasFile('image_solved')) {
            $filenameWithExt = $request->file('image_solved')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image_solved')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image_solved')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $user_data_update->image_solved = $fileNameToStore;
        $user_data_update->save();

        foreach ($user_data as $user) {
            if (isset($user->phone)) {


                $url = 'https://api.46elks.com/a1/SMS';
                $username = 'ubb4057e67bbc5e3082d8f870a1bfe75e';
                $password = 'F960A9FDA0A90601CA7AAAD7155D169A';
                $phone = ltrim($user->phone, '0');
                $sms = array('from' => 'Komunalac',
                    'to' => '385' . $phone,
                    'message' => 'Prijavljeni problem je riješen. http://192.168.4.115/reports/'.$id);
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($sms));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                $result = curl_exec($ch);
                curl_close($ch);
                print $result;
            }
        }

        
            
        return redirect('admin');
    }

    public function ban_user(Request $request, $id) {

        $user_data = User::find($id);
        $user_data->ban = 2;
        $user_data->save();
        return redirect('admin');
    }

    public function history() {
        $reports = Report::with('user')->get();
        return view('pages.history', compact('reports'));
    }

    
}
