<?php

declare(strict_types=1);

namespace Antenna\Vat;

interface Formatter
{
    public function format(VatNumber $vatNumber) : string;
}
