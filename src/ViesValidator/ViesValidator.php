<?php

declare(strict_types=1);

namespace Antenna\Vat\ViesValidator;

use Antenna\Vat\VatNumber;

interface ViesValidator
{
    public function isValid(VatNumber $vatNumber) : bool;
}
