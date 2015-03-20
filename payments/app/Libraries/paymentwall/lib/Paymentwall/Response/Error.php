<?php

class Paymentwall_Response_Error extends Paymentwall_Response_Abstract implements Paymentwall_Response_Interface
{
	const GENERAL_INTERNAL = 1000;
	const APPLICATION_NOT_LOADED = 1001;
	const CHARGE_NOT_FOUND = 3000;
	const CHARGE_PERMISSION_DENIED = 3001;
	const CHARGE_WRONG_AMOUNT = 3002;
	const CHARGE_WRONG_CARD_NUMBER = 3003;
	const CHARGE_WRONG_EXP_MONTH  = 3004;
	const CHARGE_WRONG_EXP_YEAR  = 3005;
	const CHARGE_WRONG_EXP_DATE = 3006;
	const CHARGE_WRONG_CURRENCY = 3007;
	const CHARGE_EMPTY_FIELDS = 3008;
	const CHARGE_WRONG_TOKEN = 3111;
	const CHARGE_WRONG_ONE_TIME_TOKEN = 3112;
	const CHARGE_WRONG_TEST_CREDENTIALS = 3113;
	const CHARGE_TOKEN_DELETED = 3114;
	CONST CHARGE_WRONG_MIN_AMOUNT = 3115;
	CONST CHARGE_WRONG_MAX_AMOUNT = 3116;
	const CHARGE_CARD_NUMBER_ERROR = 3101;
	const CHARGE_CARD_NUMBER_EXPIRED = 3102;
	const CHARGE_UNSUPPORTED_CARD = 3103;
	const CHARGE_UNSUPPORTED_COUNTRY = 3104;
	const CHARGE_BILLING_ADDRESS_ERROR = 3009;
	const CHARGE_BANK_DECLINE = 3010;
	const CHARGE_INSUFFICIENT_FUNDS = 3011;
	const CHARGE_GATEWAY_DECLINE = 3012;
	const CHARGE_CVV_ERROR = 3014;
	const CHARGE_FAILED = 3200;
	const CHARGE_ALREADY_REFUNDED = 3201;
	const CHARGE_CANCEL_FAILED = 3202;
	const CHARGE_ALREADY_CAPTURED = 3203;
	const CHARGE_REFUND_FAILED  = 3204;
	const CHARGE_DUPLICATE = 3205;
	const CHARGE_AUTH_EXPIRED = 3206;
	const FIELD_FIRSTNAME = 3301;
	const FIELD_LASTNAME = 3302;
	const FIELD_ADDRESS = 3303;
	const FIELD_CITY = 3304;
	const FIELD_STATE = 3305;
	const FIELD_ZIP = 3306;
	const SUBSCRIPTION_WRONG_PERIOD = 3401;
	const SUBSCRIPTION_NOT_FOUND = 3402;
	const SUBSCRIPTION_WRONG_PERIOD_DURATION = 3403;
	const SUBSCRIPTION_MISSING_TRIAL_PARAMS = 3404;
	const SUBSCRIPTION_WRONG_TRIAL_PERIOD = 3405;
	const SUBSCRIPTION_WRONG_TRIAL_PERIOD_DURATION = 3406;
	const SUBSCRIPTION_WRONG_TRIAL_AMOUNT = 3407;
	const SUBSCRIPTION_WRONG_PAYMENTS_LIMIT = 3408;
	const API_UNDEFINED_METHOD = 4004;
	const API_EMPTY_REQUEST = 4005;
	const API_KEY_MISSED = 4006;
	const API_KEY_INVALID = 4007;
	const API_DECRYPTION_FAILED = 4008;
	const USER_BANNED = 5000;

	static $errorCodes = array(
		self::GENERAL_INTERNAL,
		self::APPLICATION_NOT_LOADED,
		self::CHARGE_NOT_FOUND,
		self::CHARGE_PERMISSION_DENIED,
		self::CHARGE_WRONG_AMOUNT,
		self::CHARGE_WRONG_CARD_NUMBER,
		self::CHARGE_WRONG_EXP_MONTH,
		self::CHARGE_WRONG_EXP_YEAR,
		self::CHARGE_WRONG_EXP_DATE,
		self::CHARGE_WRONG_CURRENCY,
		self::CHARGE_EMPTY_FIELDS,
		self::CHARGE_WRONG_TOKEN,
		self::CHARGE_WRONG_ONE_TIME_TOKEN,
		self::CHARGE_WRONG_TEST_CREDENTIALS,
		self::CHARGE_TOKEN_DELETED,
		self::CHARGE_WRONG_MIN_AMOUNT,
		self::CHARGE_WRONG_MAX_AMOUNT,
		self::CHARGE_CARD_NUMBER_ERROR,
		self::CHARGE_CARD_NUMBER_EXPIRED,
		self::CHARGE_UNSUPPORTED_CARD,
		self::CHARGE_UNSUPPORTED_COUNTRY,
		self::CHARGE_CVV_ERROR,
		self::CHARGE_BILLING_ADDRESS_ERROR,
		self::CHARGE_BANK_DECLINE,
		self::CHARGE_INSUFFICIENT_FUNDS,
		self::CHARGE_GATEWAY_DECLINE,
		self::CHARGE_FAILED,
		self::CHARGE_ALREADY_REFUNDED,
		self::CHARGE_CANCEL_FAILED,
		self::CHARGE_ALREADY_CAPTURED,
		self::CHARGE_REFUND_FAILED,
		self::CHARGE_DUPLICATE,
		self::CHARGE_AUTH_EXPIRED,
		self::FIELD_FIRSTNAME,
		self::FIELD_LASTNAME,
		self::FIELD_ADDRESS,
		self::FIELD_CITY,
		self::FIELD_STATE,
		self::FIELD_ZIP,
		self::SUBSCRIPTION_WRONG_PERIOD,
		self::SUBSCRIPTION_NOT_FOUND,
		self::SUBSCRIPTION_WRONG_PERIOD_DURATION,
		self::SUBSCRIPTION_MISSING_TRIAL_PARAMS,
		self::SUBSCRIPTION_WRONG_TRIAL_PERIOD,
		self::SUBSCRIPTION_WRONG_TRIAL_PERIOD_DURATION,
		self::SUBSCRIPTION_WRONG_TRIAL_AMOUNT,
		self::SUBSCRIPTION_WRONG_PAYMENTS_LIMIT,
		self::API_UNDEFINED_METHOD,
		self::API_EMPTY_REQUEST,
		self::API_KEY_MISSED,
		self::API_KEY_INVALID,
		self::API_DECRYPTION_FAILED,
		self::USER_BANNED
	);

	public function process()
	{
		if (!isset($this->response)) {
			return $this->wrapInternalError();
		}

		$response = array(
			'success' => 0,
			'error' => $this->getErrorMessageAndCode($this->response)
		);

		return json_encode($response);
	}

	public function getErrorMessageAndCode($response)
	{
		$result = array();

		if (in_array($response['code'], self::$errorCodes)) {
			$result =  array(
				'message' => $response['error'],
				'code' => $response['code']
			);
		}

		return $result;
	}
}