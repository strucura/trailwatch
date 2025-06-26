# Tracks and reports upon api usage.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/strucura/trailwatch.svg?style=flat-square)](https://packagist.org/packages/strucura/trailwatch)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/strucura/trailwatch/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/strucura/trailwatch/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/strucura/trailwatch/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/strucura/trailwatch/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/strucura/trailwatch.svg?style=flat-square)](https://packagist.org/packages/strucura/trailwatch)

> [!WARNING]  
> This is a work in progress and not ready for use.

## Installation

You can install the package via composer:

```bash
composer require strucura/trailwatch
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="trailwatch-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="trailwatch-config"
```

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

- [Andrew Leach](https://github.com/7387639+andyleach)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
