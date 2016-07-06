# Send Email

Send email from the command line using PHP's smtp, mailgun, mandril or other drivers.

ex: `./email --to`


# Installation

Simply download the `email.phar` and move to the location of your preference.

	wget https://github.com/mreschke/email/raw/master/email.phar -O /usr/local/bin/email
	chmod a+x /usr/local/bin/email

Then run `/usr/local/bin/email` just once for the first time and it will
automatically create a user based configuration file in `~/.config/mreschke/email` which
you will need to edit with your mail driver and API keys.

If you prefer a global config file vs a user based config, simply `sudo mkdir /etc/mreschke & sudo mv ~/.config/mreschke/email /etc/mreschke`.  The email system will
always use the user config first if exists.


# Usage

Run `email` with no parameters to see help and usage information.


# Compile Yourself

Install https://github.com/box-project/box2 globally, then from the main `email` directory (not src) run `box build`.  This creates a new `./email.phar`.
