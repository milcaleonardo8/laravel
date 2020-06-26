<?php

namespace App\Http\Controllers;
use App\Http\Requests\ExpRequest;
use App\Model\ExpCats;
use App\Model\Expense;
use App\Model\ServiceItemsModel;
use App\Model\VehicleModel;
use Auth;
use DB;
use Illuminate\Http\Request;

class ExpenseController extends Controller {

	/*load data*/
	public function index(Request $request) {
		$data['vehicels'] = VehicleModel::whereIn_service(1)->get();
		$data['types'] = ExpCats::get();
		$data['service_items'] = ServiceItemsModel::get();

		$data['total'] = Expense::whereDate('date', DB::raw('CURDATE()'))->sum('amount');
		$data['today'] = Expense::whereDate('date', DB::raw('CURDATE()'))->get();

		return view("expense.index", $data);
	}

	/*For store data */
	public function store(ExpRequest $request) {
		/*
			$validator = Validator::make($request->all(), [
				'vehicle_id' => 'required',
				'expense_type' => 'required',
				'revenue' => 'required',

			]);
			if ($validator->fails()) {

				return redirect('expense')
					->withErrors($validator)
					->withInput();
			}

		*/

		Expense::create([
			"vehicle_id" => $request->get("vehicle_id"),
			"amount" => $request->get("revenue"),
			"user_id" => Auth::id(),
			"date" => $request->get('date'),
			"comment" => $request->get('comment'),
			"expense_type" => $request->get("expense_type"),
		]);

		return redirect()->route("expense.index");
	}

	/*For destroy data */
	public function destroy(Request $request) {
		Expense::find($request->get('id'))->delete();
		$data['today'] = Expense::whereDate('date', DB::raw('CURDATE()'))->get();
		return view("expense.ajax_expense", $data);
		// return redirect()->route('expense.index');
	}

	/*For View data*/
	public function expense_records(Request $request) {
		$data['vehicels'] = VehicleModel::whereIn_service(1)->get();
		$data['types'] = ExpCats::get();
		$data['today'] = Expense::whereBetween('date', [$request->get('date1'), $request->get('date2')])->get();
		$data['service_items'] = ServiceItemsModel::get();
		$data['total'] = Expense::whereDate('date', DB::raw('CURDATE()'))->sum('amount');

		return view("expense.index", $data);
	}

}
