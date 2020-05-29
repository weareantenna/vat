# VAT

This library will help you deal with VAT numbers in a controlled manner. It uses the [DragonBe/vies package](https://github.com/DragonBe/vies) to first validate the format of an EU VAT number. Afterwards, you can validate if the number has been issued with the [VIES](https://ec.europa.eu/taxation_customs/vies/) validator. 

## Installation

This package requires PHP 7.4 or higher.

```
composer require weareantenna/vat 
```

## Usage

```php
<?php

$vatNumber = new \Antenna\Vat\VatNumber('BE0123 456 749');
$validator = new \Antenna\Vat\ViesValidator\SoapViesValidator();

echo $vatNumber->toString(); // BE0123 456 749
echo $vatNumber->toNormalizedString(); // BE0123456749

if ($vatNumber->isFormatValid()) {
    try {
        $isRegistered = $validator->isValid($vatNumber); 
    } catch (RuntimeException $e) {
        // something went wrong when trying to validate against VIES
    }
}
```

You should build support into your application for the VIES service to be unavailable. Either VIES itself, or the underlying services VIES uses, are known to be unavailable from time to time. Either trust your users or implement some kind of retry method.

### Formatting

The `VatNumber` class retains the formatting of the entered VAT number. This is convenient when you want to save exactly what your users have entered or are dealing with legacy data.

A method to normalize numbers is provided, which will uppercase the entire VAT number and strip all non-alphanumeric characters. 

In case you want to further format VAT numbers, it is possible to implement a `Antenna\Formatter\Formatter` interface. 

Included in this package is a `TeamleaderFormatter`. This formatter will format VAT numbers exactly as [Teamleader CRM](https://www.teamleader.eu/) does internally.

```php
<?php

use Antenna\Vat\VatNumber;
use Antenna\Vat\Formatter\TeamleaderFormatter;

$formatter = new TeamleaderFormatter();

echo $formatter->format(new VatNumber('BE0123456749')); // BE 0123.456.749
echo $formatter->format(new VatNumber('NL001632553B28')); // NL 0016.32.553.B28
``` 

This will help you find companies through their API as VAT numbers need to formatted in their format.
