<?php

declare(strict_types=1);

namespace Antenna\Vat\Exception;

use InvalidArgumentException;
use Throwable;
use function sprintf;

final class InvalidCountryCodeException extends InvalidArgumentException implements VatException
{
    public function __construct(string $countryCode, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Code "%s" is not a valid EU country code.', $countryCode), $code, $previous);
    }
}
