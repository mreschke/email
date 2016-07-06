<?php namespace Mreschke\Email;

class ShowUsage
{
	/**
	 * Class handler
	 * @return string
	 */
	public function handle()
	{

return "Email console command
Copyright (C) 2016 mReschke.com
This program may be freely redistributed under the terms of the MIT license.

Send email from the command line using PHP's smtp, mailgun, mandril or other drivers.

Options:
 --to             Add recipients (one or more --file or , separated string)
 --cc             Add cc recipients (one or more --file or , separated string)
 --bcc            Add bcc recipients (one or more --file or , separated string)
 --subject        Email subject
 --text           Email body (as text not html)
 --html, --body   Email body (as html)
 --file           Add attachment (one or more --file or , separated string)
 --from           Override from address defined in config file
 --driver         Override driver defined in config file
 -v, --version    Show version
 -h, --help       Show help and usage

If no --text, --html or --body is define, it will assume STDIN

Examples:
 email --to=me@mail.com --subject='Hi' --body='Sup'
 email --to=me@mail.com --subject='Hi' --text=\"$(cat /tmp/file.txt)\"
 cat /tmp/file | email --to=me@mail.com --subject='Hi'
 uname -a | email --to=me@mail.com --subject='Hi'
 email --to=me@mail.com --bcc=you@mail.com --subject='Hi' --body='There' --file=/tmp/file.txt
 email --to=me@mail.com,you@mail.com --subject='Hi' --body='There'
 email --to=me@mail.com --to=you@mail.com --subject='Hi' --body='There'
 email --to=me@mail.com --subject='Hi' --body='There' --from='Me <me@me.com>'
 email --to=me@mail.com --subject='Hi' --body='There' --driver=smtp

There is also a shorthand notation without using any -- (last file argument is optional)
 email me@mail.com 'Subject' 'Body Here'
 email me@mail.com,email2@mail.com 'Subject' 'Body Here'
 email me@mail.com 'Subject' 'Body Here' /tmp/file.txt
 email me@mail.com 'Subject' 'Body Here' /tmp/file.txt,/tmp/file2.txt

";
	}
}
