# Driver-based 2FA for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/modernmcguire/drawbridge.svg?style=flat-square)](https://packagist.org/packages/modernmcguire/drawbridge)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/modernmcguire/drawbridge/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/modernmcguire/drawbridge/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/modernmcguire/drawbridge/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/modernmcguire/drawbridge/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/modernmcguire/drawbridge.svg?style=flat-square)](https://packagist.org/packages/modernmcguire/drawbridge)

Add 2FA support to your Laravel Application!

## Installation

You can install the package via composer:

```bash
composer require modernmcguire/drawbridge
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="drawbridge-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="drawbridge-config"
```

Optionally, you can publish the login and email using

```bash
php artisan vendor:publish --tag="drawbridge-views"
```

## Config

The package has multiple drivers to choose from. You can set the driver in the config file or your env.

```php
'default_driver' => env('OTP_DRIVER', 'email'),
```

> Note: Currently the only one that is setup is the email driver.

## Usage

1. Run Migrations
2. Apply the `HandlesOTP` trait to your User model
3. Set `two_factor_enabled` to true on the user
4. Login!

You will be redirected to a page to enter your OTP code.

## Database

New database fields will be added to your `users` table.


| Field                 | Description                            |
|-----------------------|----------------------------------------|
| two_factor_enabled    | Whether two-factor authentication is enabled |
| otp_secret            | The OTP code to match against           |
| otp_secret_expires_at | The time the OTP code expires (default: 5 minutes) |


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ben Miller](https://github.com/modernben)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
