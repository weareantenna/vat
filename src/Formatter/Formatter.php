<?php

declare(strict_types=1);

namespace Antenna\Vat\Formatter;

use Antenna\Vat\VatNumber;

interface Formatter
{
    public function format(VatNumber $vatNumber) : string;
}
