<?php

namespace Omnipay\AirTM;

use Omnipay\Common\Item;

/**
 * Class PurchaseItem
 */

class PurchaseItem extends Item
{

  /**
   * Get amount.
   */

    public function getAmount()
    {
      return $this->getParameter('amount');
    }

    /**
     * Set amount.
     */

    public function setAmount($amount)
    {
      return $this->setParameter('amount', $amount);
    }

    /**
     * Get description.
     */

    public function getDescription()
    {
      return $this->getParameter('description');
    }

    /**
     * Set description.
     */

    public function setDescription($description)
    {
      return $this->setParameter('description', $description);
    }

    /**
     * Get quantity.
     */

    public function getQuantity()
    {
      return $this->getParameter('quantity');
    }

    /**
     * Set quantity.
     */

    public function setQuantity($quantity)
    {
      return $this->setParameter('quantity', $quantity);
    }
}
