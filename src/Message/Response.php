<?php

namespace Omnipay\AirTM\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Response.
 */

class Response extends AbstractResponse
{
  /**
   * Http status code.
   */

  protected $httpStatusCode;

  /**
   * Response constructor.
   */

  public function __construct(RequestInterface $request, $data, $httpStatusCode)
  {
    parent::__construct($request, $data);

    $this->httpStatusCode = $httpStatusCode;
  }

  /**
   * Get http status code.
   */

  public function getHttpStatusCode()
  {
      return $this->httpStatusCode;
  }

  /**
   * Get transaction reference.
   */

  public function getTransactionReference()
  {
      return $this->data['id'] ?? null;
  }

  /**
   * Get message.
   */

  public function getMessage()
  {
      return $this->data['message'] ?? null;
  }

  /**
   * Get messages.
   */

  public function getMessages()
  {
      return $this->data['messages'] ?? [];
  }

  /**
   * Is successful.
   */

  public function isSuccessful()
  {
      return isset($this->data['id']) && $this->getHttpStatusCode() < 400;
  }
}
