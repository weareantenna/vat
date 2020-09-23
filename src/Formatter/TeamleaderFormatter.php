<?php

declare(strict_types=1);

namespace Antenna\Vat\Formatter;

use Antenna\Vat\Country;
use Antenna\Vat\Exception\InvalidFormatException;
use Antenna\Vat\VatNumber;
use function substr;

final class TeamleaderFormatter implements Formatter
{
    public function format(VatNumber $vatNumber) : string
    {
        if (! $vatNumber->isFormatValid()) {
            throw new InvalidFormatException();
        }

        switch ($vatNumber->country()) {
            case Country::fromCode('BE'):
                return $this->formatBelgium($vatNumber);
            case Country::fromCode('NL'):
                return $this->formatDutch($vatNumber);
            case Country::fromCode('DE'):
            case Country::fromCode('ES'):
            case Country::fromCode('FR'):
                return $this->formatWithSpace($vatNumber);
            default:
                return $this->formatDefault($vatNumber);
        }
    }

    private function formatBelgium(VatNumber $vatNumber) : string
    {
        return $vatNumber->country()->code()
            . ' '
            . substr($vatNumber->normalizedNumber(), 0, 4)
            . '.'
            . substr($vatNumber->normalizedNumber(), 4, 3)
            . '.'
            . substr($vatNumber->normalizedNumber(), 7);
    }

    private function formatWithSpace(VatNumber $vatNumber) : string
    {
        return $vatNumber->country()->code()
            . ' '
            . $vatNumber->normalizedNumber();
    }

    private function formatDefault(VatNumber $vatNumber) : string
    {
        return $vatNumber->country()->code()
            . $vatNumber->normalizedNumber();
    }

    private function formatDutch(VatNumber $vatNumber)
    {
        return $vatNumber->country()->code()
            . ' '
            . substr($vatNumber->normalizedNumber(), 0, 4)
            . '.'
            . substr($vatNumber->normalizedNumber(), 4, 2)
            . '.'
            . substr($vatNumber->normalizedNumber(), 6, 3)
            . '.'
            . substr($vatNumber->normalizedNumber(), 9);
    }
}
