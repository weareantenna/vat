<?php

declare(strict_types=1);

namespace Antenna\Vat\Exception;

use RuntimeException;
use Throwable;

final class InvalidFormatException extends RuntimeException implements VatException
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct('Can only format VAT numbers with correct format', $code, $previous);
    }
}
