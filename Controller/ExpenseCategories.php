<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseCatRequest;
use App\Model\ExpCats;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class ExpenseCategories extends Controller {
	public function index() {
		$data['data'] = ExpCats::get();

		return view("expense.cats", $data);
	}

	/*For create category*/
	public function create() {

		return view("expense.catadd");
	}

	/*For Destroy category*/
	public function destroy(Request $request) {
		ExpCats::find($request->get('id'))->expense()->delete();
		ExpCats::find($request->get('id'))->delete();

		return redirect()->route('expensecategories.index');
	}

	/*For Store category*/
	public function store(ExpenseCatRequest $request) {

		ExpCats::create([
			"name" => $request->get("name"),
			"user_id" => Auth::id(),
			"type" => "u",

		]);

		return Redirect::route("expensecategories.index");

	}

	/*For Fetch category category edit*/
	public function edit(ExpCats $expensecategory) {

		return view("expense.catedit", compact("expensecategory"));
	}

	/*For update category details*/
	public function update(ExpenseCatRequest $request) {

		$user = ExpCats::whereId($request->get("id"))->first();
		$user->name = $request->get("name");
		$user->user_id = Auth::id();
		$user->save();

		return Redirect::route("expensecategories.index");
	}

}
