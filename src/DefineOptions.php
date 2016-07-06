<?php namespace Mreschke\Email;

class DefineOptions
{
	/**
	 * Class handler
	 * @param  array $argv
	 * @return array
	 */
	public function handle($argv)
	{
		// All available options (- or --)
		// See http://php.net/manual/en/function.getopt.php
		$allOptions = [
			'short' => [
				'v', // -v version
				'h', // -h help
			],
			'long' => [
				'from:',
				'to:',
				'cc:',
				'bcc:',
				'subject:',
				'text:',
				'html:', 'body:',
				'file:',
				'driver:',
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

		// Body is an alias for HTML
		if (isset($options['body'])) {
			$options['html'] = $options['body'];
			unset($options['body']);
		}

		// Convert any comma separation strings into arrays
		$this->toArray($options, 'to');
		$this->toArray($options, 'cc');
		$this->toArray($options, 'bcc');
		$this->toArray($options, 'file');

		// Return options
		return $options;
	}

	/**
	 * Convert any comma separated strings into arrays
	 * @param  array &$options
	 * @param  string $key
	 * @return void
	 */
	protected function toArray(&$options, $key)
	{
		if (isset($options[$key])) {
			if (is_string($options[$key]) && strpos($options[$key], ',') !== false) {
				$options[$key]= explode(',', $options[$key]);
			}
		}
	}

}
