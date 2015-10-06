<?php

final class ConstExceptionCode
{

	const SUCCESS                       = 0;
	const CALL_ERROR                    = 1;
    const UNKNOWN_ERROR_CODE            = 2;

    const ACTION_FORCE_REFRESH          = 'refresh';
    const ACTION_IGNORE_AND_CONTINUE    = 'ignore';
    const ACTION_NOTIFY_USER_BIG        = 'notify_big';
    const ACTION_NOTIFY_USER_SMALL      = 'notify_small';

	const FRAMEWORK_EXCEPTION           = 99;
	const GENERIC                       = 100;
	const SQL_ERROR                     = 103;
	const DATA_NOT_FOUND                = 104;
	const BAD_ARGUMENT                  = 105;
	const BAD_REQUEST                   = 107;
	const INVALID_ACTION                = 109;
	const DATA_NOT_SAVED                = 110;
	const DATA_REQUIRED                 = 111;
	const CORE_FUNCTION_ERROR           = 114;
	const MISC_FUNCTION_ERROR           = 115;
	const ASSET_DOWNLOAD_FAILED         = 116;

    const WRONG_PASSWORD_ERROR          = 201;
    const EMPTY_PASSWORD_ERROR          = 202;
    const SAME_EMAIL_ERROR              = 203;
    const SAME_USERNAME_ERROR           = 204;
    const INVALID_USER_ERROR            = 205;
    const DUPLICATE_EMAIL_ERROR         = 206;
    const INVALID_EMAIL_ERROR           = 207;
    const UPDATE_SUBSCRIPTION_ERROR     = 208;

	private $code;
	private $code_mapping;

	public  function __construct($code)
	{
		$this->code         = $code;
		$this->code_mapping = $this->getCodeMapping($code);
	}

	public static function instance($code)
	{
		return new ConstExceptionCode($code);
	}

	public function getCode()
	{
		return $this->code;
	}

	public function getCodeMapping($code)
	{
		$mapping = array(
            self::SUCCESS => array(
                "code"        => self::SUCCESS,
                "action"      => self::ACTION_IGNORE_AND_CONTINUE,
                "description" => "No error"),

            self::UNKNOWN_ERROR_CODE                                           => array("code"        => self::UNKNOWN_ERROR_CODE,
                "action"      => self::ACTION_IGNORE_AND_CONTINUE,
                "description" => config_item('general_error_msg')),

            self::GENERIC                                                      => array("code"        => self::GENERIC,
                "action"      => self::ACTION_IGNORE_AND_CONTINUE,
                "description" => config_item('general_error_msg')),

            self::SQL_ERROR                                                    => array("code"        => self::SQL_ERROR,
                "action"      => self::ACTION_IGNORE_AND_CONTINUE,
                "description" => config_item('general_error_msg')),

            self::DATA_NOT_FOUND                                               => array("code"        => self::DATA_NOT_FOUND,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => "Data not found"),

            self::BAD_ARGUMENT                                                 => array("code"        => self::BAD_ARGUMENT,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => "Bad argument"),

            self::BAD_REQUEST                                                  => array("code"        => self::BAD_REQUEST,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => "Bad request"),

            self::INVALID_ACTION                                               => array("code"        => self::INVALID_ACTION,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => "Invalid action"),

            self::DATA_NOT_SAVED                                               => array("code"        => self::DATA_NOT_SAVED,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => "Data not saved"),

            self::DATA_REQUIRED                                                => array("code"        => self::DATA_REQUIRED,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => "Data required"),

            self::CORE_FUNCTION_ERROR                                          => array("code"        => self::CORE_FUNCTION_ERROR,
                "action"      => self::ACTION_IGNORE_AND_CONTINUE,
                "description" => "Core function Error"),

            self::MISC_FUNCTION_ERROR                                          => array("code"        => self::MISC_FUNCTION_ERROR,
                "action"      => self::ACTION_IGNORE_AND_CONTINUE,
                "description" => "Misc Function Error"),

            self::ASSET_DOWNLOAD_FAILED                                        => array("code"        => self::ASSET_DOWNLOAD_FAILED,
                "action"      => self::ACTION_IGNORE_AND_CONTINUE,
                "description" => "Asset download failed."),

            self::WRONG_PASSWORD_ERROR => array(
                "code"        => self::WRONG_PASSWORD_ERROR,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => config_item('wrong_password_error_msg')),

            self::EMPTY_PASSWORD_ERROR => array(
                "code"        => self::EMPTY_PASSWORD_ERROR,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => config_item('empty_password_error_msg')),

            self::SAME_EMAIL_ERROR => array(
                "code"        => self::SAME_EMAIL_ERROR,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => config_item('same_email_error_msg')),

            self::SAME_USERNAME_ERROR => array(
                "code"        => self::SAME_USERNAME_ERROR,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => config_item('same_username_error_msg')),

            self::INVALID_USER_ERROR => array(
                "code"        => self::INVALID_USER_ERROR,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => config_item('no_user_error_msg')),

            self::DUPLICATE_EMAIL_ERROR => array(
                "code"        => self::DUPLICATE_EMAIL_ERROR,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => config_item('duplicate_email_error_msg')),

            self::INVALID_EMAIL_ERROR => array(
                "code"        => self::INVALID_EMAIL_ERROR,
                "action"      => self::ACTION_NOTIFY_USER_SMALL,
                "description" => config_item('invalid_email_error_msg')),

            self::UPDATE_SUBSCRIPTION_ERROR => array(
                "code"        => self::UPDATE_SUBSCRIPTION_ERROR,
                "action"      => self::ACTION_NOTIFY_USER_BIG,
                "description" => config_item('update_subscription_error_msg'))
		);

		return (!empty($mapping[$code]) ? $mapping[$code] : $mapping[self::UNKNOWN_ERROR_CODE]);
	}

	public function getAction()
	{
		return $this->code_mapping["action"];
	}

	public function getDescription()
	{
		return $this->code_mapping["description"];
	}
}

?>
