<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function index() {
		return User::latest()->get();

	}

	public function store(Request $request) {
		$this->validate($request, [
				'name'     => 'required',
				'email'    => 'required',
				'password' => 'required',
				'role'     => 'required',
			]);

		return User::create([
				'name'     => $request['name'],
				'email'    => $request['email'],
				'password' => \Hash::make($request['password']),
				'role'     => $request['role'],
			]);
	}

	public function show(Request $request, $id) {
		$user = User::find($id);
		return response()->json(
			[
				'status' => 'success',
				'user'   => $user->toArray()
			], 200);
	}

	public function update(Request $request, $id) {
		$this->validate($request, [
				'name'  => 'required',
				'email' => 'required',
				'role'  => 'required',
			]);

		$user = User::findOrFail($id);

		$user->update($request->all());
	}

	public function destroy($id) {
		$user = User::findOrFail($id);
		$user->delete();
		return response()->json([
				'message' => 'User deleted successfully'
			]);
	}
}