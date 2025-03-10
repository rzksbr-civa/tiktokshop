<?php
/*
 * This file is part of tiktok-shop.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webaune\TiktokShop\Resources;

use GuzzleHttp\RequestOptions;
use Webaune\TiktokShop\Resource;

class Order extends Resource
{
    // order status
    public const STATUS_UNPAID = 'UNPAID';
    public const STATUS_AWAITING_SHIPMENT = 'AWAITING_SHIPMENT';
    public const STATUS_AWAITING_COLLECTION = 'AWAITING_COLLECTION';
    public const STATUS_PARTIALLY_SHIPPING = 'PARTIALLY_SHIPPING';
    public const STATUS_IN_TRANSIT = 'IN_TRANSIT';
    public const STATUS_DELIVERED = 'DELIVERED';
    public const STATUS_COMPLETED = 'COMPLETED';
    public const STATUS_CANCELLED = 'CANCELLED';

    protected $category = 'order';

    public function getOrderDetail($ids = [])
    {
        return $this->call('GET', 'orders', [
            RequestOptions::QUERY => [
                'ids' => static::dataTypeCast('array', $ids),
            ]
        ]);
    }

    public function getOrderList($query = [], $body = null)
    {
        if ($body === null) {
            static::extractParams($query, $query, $body);
        }

        return $this->call('POST', 'orders/search', [
            RequestOptions::QUERY => $query,
            is_array($body) ? RequestOptions::JSON : RequestOptions::FORM_PARAMS => $body,
        ]);
    }
}
