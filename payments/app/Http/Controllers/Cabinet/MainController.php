<?php namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;

class MainController extends Controller {
	
	public function __construct() {
		$this->middleware('auth');
	}

	public function getIndex() {
		return view('cabinet/home');
	}


}
