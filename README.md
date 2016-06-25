# Send Email

Send PHP based email using mailgun (others soon)

This is compiled into a single email.phar

Downlaod and move to `/usr/local/bin/email`

Accepts 3 params

	./email to@example.com 'Email subject here' 'Email body here'


# Compile

Install https://github.com/box-project/box2 globally, then from the main `email` directory (not src) run `box build`.  This creates a new `./email.phar`.
