<?php

namespace Omnipay\AirTM\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * AirTM purchase response.
 */

class PurchaseResponse extends Response implements RedirectResponseInterface
{
    /**
     * Live endpoint.
     */

    protected $liveCheckoutEndpoint = 'https://purchases.airtm.io/checkout/%s';

    /**
     * Test endpoint.
     */

    protected $testCheckoutEndpoint = 'https://purchases.staging.airtm.org/checkout/%s';


  /**
   * Is successful.
   */

  public function isSuccessful()
  {
    $success = isset($this->data['id']) && isset($this->data['status']) && in_array($this->data['status'], array('created'));

    return $success;
  }

    /**
     * Get redirect url.
     */

    public function getRedirectUrl()
    {
        return $this->getCheckoutEndpoint();
    }

    /**
     * Get transaction reference.
     */

    public function getTransactionReference()
    {
        return isset($this->data['id']) ? $this->data['id'] : null;
    }

    /**
     * Get redirect method.
     */

    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * Get message.
     */

    public function getMessage()
    {
        $data = parent::getMessage();
        $data['checkout_uri'] = $this->getCheckoutEndpoint();

        return $data;
    }

    /**
     * Get checkout endpoint.
     */

    protected function getCheckoutEndpoint()
    {
        $endpoint = $this->getRequest()->getTestMode() ? $this->testCheckoutEndpoint : $this->liveCheckoutEndpoint;

        return sprintf($endpoint, $this->getTransactionReference());
    }

}
