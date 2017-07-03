<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User1;
/**
* 
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

	public function getLogout()
	{
		Auth::logout();
		return redirect()->route('home');
	}

	public function getAccount()
	{
	    return view('account', ['user' => Auth::user()]);
	}

	public function postSaveAccount(Request $request)
	{
		$this->validate($request,[
				'name' => 'required|max:120'
			]);
		$user = Auth::user();
        $old_name = $user->name;
        $user->name = $request['name'];
        $user->update();
        $file = $request->file('image');
        $filename = $request['name'] . '-' . $user->id . '.jpg';
        $old_filename = $old_name . '-' . $user->id . '.jpg';
        $update = false;
        if (Storage::disk('local')->has($old_filename)) {
            $old_file = Storage::disk('local')->get($old_filename);
            Storage::disk('local')->put($filename, $old_file);
            $update = true;
        }
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        if ($update && $old_filename !== $filename) {
            Storage::delete($old_filename);
        }
        return redirect()->route('account');
	}

	public function getUserImage($filename)
	{
		$file = Storage::disk('local')->get($filename);
		return new Response($file, 200);
	}
}


 ?>