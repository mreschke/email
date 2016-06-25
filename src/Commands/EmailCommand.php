<?php

namespace Mreschke\Email\Commands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EmailCommand extends Command
{
	protected $config;

	public function __construct($config)
	{
		$this->config = $config;
		parent::__construct();
	}

	/**
	 * Configures the current command.
	 */
	protected function configure()
	{
		$this
			->setName('send')
			->setDescription('Send email')
			->addArgument('to',
				InputArgument::REQUIRED,
				'Recipients'
			)
			->addArgument('subject',
				InputArgument::REQUIRED,
				'Subject'
			)
			->addArgument('body',
				InputArgument::REQUIRED,
				'Body'
			);

			/*->addOption(
				'yell',
				null,
				InputOption::VALUE_NONE,
				'If set, the task will yell in uppercase letters'
			);*/
	}

	/**
	 * Executes the current command.
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		#var_dump($input);
		$to = $input->getArgument('to');
		$subject = $input->getArgument('subject');
		$body = $input->getArgument('body');

		// Get config information
		$driver = $this->config['driver'];
		$from = $this->config['from'];
		$domain = $this->config[$driver]['domain'];
		$secret = $this->config[$driver]['secret'];

		// Send mail
		$client = new \Http\Adapter\Guzzle6\Client();
		$mailgun = new \Mailgun\Mailgun($secret, $client);
		$mailgun->sendMessage($domain, [
			'from' => $from,
			'to'      => $to,
			'subject' => $subject,
			'html'    => $body
		]);

	}

}
