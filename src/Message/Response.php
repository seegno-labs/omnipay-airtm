<?php

namespace Omnipay\AirTM\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Response.
 */

class Response extends AbstractResponse
{

  /**
   * Get message.
   */

  public function getMessage()
  {
      return $this->data;
  }

  /**
   * Is successful.
   */

  public function isSuccessful()
  {
    return isset($this->data['id']);
  }
}
