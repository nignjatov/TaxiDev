<?php
require_once(APPPATH . 'libraries/exceptions/ConstExceptionCode.php');

class CoreException extends Exception
{
	public function __construct(ConstExceptionCode $exceptionCode, $message)
	{
		$code        = $exceptionCode->getCode();
		$description = $exceptionCode->getDescription();
		$action      = $exceptionCode->getAction();

		parent::__construct($description, $code);

		if ($code != ConstExceptionCode::SUCCESS) {
            log_message('error', 'Error Code: ' . $code . ' Error Message: ' . $description . ' Action: ' . $action);
		}
	}
}

