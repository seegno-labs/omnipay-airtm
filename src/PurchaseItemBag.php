<?php

namespace Omnipay\AirTM;

use Omnipay\Common\ItemBag;
use Omnipay\Common\ItemInterface;

/**
 * Class PurchaseItemBag
 */

class PurchaseItemBag extends ItemBag
{

    /**
     * Add an item to the bag
     */

    public function add($item)
    {
        if ($item instanceof ItemInterface) {
            $this->items[] = $item;
        } else {
            $this->items[] = new PurchaseItem($item);
        }
    }
}
