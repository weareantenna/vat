<?php

declare(strict_types=1);

namespace Antenna\Vat\Tests;

use Antenna\Vat\TeamleaderFormatter;
use Antenna\Vat\VatNumber;
use PHPUnit\Framework\TestCase;

final class TeamleaderFormatterTest extends TestCase
{
    private TeamleaderFormatter $formatter;

    protected function setUp() : void
    {
        $this->formatter = new TeamleaderFormatter();
    }

    /**
     * @dataProvider providesVatNumbers
     */
    public function testItFormatsVatNumbers(string $given, string $expected) : void
    {
        $vatNumber = new VatNumber($given);
        self::assertEquals($expected, $this->formatter->format($vatNumber));
    }

    public function providesVatNumbers() : array
    {
        return [
            'Austrian' => ['ATU33864707', 'ATU33864707'],
            'Belgian' => ['BE0123456749', 'BE 0123.456.749'],
            'Bulgarian' => ['BG204830885', 'BG204830885'],
            'Cypriot' => ['CY10341761I', 'CY10341761I'],
            'Czech' => ['CZ00177041', 'CZ00177041'],
            'German' => ['DE811115368', 'DE 811115368'],
            'Danish' => ['DK61126228', 'DK61126228'],
            'Estonian' => ['EE100366327', 'EE100366327'],
            'Greek' => ['EL094014249', 'EL094014249'],
            'Spanish' => ['ESA28023430', 'ES A28023430'],
            'Finnish' => ['FI10390508', 'FI10390508'],
            'French' => ['FR66777811096', 'FR 66777811096'],
            'British' => ['GB679005812', 'GB679005812'],
            'Croatian' => ['HR29646543120', 'HR29646543120'],
            'Hungarian' => ['HU11500906', 'HU11500906'],
            'Irish' => ['IE6388047V', 'IE6388047V'],
            'Italian' => ['IT00591801204', 'IT00591801204'],
            'Luxembourgian' => ['LU14344162', 'LU14344162'],
            'Lithuanian' => ['LT512072610', 'LT512072610'],
            'Latvian' => ['LV41203023401', 'LV41203023401'],
            'Maltese' => ['MT15143613', 'MT15143613'],
            'Dutch' => ['NL001632553B28', 'NL 0016.325.53.B28'],
            'Polish' => ['PL7792076889', 'PL7792076889'],
            'Portuguese' => ['PT501945997', 'PT501945997'],
            'Romanian' => ['RO21572099', 'RO21572099'],
            'Swedish' => ['SE556074308901', 'SE556074308901'],
            'Slovenian' => ['SI47893664', 'SI47893664'],
            'Slovakian' => ['SK2022781442', 'SK2022781442'],
        ];
    }
}
