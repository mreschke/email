<?php namespace Mreschke\Email;

use Mailgun\Mailgun;
use Http\Adapter\Guzzle6\Client as Guzzle;

class SendMailgunEmail extends SendEmail
{
	public function handle($opts, $config)
	{
		parent::handle($opts, $config);

		// Config options
		$driver = 'mailgun';
		$from = $config['from'];
		$domain = $config[$driver]['domain'];
		$secret = $config[$driver]['secret'];

		// Send mail
		$client = new Guzzle();
		$mailgun = new Mailgun($secret, $client);

		// Convert command options to mailgun options
		$options = [];
		if (isset($from)) $options['from'] = $from;
		if (isset($opts['subject'])) $options['subject'] = $opts['subject'];
		if (isset($opts['to'])) $options['to'] = $opts['to'];
		if (isset($opts['cc'])) $options['cc'] = $opts['cc'];
		if (isset($opts['bcc'])) $options['bcc'] = $opts['bcc'];
		if (isset($opts['text'])) $options['text'] = $opts['text'];
		if (isset($opts['html'])) $options['html'] = $opts['html'];

		// Add any attachments
		$files = [];
		if (isset($opts['file'])) $files['attachment'] = $opts['file'];

		// Send with mailgun
		#var_dump($options);exit();
		$response = $mailgun->sendMessage($domain, $options, $files);
		return $response->http_response_body->message;
	}
}
