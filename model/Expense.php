<!-- Expense Model -->
<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'vehicle_id', 'user_id', 'amount', 'expense_type', 'comment', 'date', 'exp_id',
	];
	protected $table = "expense";

	/*For Category model*/
	function category() {
		return $this->hasOne("App\Model\ExpCats", "id", "expense_type")->withTrashed();
	}

	/*For VehicleModel*/
	function vehicle() {
		return $this->hasOne("App\Model\VehicleModel", "id", "vehicle_id")->withTrashed();
	}
}
