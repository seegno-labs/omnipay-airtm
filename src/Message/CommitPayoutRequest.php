<?php

namespace Omnipay\AirTM\Message;


/**
 * Commit payout request.
 */

class CommitPayoutRequest extends AbstractRequest
{

  /**
   * Get data.
   */

  public function getData()
  {
    $this->validate('payoutId');

    $data['id'] = $this->getPayoutId();

    return $data;
  }

  /**
   * Get payout id.
   */

  public function getPayoutId()
  {
    return $this->getParameter('payoutId');
  }

  /**
   * Set payout id.
   */

  public function setPayoutId($payoutId)
  {
    return $this->setParameter('payoutId', $payoutId);
  }

  /**
   * Get http method.
   */

  protected function getHttpMethod()
  {
    return 'POST';
  }

  /**
   * Get endpoint.
   */

  protected function getEndpoint()
  {
    $baseUrl = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;

    return sprintf("%s/payouts/%s/commit", $baseUrl, $this->getPayoutId());
  }

}
