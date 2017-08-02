<?php
/**
 * Copyright, Pronko Consulting
 * See LICENSE for license details.
 */

namespace Pronko\ConvergePaymentSpi;

/**
 * Interface Transaction.
 * @api
 */
interface Transaction
{
    /**
     * Execute transaction.
     *
     * @param array $request
     * @return array
     */
    public function execute(array $request);
}
