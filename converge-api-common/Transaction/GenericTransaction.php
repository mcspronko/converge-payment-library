<?php
/**
 * Copyright, Pronko Consulting
 * See LICENSE for license details.
 */

namespace Pronko\ConvergePaymentApiCommon\Transaction;

use Pronko\ConvergePaymentApi\Config\TransactionFields;
use Pronko\ConvergePaymentApi\Transaction;
use Pronko\ConvergePaymentApi\ValidationException;
use Pronko\ConvergePaymentSpi\TransactionService;
use Pronko\ConvergePaymentSpi\ValidationService;

/**
 * Class GenericTransaction
 * @private
 */
class GenericTransaction implements Transaction
{
    /**
     * @var TransactionService
     */
    private $transactionService;

    /**
     * @var ValidationService
     */
    private $validationService;

    /**
     * Generic transaction class implementation constructor
     *
     * @param TransactionService $transactionService
     * @param ValidationService $validationService
     */
    public function __construct(TransactionService $transactionService, ValidationService $validationService)
    {
        $this->transactionService = $transactionService;
        $this->validationService = $validationService;
    }

    /**
     * @inheritdoc
     */
    public function execute(array $request)
    {
        if (!isset($request[TransactionFields::TRANSACTION_TYPE])) {
            throw new ValidationException("Missed Transaction Type in response.");
        }
        $transactionName = $request[TransactionFields::TRANSACTION_TYPE];

        $response = $this->transactionService->execute($transactionName, $request);

        try {
            $this->validationService->validate($request, $response);
        } catch (\Exception $exception) {
            throw new ValidationException($exception->getMessage(), $exception->getCode());
        }
        return $response;
    }
}
