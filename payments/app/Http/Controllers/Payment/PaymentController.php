<?php namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Auth;

//PaymentWall API classes
use Paymentwall_Base;
use Paymentwall_Widget;
use Paymentwall_Pingback;

class PaymentController extends Controller {
	
	public function __construct() {
		//Including paymentwall API library
		Paymentwall_Base::setApiType(Paymentwall_Base::API_VC);
		Paymentwall_Base::setAppKey('466763feb82b45c143d242766801cd53');
		Paymentwall_Base::setSecretKey('d651224470f8ca9dba95de33e9cd2147');

		$this->middleware('auth');
	}

	public function getIndex() {
		$widget = new Paymentwall_Widget(
			Auth::user()->email,
			'p10_1',
			array(),
			array('email' => Auth::user()->email)
		);
		return view('payment/payment')->withWidget($widget);
	}

	/**
	 * GET action of /payment/withdraw
	 *
	 * Shows the withdraw widget (API?)
	 * @return view
	 */
	public function getWithdraw() {
		return view('payment/withdraw');
	}

	/*
	 * POST action of /payment/withdraw
	 * 
	 * Sends a withdraw request to PaymentWall
	 * @return 
	 */
	public function postWithdraw() {
		//
	}
}
