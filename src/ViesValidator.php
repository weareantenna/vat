<?php

declare(strict_types=1);

namespace Antenna\Vat;

interface ViesValidator
{
    public function isValid(VatNumber $vatNumber) : bool;
}
