<?php

namespace App\Http\Controllers;
use App\Http\Requests\Customers as CustomerRequest;
use App\Model\User;
// use App\Model\UserMeta;
use Illuminate\Http\Request;

class CustomersController extends Controller {
	/*Load data*/
	public function index() {
		$data['data'] = User::whereUser_type("C")->get();
		return view("customers.index", $data);
	}

	/*For Create Customer*/
	public function create() {
		return view("customers.create");
	}
	/*For Store Customer data*/
	public function store(CustomerRequest $request) {

		$id = User::create([
			"name" 			=> $request->get("first_name") . " " . $request->get("last_name"),
			"email" 		=> $request->get("email"),
			"password" 		=> bcrypt("password"),
			"user_type" 	=> "C",
			"api_token" 	=> str_random(60),
		])->id;
		$user 				= User::find($id);
		$user->first_name 	= $request->get("first_name");
		$user->last_name 	= $request->get("last_name");
		$user->address 		= $request->get("address");
		$user->mobno 		= $request->get("phone");
		$user->save();

		return redirect()->route("customers.index");
	}

	/*For Store Customer data using ajax*/
	public function ajax_store(CustomerRequest $request) {
		$id = User::create([
			"name" => $request->get("first_name") . " " . $request->get("last_name"),
			"email" => $request->get("email"),
			"password" => bcrypt("password"),
			"user_type" => "C",
			"api_token" => str_random(60),
		])->id;
		$user = User::find($id);
		$user->first_name = $request->get("first_name");
		$user->last_name = $request->get("last_name");
		$user->address = $request->get("address");
		$user->mobno = $request->get("phone");
		$user->save();
		
		$d = User::whereUser_type("C")->get(["id", "name as text"]);
		return $d;

	}

	/*For Destroy Customer */
	public function destroy(Request $request) {
		// User::find($request->get('id'))->get_detail()->delete();
		User::find($request->get('id'))->user_data()->delete();
		User::find($request->get('id'))->delete();

		return redirect()->route('customers.index');
	}

	/*For Fetch edit customer detail */
	public function edit($id) {
		$index['data'] = User::whereId($id)->first();
		return view("customers.edit", $index);
	}

	/*For update customer detail */
	public function update(CustomerRequest $request) {

		$user = User::whereId($request->get("id"))->first();
		$user->name = $request->get("first_name") . " " . $request->get("last_name");
		$user->email = $request->get('email');
		// $user->password = bcrypt($request->get("password"));
		$user->save();
		$user->first_name = $request->get("first_name");
		$user->last_name = $request->get("last_name");
		$user->address = $request->get("address");
		$user->mobno = $request->get("phone");
		$user->save();

		/*
			$meta = UserMeta::whereUser_id($request->get('id'))->first();
			$meta->first_name = $request->get("first_name");
			$meta->last_name = $request->get("last_name");
			$meta->address = $request->get("address");
			$meta->phone = $request->get("phone");
			$meta->save();
		*/
		return redirect()->route("customers.index");
	}
}
