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
        $countryCode = substr($this->stripped(), 0, 2);

        try {
            return Country::fromCode($countryCode);
        } catch (InvalidArgumentException $e) {
            throw new RuntimeException(
                sprintf('Unable to determine valid country for vat number "%s"', $this->vatNumber)
            );
        }
    }

    public function number() : string
    {
        return substr($this->stripped(), 2);
    }

    public function stripped() : string
    {
        return preg_replace('/[^a-zA-Z0-9]+/', '', $this->vatNumber);
    }

    public function isFormatValid() : bool
    {
        return $this->country()->validator()->validate($this->number());
    }
}
