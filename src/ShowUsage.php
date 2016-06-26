<?php namespace Mreschke\Email;

class ShowUsage
{
	public function handle()
	{

return "Email console command
Copyright (C) 2016 mReschke.com
This program may be freely redistributed under the terms of the MIT license.

A simple PHP console command to send email using various drivers like mandril, mailgun...

Options:
 --to             Add recipients (multiple --to or , separated string)
 --cc             Add cc recipients (multiple --cc or , separated string)
 --bcc            Add bcc recipients (multiple --bcc or , separated string)
 --subject        Email subject
 --text           Email body (as text not html)
 --html, --body   Email body (as html)
 --file           Add attachment (multiple --file or , separated string of files)
 -v, --version    Show version
 -h, --help       Show help and usage

";
	}
}
