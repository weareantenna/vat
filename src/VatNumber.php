<?php

declare(strict_types=1);

namespace Antenna\Vat;

use InvalidArgumentException;
use RuntimeException;
use function preg_replace;
use function sprintf;
use function substr;

final class VatNumber
{
    private string $vatNumber;

    public function __construct(string $vatNumber)
    {
        $this->vatNumber = $vatNumber;
    }

    public function country() : Country
    {
        $countryCode = substr($this->toNormalizedString(), 0, 2);

        try {
            return Country::fromCode($countryCode);
        } catch (InvalidArgumentException $e) {
            throw new RuntimeException(
                sprintf('Unable to determine valid country for vat number "%s"', $this->vatNumber)
            );
        }
    }

    public function normalizedNumber() : string
    {
        return substr($this->toNormalizedString(), 2);
    }

    public function toString() : string
    {
        return $this->vatNumber;
    }

    public function toNormalizedString() : string
    {
        return preg_replace('/[^A-Z0-9]+/', '', strtoupper($this->vatNumber));
    }

    public function isFormatValid() : bool
    {
        return $this->country()->validator()->validate($this->normalizedNumber());
    }
}
