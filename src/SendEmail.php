<?php namespace Mreschke\Email;

class SendEmail
{

	public function handle($opts, $config)
	{
		
	}

	protected function value($array, $key)
	{
		return isset($array[$key]) ? $array[$key] : null;
	}
}
