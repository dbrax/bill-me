<img src="https://github.com/dbrax/bill-me/blob/main/bill-me.jpeg">
# Add Billing Functionalities To Your Web Application.( Made for web artisans )

[![Latest Version on Packagist](https://img.shields.io/packagist/v/epmnzava/bill-me.svg?style=flat-square)](https://packagist.org/packages/epmnzava/bill-me)
[![Quality Score](https://img.shields.io/scrutinizer/g/dbrax/bill-me.svg?style=flat-square)](https://scrutinizer-ci.com/g/dbrax/bill-me)
[![Total Downloads](https://img.shields.io/packagist/dt/epmnzava/bill-me.svg?style=flat-square)](https://packagist.org/packages/epmnzava/bill-me)

> A laravel package that lets you quickly add billing functionalities to your laravel web application.


## Features
 + **Order Management**
 + **Invoice Management**
 + **Receipt Management**
 + **Order and Invoice Statistics**
 + **Mail and Sms Notifications**
 + **Order and Invoice Queries**


## Installation

You can install the package via composer:

```bash
composer require epmnzava/bill-me
```

## Usage

``` php
// how to use the package coming soon

BillMe::createOrder("emmanuel","Mnzava","epmnzava@gmail.com","","200","paypal","","Brooklyn Park",[["amount"=>"200","quantity"=>1,"Item"=>"Replacement Fee","description"=>"purchased moto moto"]],2);
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email epmnzava@gmail.com instead of using the issue tracker.

## Credits

- [Emmanuel Mnzava](https://github.com/epmnzava)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

