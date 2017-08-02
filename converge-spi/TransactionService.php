<?php
/**
 * Copyright, Pronko Consulting
 * See LICENSE for license details.
 */

namespace Pronko\ConvergePaymentSpi;

/**
 * Interface TransactionService.
 * @api
 */
interface TransactionService
{
    /**
     * @param string $transactionName
     * @param array $request
     * @return array
     * @throws \InvalidArgumentException
     */
    public function execute($transactionName, array $request);
}
