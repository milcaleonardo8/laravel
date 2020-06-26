<?php

namespace App\Http\Controllers;

use App\Model\Mileage;
use App\Model\Revenue;
use App\Model\VehicleModel;
use Auth;
use Illuminate\Http\Request;

class RecordController extends Controller {

	public function index(Request $request) {
		$data['vehicels'] = VehicleModel::whereIn_service(1)->get();

		return view("record.index", $data);
	}

	/*For Store submit data*/
	public function store(Request $request) {
		$revenue = new Revenue;
		$revenue->user_id = Auth::id();
		$revenue->vehicle_id = $request->get("vehicle_id");
		$revenue->revenue = $request->get("revenue");
		$revenue->save();

		$mileage = new Mileage;
		$mileage->user_id = Auth::id();
		$mileage->vehicle_id = $request->get("vehicle_id");
		$mileage->mileage = $request->get("mileage");
		$mileage->save();

		return redirect()->route("record.index");

	}
}
