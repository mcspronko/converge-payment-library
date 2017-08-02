<?php
/**
 * Copyright, Pronko Consulting
 * See LICENSE for license details.
 */

namespace Pronko\ConvergePaymentSpiCommon;

use Pronko\ConvergePaymentSpi;

/**
 * Interface TransactionService.
 * @private
 */
class TransactionService implements ConvergePaymentSpi\TransactionService
{
    /**
     * @var ConvergePaymentSpi\Transaction[]
     */
    private $transactions;

    /**
     * TransactionService constructor.
     *
     * @param ConvergePaymentSpi\Transaction[] $transactions
     */
    public function __construct(array $transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * @inheritDoc
     */
    public function execute($transactionName, array $request)
    {
        $transaction = isset($this->transactions[$transactionName]) ? $this->transactions[$transactionName] : null;
        if ($transaction instanceof ConvergePaymentSpi\Transaction) {
            return $transaction->execute($request);
        } else {
            throw new \InvalidArgumentException("Wrong Transaction Type specified: '{$transactionName}'");
        }
    }
}
