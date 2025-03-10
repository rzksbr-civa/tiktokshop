<?php
/*
 * This file is part of tiktokshop-client.
 *
 * Copyright (c) 2023 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webaune\TiktokShop\Resources;

use GuzzleHttp\RequestOptions;
use Webaune\TiktokShop\Resource;

class ReturnRefund extends Resource
{
    protected $category = 'return_refund';

    public function searchCancellations($params = [])
    {
        return $this->call('POST', 'cancellations/search', [
            RequestOptions::JSON => $params,
        ]);
    }

    public function approveCancellation($cancel_id)
    {
        return $this->call('POST', 'cancellations/'.$cancel_id.'/approve', [
            RequestOptions::QUERY => [
                'idempotency_key' => $this->generateIdempotencyKey(),
            ],
        ]);
    }

    public function rejectCancellation($cancel_id, $params)
    {
        return $this->call('POST', 'cancellations/'.$cancel_id.'/reject', [
            RequestOptions::QUERY => [
                'idempotency_key' => $this->generateIdempotencyKey(),
            ],
            RequestOptions::JSON => $params,
        ]);
    }

    public function searchReturns($params = [])
    {
        return $this->call('POST', 'returns/search', [
            RequestOptions::JSON => $params,
        ]);
    }

    public function approveReturn($return_id, $params)
    {
        return $this->call('POST', 'returns/'.$return_id.'/approve', [
            RequestOptions::QUERY => [
                'idempotency_key' => $this->generateIdempotencyKey(),
            ],
            RequestOptions::JSON => $params,
        ]);
    }

    public function rejectReturn($return_id, $params)
    {
        return $this->call('POST', 'returns/'.$return_id.'/reject', [
            RequestOptions::QUERY => [
                'idempotency_key' => $this->generateIdempotencyKey(),
            ],
            RequestOptions::JSON => $params,
        ]);
    }

    public function getAftersaleEligibility($order_id)
    {
        return $this->call('GET', 'orders/'.$order_id.'/aftersale_eligibility');
    }

    public function getRejectReasons()
    {
        return $this->call('GET', 'reject_reasons');
    }

    public function calculateRefund($params)
    {
        return $this->call('POST', 'refunds/calculate', [
            RequestOptions::JSON => $params,
        ]);
    }

    public function getReturnRecords($return_id)
    {
        return $this->call('GET', 'returns/'.$return_id.'/records');
    }

    public function cancelOrder($params)
    {
        return $this->call('POST', 'cancellations', [
            RequestOptions::JSON => $params,
        ]);
    }

    public function createReturn($params)
    {
        return $this->call('POST', 'returns', [
            RequestOptions::QUERY => [
                'idempotency_key' => $this->generateIdempotencyKey(),
            ],
            RequestOptions::JSON => $params,
        ]);
    }

    /**
     * The idempotency key is a unique value generated by the client which the server uses to recognize the same request.
     * How you create unique keys is up to you, but we suggest using UUIDs, or another random string with enough entropy to avoid collisions.
     * Idempotency keys can be up to 255 characters long.
     */
    private function generateIdempotencyKey()
    {
        return uniqid('', true);
    }
}
