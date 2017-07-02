<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User1;
/**
* 
*/

use Illuminate\Support\Facades\Auth;


class User1Controller extends Controller
{

	public function postSingUp(Request $request)
	{
		$this->validate($request,[
				'email' => 'required|email|unique:user1s',
				'name' => 'required|max:120',
				'password' => 'required|min:4'
			]);

		$email = $request['email'];
		$name = $request['name'];
		$password = bcrypt($request['password']);

		$user = new User1();
		$user->email = $email;
		$user->name = $name;
		$user->password = $password;

		$user->save();

		Auth::login($user);

		return redirect()->route('dashboard');
	}
	public function postSingIn(Request $request)
	{
		$this->validate($request,[
				'email' => 'required',
				'password' => 'required'
			]);
		if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
			return redirect()->intended('dashboard');
		}
		return redirect()->back();
	}
}


 ?>