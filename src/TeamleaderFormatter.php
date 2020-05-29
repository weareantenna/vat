<?php

declare(strict_types=1);

namespace Antenna\Vat;

use RuntimeException;
use function substr;

final class TeamleaderFormatter implements Formatter
{
    public function format(VatNumber $vatNumber) : string
    {
        if (! $vatNumber->isFormatValid()) {
            throw new RuntimeException('Can only format VAT numbers with correct format');
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
            . substr($vatNumber->number(), 0, 4)
            . '.'
            . substr($vatNumber->number(), 4, 3)
            . '.'
            . substr($vatNumber->number(), 7);
    }

    private function formatWithSpace(VatNumber $vatNumber) : string
    {
        return $vatNumber->country()->code()
            . ' '
            . $vatNumber->number();
    }

    private function formatDefault(VatNumber $vatNumber) : string
    {
        return $vatNumber->country()->code()
            . $vatNumber->number();
    }

    private function formatDutch(VatNumber $vatNumber)
    {
        return $vatNumber->country()->code()
            . ' '
            . substr($vatNumber->number(), 0, 4)
            . '.'
            . substr($vatNumber->number(), 4, 2)
            . '.'
            . substr($vatNumber->number(), 6, 3)
            . '.'
            . substr($vatNumber->number(), 9);
    }
}
