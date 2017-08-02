<?php
/**
 * Copyright, Pronko Consulting
 * See LICENSE for license details.
 */

namespace Pronko\ConvergePaymentApi;

/**
 * Interface Transaction.
 */
interface Transaction
{
    /**
     * @param array $request
     * @return mixed
     */
    public function execute(array $request);
}
