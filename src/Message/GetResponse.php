<?php


namespace Omnipay\AirTM\Message;


class GetResponse extends Response {

  /**
   * Get transaction reference.
   */

  public function getTransactionReference()
  {
      return $this->data['id'];
  }
}
