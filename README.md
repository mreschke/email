# Send Email

Send PHP based email using mailgun (others soon)

This is compiled into a single `email.phar`

Downlaod and move to `/usr/local/bin/send-email`

Accepts 3 params

	send-email send to@example.com 'Email subject here' 'Email body here'

On first run this will create a `~/.config/mreschke/email/config.php` config file.  Edit this file with your mailgun secret and domain.  If you prefer a system wide config, you can create a `/etc/mreschke/email/config.php` file and DELETE the one in `~/.config/mreschke/email` as user level configs override system level configs.


# Compile

Install https://github.com/box-project/box2 globally, then from the main `email` directory (not src) run `box build`.  This creates a new `./email.phar`.



email
	--to=a,b
		--to=a
		--to=b
	--subject='asdfasdfasdf'
	--text='asdfasdf'
		--html='asdfasd'





	{
		"name": "mreschke/email",
		"description": "Send email console command",
		"license": "MIT",
		"authors": [
			{
				"name": "Matthew Reschke",
				"email": "mail@mreschke.com"
			}
		],
		"require": {
			"mailgun/mailgun-php": "~2.0",
			"symfony/console": "~3.0",
			"symfony/process": "~3.0",
			"php-http/guzzle6-adapter": "^1.0"
		},
		"autoload": {
			"psr-4": {
				"Mreschke\\Email\\": "src\\"
			}
		}
	}
