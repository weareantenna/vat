<?php

declare(strict_types=1);

namespace Antenna\Vat;

use Antenna\Vat\Exception\InvalidCountryCodeException;
use function preg_replace;
use function substr;

final class VatNumber
{
    /** @var string */
    private $vatNumber;

    public function __construct(string $vatNumber)
    {
        $this->vatNumber = $vatNumber;
    }

    /**
     * @throws InvalidCountryCodeException
     */
    public function country() : Country
    {
        $countryCode = substr($this->toNormalizedString(), 0, 2);

        return Country::fromCode($countryCode);
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

    /**
     * @throws InvalidCountryCodeException
     */
    public function isFormatValid() : bool
    {
        return $this->country()->validator()->validate($this->normalizedNumber());
    }
}
