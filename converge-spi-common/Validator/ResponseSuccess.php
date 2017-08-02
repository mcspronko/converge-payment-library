<?php
/**
 * Copyright, Pronko Consulting
 * See LICENSE for license details.
 */

namespace Pronko\ConvergePaymentSpiCommon\Validator;

use Pronko\ConvergePaymentApi\ValidationException;
use Pronko\ConvergePaymentSpi\ValidatorInterface;

/**
 * Class ResponseSuccess
 */
class ResponseSuccess implements ValidatorInterface
{
    /**
     * @param array $request
     * @param array $response
     * @return bool
     * @throws ValidationException
     * @SuppressWarnings("PMD.UnusedFormalParameter")
     */
    public function validate(array $request, array $response)
    {
        $errorCode = null;

        if (isset($response['errorCode']) && $response['errorCode'] != 0) {
            $errorCode = $response['errorCode'];
        }

        if ($errorCode) {
            throw new ValidationException($response['errorMessage'], $response['errorCode']);
        }

        return true;
    }
}
