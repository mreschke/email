<?php namespace Mreschke\Email;

use Mailgun\Mailgun;
use Http\Adapter\Guzzle6\Client as Guzzle;

class SendMailgunEmail extends SendEmail
{
	/**
	 * Class handler
	 * @param  array $options
	 * @param  array $config
	 * @return mixed
	 */
	public function handle($options, $config)
	{
		// Call parent handler
		parent::handle($options, $config);

		// Config options
		$driver = 'mailgun';
		$from = $config['from'];
		$domain = $config[$driver]['domain'];
		$secret = $config[$driver]['secret'];

		// Instantiate Mailgun
		$client = new Guzzle();
		$mailgun = new Mailgun($secret, $client);

		// Convert command line options to mailgun options
		$mailgunOptions = [];
		if (isset($from)) $mailgunOptions['from'] = $from;
		if (isset($options['from'])) $mailgunOptions['from'] = $options['from'];
		if (isset($options['subject'])) $mailgunOptions['subject'] = $options['subject'];
		if (isset($options['to'])) $mailgunOptions['to'] = $options['to'];
		if (isset($options['cc'])) $mailgunOptions['cc'] = $options['cc'];
		if (isset($options['bcc'])) $mailgunOptions['bcc'] = $options['bcc'];
		if (isset($options['text'])) $mailgunOptions['text'] = $options['text'];
		if (isset($options['html'])) $mailgunOptions['html'] = $options['html'];

		// Mailgun will not send with empty body...lets change that
		if (isset($mailgunOptions['text']) && $mailgunOptions['text'] == "") $mailgunOptions['text'] = " ";
		if (isset($mailgunOptions['html']) && $mailgunOptions['html'] == "") $mailgunOptions['html'] = " ";

		#var_dump($mailgunOptions);
		#exit();

		// Add any file attachments
		$files = [];
		if (isset($options['file'])) $files['attachment'] = $options['file'];

		// Send with mailgun
		$response = $mailgun->sendMessage($domain, $mailgunOptions, $files);
		$status = $response->http_response_body->message;

		// If there is a mailgun error, it will throw error and die before it returns true
		return true;
	}
}
