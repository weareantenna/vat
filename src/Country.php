<?php

declare(strict_types=1);

namespace Antenna\Vat;

use DragonBe\Vies\Validator;
use InvalidArgumentException;
use function array_key_exists;
use function sprintf;

final class Country
{
    private const COUNTRIES = [
        'AT' => Validator\ValidatorAT::class,
        'BE' => Validator\ValidatorBE::class,
        'BG' => Validator\ValidatorBG::class,
        'CY' => Validator\ValidatorCY::class,
        'CZ' => Validator\ValidatorCZ::class,
        'DE' => Validator\ValidatorDE::class,
        'DK' => Validator\ValidatorDK::class,
        'EE' => Validator\ValidatorEE::class,
        'EL' => Validator\ValidatorEL::class,
        'ES' => Validator\ValidatorES::class,
        'FI' => Validator\ValidatorFI::class,
        'FR' => Validator\ValidatorFR::class,
        'HR' => Validator\ValidatorHR::class,
        'HU' => Validator\ValidatorHU::class,
        'IE' => Validator\ValidatorIE::class,
        'IT' => Validator\ValidatorIT::class,
        'LU' => Validator\ValidatorLU::class,
        'LV' => Validator\ValidatorLV::class,
        'LT' => Validator\ValidatorLT::class,
        'MT' => Validator\ValidatorMT::class,
        'NL' => Validator\ValidatorNL::class,
        'PL' => Validator\ValidatorPL::class,
        'PT' => Validator\ValidatorPT::class,
        'RO' => Validator\ValidatorRO::class,
        'SE' => Validator\ValidatorSE::class,
        'SI' => Validator\ValidatorSI::class,
        'SK' => Validator\ValidatorSK::class,
        'GB' => Validator\ValidatorGB::class,
    ];

    /** @var string */
    private $code;

    private function __construct(string $code)
    {
        $this->code = $code;
    }

    public static function fromCode(string $code) : self
    {
        if (array_key_exists($code, self::COUNTRIES)) {
            return new self($code);
        }

        throw new InvalidArgumentException(sprintf('Code "%s" is not a valid country code.', $code));
    }

    public function code() : string
    {
        return $this->code;
    }

    public function validator() : Validator\ValidatorInterface
    {
        $validatorClass = self::COUNTRIES[$this->code];

        return new $validatorClass();
    }
}
