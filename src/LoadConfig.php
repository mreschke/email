<?php namespace Mreschke\Email;

class LoadConfig
{
	public function handle()
	{
		// Define config file
		$userConfig = $_SERVER['HOME']."/.config/mreschke/email";
		$systemConfig = '/etc/mreschke/email';
		$configFile = 'config.php';

		if (!file_exists("$userConfig/$configFile") && !file_exists("$systemConfig/$configFile")) {
			echo "Config not found, new installation.  Creating $userConfig/$configFile\n";
			echo "You can create a system level config at $systemConfig/$configFile\n";
			echo "User level config overrides system level config\n";
			passthru("mkdir -p $userConfig");
			file_put_contents("$userConfig/$configFile", file_get_contents(__DIR__.'/DefaultConfig.php', TRUE));
		}

		// Require config file (find user or system level configs)
		if (file_exists("$userConfig/$configFile")) {
			$config = require "$userConfig/$configFile";
		} elseif (file_exists("$systemConfig/$configFile")) {
			$config = require "$systemConfig/$configFile";
		}
		return $config;
	}
}
