<?php
/**
 * Copyright, Pronko Consulting
 * See LICENSE for license details.
 */

namespace Pronko\ConvergePaymentSpiCommon;

use Pronko\ConvergePaymentApi\Config\TransactionFields;
use Pronko\ConvergePaymentSpi;

use Pronko\ConvergePaymentSpi\ValidatorInterface;
use Pronko\ConvergePaymentSpi\ValidatorException;

/**
 * Class ValidationService.
 * @private
 */
class ValidationService implements ConvergePaymentSpi\ValidationService
{
    /**
     * @var ValidatorInterface[][]
     */
    private $validators;

    /**
     * ValidationService constructor.
     *
     * @param ValidationService[][] $validators
     */
    public function __construct(
        array $validators
    ) {
        $this->validators = $validators;
    }

    /**
     * @inheritDoc
     */
    public function validate(array $request, array $response)
    {
        $transactionName = $request[TransactionFields::SSL_TRANSACTION_TYPE];
        $errors = [];
        $validators = isset($this->validators[$transactionName]) ? (array) $this->validators[$transactionName] : [];
        foreach ($validators as $validator) {
            if ($validator instanceof ValidatorInterface) {
                try {
                    $validator->validate($request, $response);
                } catch (ValidatorException $e) {
                    $errors[] = $e->getMessage();
                }
            }
        }

        if ($errors) {
            throw new ValidatorException(implode("\n", $errors));
        }
        return true;
    }
}
