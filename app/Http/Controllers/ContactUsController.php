<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContactUs;
use Mail;

class ContactUsController extends Controller
{
/**
* Show the application dashboard.
*
* @return \Illuminate\Http\Response
*/
public function contactUs()
{
return view('about');
}

/**
* Show the application dashboard.
*
* @return \Illuminate\Http\Response
*/
public function contactUsPost(Request $request)
{
$this->validate($request, [
'name' => 'required',
'email' => 'required|email',
'message' => 'required'
]);

ContactUs::create($request->all());
Mail::send('pages.email',
array(
'name' => $request->get('name'),
'email' => $request->get('email'),
'user_message' => $request->get('message')
), function($message)
{
$message->from('techanical-atom@gmail.com');
$message->to('bcitspidermani@gmail.com', 'Admin')
->subject('Fix.it');
});
return back()->with('success', 'Vaša poruka je poslana!');
}
}