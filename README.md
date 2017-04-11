# Seeker PHP Framework

Seeker is a minimal PHP framework that helps you quickly start writing web applications from the ground up. It only gives you the VC part of MVC, making no assumptions about the kind of models you want to work with, though we are fans of the domain model.

## Installation

1- Clone this repository

2- Run the following command to install all dependencies
```bash
$ composer install
```

3- Fire it up with the PHP built-in server (or an Apache virtual host) and off you go!
```
$ php -S localhost:8080 -t public/
```

You can test everything is working correctly by going to http://localhost:8080 which should now display a welcome page.

## Server Requirements

Seeker is intended to be used with PHP 7.

It would probably still work with PHP 5.6 and newer versions but that's NOT recommended.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The Seeker framework is licensed under the MIT license. See [License File](LICENSE.md) for more information.
