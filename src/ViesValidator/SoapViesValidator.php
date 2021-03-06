<?php

declare(strict_types=1);

namespace Antenna\Vat\ViesValidator;

use Antenna\Vat\Exception\ViesException;
use Antenna\Vat\VatNumber;
use SoapClient;
use Throwable;

final class SoapViesValidator implements ViesValidator
{
    private const VIES_WDSL = 'https://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl';

    /** @var SoapClient */
    private $soapClient;

    public function __construct(?SoapClient $soapClient = null)
    {
        $this->soapClient = $soapClient ?? new SoapClient(self::VIES_WDSL);
    }

    public function isValid(VatNumber $vatNumber) : bool
    {
        try {
            $response = $this->soapClient->__soapCall(
                'checkVat',
                [
                    [
                        'countryCode' => $vatNumber->country()->code(),
                        'vatNumber' => $vatNumber->normalizedNumber(),
                    ]
                ]
            );
        } catch (Throwable $t) {
            throw new ViesException($t->getMessage(), $t->getCode());
        }

        return $response->valid;
    }
}
