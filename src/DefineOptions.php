<?php namespace Mreschke\Email;

class DefineOptions
{
	public function handle($argv)
	{
		// All options (- or --)
		$allOptions = [
			'short' => [
				'v', // -v version
				'h', // -h help
			],
			'long' => [
				'to:',
				'cc:',
				'bcc:',
				'subject:',
				'text:',
				'html:', 'body:',
				'file:',
				'version',
				'help'
			]
		];

		// Parse options
		$options = getopt(implode($allOptions['short']), $allOptions['long']);

		// Legacy converter
		if (empty($options)) {
			if (count($argv) >= 4) {
				$options = [
					'to' => $argv[1],
					'subject' => $argv[2],
					'html' => $argv[3],
				];
				if (isset($argv[4])) $options['file'] = $argv[4];
			}
		}
		return $options;
	}

}
