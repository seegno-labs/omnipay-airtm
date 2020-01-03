<?php

namespace Omnipay\AirTM\Message;


/**
 * Create payout request.
 */

class CreatePayoutRequest extends AbstractRequest
{

  /**
   * Get data.
   */

  public function getData()
  {
    $this->validate(
      'amount',
      'confirmationUrl',
      'description',
      'email',
      'failureUrl'
    );

    $data = parent::getData();

    $data['email'] = $this->getEmail();
    $data['failure_uri'] = $this->getFailureUrl();
    $data['confirmation_uri'] = $this->getConfirmationUrl();

    return $data;
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
   * Get failure url.
   */

  public function getFailureUrl()
  {
    return $this->getParameter('failureUrl');
  }

  /**
   * Set failure url.
   */

  public function setFailureUrl($failureUrl)
  {
    return $this->setParameter('failureUrl', $failureUrl);
  }

  /**
   * Get email.
   */

  public function getEmail()
  {
    return $this->getParameter('email');
  }

  /**
   * Set email.
   */

  public function setEmail($email)
  {
    return $this->setParameter('email', $email);
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
      return $this->getTestMode() ? "$this->testEndpoint/payouts" : "$this->liveEndpoint/payouts";
  }

}
