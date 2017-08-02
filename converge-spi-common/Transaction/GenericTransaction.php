<?php
/**
 * Copyright, Pronko Consulting
 * See LICENSE for license details.
 */

namespace Pronko\ConvergePaymentSpiCommon\Transaction;

use Pronko\ConvergePaymentSpi\Transaction;
use Pronko\ConvergePaymentSpi\HttpClient;

/**
 * Class GenericTransaction.
 * @private
 */
class GenericTransaction implements Transaction
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * GenericTransaction constructor.
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function execute(array $request)
    {
        return $this->client->placeRequest($request);
    }
}
