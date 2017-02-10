<?php namespace Mreschke\Email;

use Swift_Mailer;
use Swift_Message;
use Mailgun\Mailgun;
use Swift_Attachment;
use Swift_SmtpTransport;
use Http\Adapter\Guzzle6\Client as Guzzle;

class SendSmtpEmail extends SendEmail
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
        $driver = 'smtp';
        $server = $config[$driver]['server'];
        $port = $config[$driver]['port'];
        $username = $config[$driver]['username'];
        $password = $config[$driver]['password'];
        $ssl = $config[$driver]['ssl'];

        $from = isset($options['from']) ? $options['from'] : $config['from'];
        if (preg_match('/</', $from)) {
            // From format: Matthew Reschke <mail@example.com>
            list($fromName, $fromAddress) = explode('<', $from);
            $fromName = trim($fromName);
            $fromAddress = trim($fromAddress);
            $fromAddress = preg_replace('/>/', '', $fromAddress);
        }
        $subject = isset($options['subject']) ? $options['subject'] : "";
        $body = isset($options['html']) ? $options['html'] : (isset($options['text']) ? $options['text'] : 'x');
        $to = isset($options['to']) ? $options['to'] : null;
        $cc = isset($options['cc']) ? $options['cc'] : null;
        $bcc = isset($options['bcc']) ? $options['bcc'] : null;
        


        // Create the Transport
        $ssl = $ssl == true ? 'ssl' : null;
        $transport = Swift_SmtpTransport::newInstance($server, $port, $ssl)->setUsername($username)->setPassword($password);

        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        // Create message
        $message = Swift_Message::newInstance($options['subject']);
        $message->setTo($to);
        if (isset($fromName)) {
            $message->setFrom([$fromAddress => $fromName]);
        } else {
            $message->setFrom($from);
        }
        $message->setBody($body);
        
        if ($cc) $message->setCc($cc);
        if ($bcc) $message->setBcc($bcc);
        if (isset($options['file'])) {
            foreach ($options['file'] as $file) {
                $message->attach(Swift_Attachment::fromPath($file));
            }
        }

        // Send the message
        if (!$mailer->send($message, $failures)) {
            echo "Failures:";
            print_r($failures);
            return false;
        } else {
            // If there is a swift error, it will throw error and die before it returns true
            return true;
        }
    }
}
