<?php

declare(strict_types=1);

namespace Antenna\Vat\Formatter;

use Antenna\Vat\Exception\InvalidFormatException;
use Antenna\Vat\VatNumber;

interface Formatter
{
    /**
     * @throws InvalidFormatException
     */
    public function format(VatNumber $vatNumber) : string;
}
