<?php

namespace Omnipay\AirTM\Message;

use Omnipay\AirTM\PurchaseItemBag;
use Omnipay\Common\ItemBag;

/**
 * Purchase request.
 */

class PurchaseRequest extends AbstractRequest
{
  /**
   * Get data.
   */

  public function getData()
  {
    $this->validate(
      'amount',
      'cancelUrl',
      'code',
      'description',
      'items'
    );

    $data = parent::getData();

    $data['cancel_uri'] = $this->getCancelUrl();
    $data['code'] = $this->getCode();
    $data['items'] = $this->getItemData();
    $data['confirmation_uri'] = $this->getConfirmationUrl();

    return $data;
  }

  /**
   * Get code.
   */

  public function getCode()
  {
    return $this->getParameter('code');
  }

  /**
   * Set code.
   */

  public function setCode($code)
  {
    return $this->setParameter('code', $code);
  }

  /**
   * Get confirmation url.
   */

  public function getConfirmationUrl()
  {
    return $this->getParameter('confirmationUrl');
  }

  /**
   * Set confirmation url.
   */

  public function setConfirmationUrl($confirmationUrl)
  {
    return $this->setParameter('confirmationUrl', $confirmationUrl);
  }

  /**
   * Set items.
   */

  public function setItems($items)
  {
    if ($items && !$items instanceof ItemBag) {
      $items = new PurchaseItemBag($items);
    }

    return $this->setParameter('items', $items);
  }

  /**
   * Get items.
   */

  public function  getItems()
  {
    return $this->getParameter('items');
  }

  /**
   * Create response.
   */

  protected function createResponse($data, $httpStatusCode)
  {
    return $this->response = new PurchaseResponse($this, $data, $httpStatusCode);
  }

  /**
   * Get http method.
   */

  protected function getHttpMethod()
  {
    return 'POST';
  }

  /**
   * Get item data.
   */

  protected function getItemData()
  {
      $data = array();
      $items = $this->getItems();

      if ($items) {
        foreach ($items as $item) {
            $itemData = array();
            $itemData['description'] = $item->getDescription();
            $itemData['amount'] = $item->getAmount();
            $itemData['quantity'] = $item->getQuantity();

            array_push($data, $itemData);
        }
      }

      return $data;
  }

  /**
   * Get endpoint.
   */

  protected function getEndpoint()
  {
      return $this->getTestMode() ? "$this->testEndpoint/purchases" : "$this->liveEndpoint/purchases";
  }

}
