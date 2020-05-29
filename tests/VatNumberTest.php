<?php

declare(strict_types=1);

namespace Antenna\Vat\Tests;

use Antenna\Vat\Country;
use Antenna\Vat\VatNumber;
use PHPUnit\Framework\TestCase;

final class VatNumberTest extends TestCase
{
    public function testItKeepsFormatting() : void
    {
        $vatNumber = new VatNumber('BE 0123-456-749');
        self::assertEquals('BE 0123-456-749', $vatNumber->toString());
    }

    public function testItCanNormalizeVatNumber() : void
    {
        $vatNumber = new VatNumber('BE 0123-456-749');
        self::assertEquals('BE0123456749', $vatNumber->toNormalizedString());
    }

    /**
     * @dataProvider providesNumbersAndCountries
     */
    public function testItCanDetermineCountry(string $vatNumber, Country $expectedCountry) : void
    {
        $vatNumber = new VatNumber($vatNumber);
        self::assertEquals($expectedCountry, $vatNumber->country());
    }

    public function providesNumbersAndCountries() : array
    {
        return [
            'Austrian' => ['ATU33864707', Country::fromCode('AT')],
            'Belgian' => ['BE0123456749', Country::fromCode('BE')],
            'Bulgarian' => ['BG204830885', Country::fromCode('BG')],
            'Cypriot' => ['CY10341761I', Country::fromCode('CY')],
            'Czech' => ['CZ00177041', Country::fromCode('CZ')],
            'German' => ['DE811115368', Country::fromCode('DE')],
            'Danish' => ['DK61126228', Country::fromCode('DK')],
            'Estonian' => ['EE100366327', Country::fromCode('EE')],
            'Greek' => ['EL094014249', Country::fromCode('EL')],
            'Spanish' => ['ESA28023430', Country::fromCode('ES')],
            'Finnish' => ['FI10390508', Country::fromCode('FI')],
            'French' => ['FR66780129987', Country::fromCode('FR')],
            'British' => ['GB679005812', Country::fromCode('GB')],
            'Croatian' => ['HR29646543120', Country::fromCode('HR')],
            'Hungarian' => ['HU11500906', Country::fromCode('HU')],
            'Irish' => ['IE6388047V', Country::fromCode('IE')],
            'Italian' => ['IT00591801204', Country::fromCode('IT')],
            'Luxembourgian' => ['LU14344162', Country::fromCode('LU')],
            'Lithuanian' => ['LT512072610', Country::fromCode('LT')],
            'Latvian' => ['LV41203023401', Country::fromCode('LV')],
            'Maltese' => ['MT15143613', Country::fromCode('MT')],
            'Dutch' => ['NL001632553B28', Country::fromCode('NL')],
            'Polish' => ['PL7792076889', Country::fromCode('PL')],
            'Portuguese' => ['PT501945997', Country::fromCode('PT')],
            'Romanian' => ['RO21572099', Country::fromCode('RO')],
            'Swedish' => ['SE556074308901', Country::fromCode('SE')],
            'Slovenian' => ['SI47893664', Country::fromCode('SI')],
            'Slovakian' => ['SK2022781442', Country::fromCode('SK')],
        ];
    }

    /**
     * @dataProvider providesNumbers
     */
    public function testItCanDetermineNumber(string $vatNumber, string $expectedNumber) : void
    {
        $vatNumber = new VatNumber($vatNumber);
        self::assertEquals($expectedNumber, $vatNumber->normalizedNumber());
    }

    public function providesNumbers() : array
    {
        return [
            'WithDots' => ['BE0123.456.749', '0123456749'],
            'WithSpaces' => ['BE 0123 456 749', '0123456749'],
            'WithOtherCharacters' => ['BE+0123-456-749', '0123456749'],
        ];
    }

    public function testItValidatesFormat() : void
    {
        $vatNumber = new VatNumber('BE0123456749');
        self::assertTrue($vatNumber->isFormatValid());

        $vatNumber = new VatNumber('BE0123456748');
        self::assertFalse($vatNumber->isFormatValid());
    }
}
