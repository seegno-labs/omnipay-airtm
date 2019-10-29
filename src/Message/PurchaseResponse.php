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

    protected $liveCheckoutEndpoint = 'https://payments.air-pay.io/checkout/%s';

    /**
     * Test endpoint.
     */

    protected $testCheckoutEndpoint = 'https://payments.static-stg.tests.airtm.org/checkout/%s';

    /**
     * Get redirect url.
     */

    public function getRedirectUrl()
    {
        return $this->getCheckoutEndpoint();
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
