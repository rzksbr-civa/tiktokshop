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

use Webaune\TiktokShop\Resource;

class Seller extends Resource
{
    protected $category = 'seller';

    public function getActiveShopList()
    {
        return $this->call('GET', 'shops');
    }

    public function getSellerPermissions()
    {
        return $this->call('GET', 'permissions');
    }
}
