<?php namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Payment;
use App\Account;
use Auth;
use Illuminate\Http\Request;

class PingbackController extends Controller {
	public function __construct() {
		Paymentwall_Base::setApiType(Paymentwall_Base::API_VC);
		Paymentwall_Base::setAppKey('466763feb82b45c143d242766801cd53');
		Paymentwall_Base::setSecretKey('d651224470f8ca9dba95de33e9cd2147');
	}

	public function index() {
		$pingback = new Paymentwall_Pingback(Request::all(), Request::root());
		if ($pingback->validate()) {
			//check signature
			$signature = Paymentwall_Widget::calculateSignature(Request::all(), 'd651224470f8ca9dba95de33e9cd2147', Request::input('sign_version', 2));
			if (Request::input('sig') != $signature) {
				return view('payment/error')->withMessage('signature error');
			}

			$coins = $pingback->getVirtualCurrencyAmount();
			$payment = Payment::firstOrCreate([
				'accountId' => Auth::user()->accountId,
				'paymentsId' => $pingback->getReferenceId(),
			]);
			if ($pingback->isUnderReview()) {
				$payment->status = Payment::STATUS_UNDER_REVIEW;
				$payment->coins = $coins;
			}
			else {
				if ($pingback->isDeliverable()) {
					$payment->status = Payment::STATUS_PAID;
					$payment->coins = $coins;
				} else {
					$payment->status = Payment::STATUS_REFUND;
					$payment->coins = -$coins;

					//recommendations
					if ($pingback->reason == Payment::REASON_CC_FRAUD
						|| $pingback->reason == Payment::REASON_ORDER_FRAUD) {
						//ban user
					}
				}
				$account = Account::find(Auth::user()->accountId);
				$account->balance += $coins;
				$account->save();
			}
			$payment->save();
			return 'OK';
		} else {
			return view('payment/error')->withMessage($pingback->getErrorSummary());
		}
	}
}