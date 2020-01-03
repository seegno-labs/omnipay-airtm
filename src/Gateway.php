<?php

namespace Omnipay\AirTM;

use Omnipay\Common\AbstractGateway;

/**
 * Gateway.
 */

class Gateway extends AbstractGateway
{

  /**
   * Get name.
   */

  public function getName()
  {
    return 'AirTM';
  }

  /**
   * Get default parameters.
   */

  public function getDefaultParameters()
  {
    return [
      'partnerId' => '',
      'partnerSecret' => '',
      'testMode' => false
    ];
  }

  /**
   * Get partner id.
   */

  public function getPartnerId()
  {
    return $this->getParameter('partnerId');
  }

  /**
   * Set partner id.
   */

  public function setPartnerId(string $partnerId)
  {
    return $this->setParameter('partnerId', $partnerId);
  }

  /**
   * Get partner secret.
   */

  public function getPartnerSecret()
  {
    return $this->getParameter('partnerSecret');
  }

  /**
   * Set partner secret.
   */

  public function setPartnerSecret(string $partnerSecret)
  {
    return $this->setParameter('partnerSecret', $partnerSecret);
  }

  /**
   * Purchase.
   */

  public function purchase(array $parameters = array())
  {
    return $this->createRequest('\Omnipay\AirTM\Message\PurchaseRequest', $parameters);
  }

  /**
   * Payout.
   */

  public function payout(array $parameters = array())
  {
    return $this->createRequest('\Omnipay\AirTM\Message\CreatePayoutRequest', $parameters);
  }

  /**
   * Commit Payout.
   */

  public function commitPayout(array $parameters = array())
  {
    return $this->createRequest('\Omnipay\AirTM\Message\CommitPayoutRequest', $parameters);
  }

  /**
   * Get.
   */

  public function get(array $parameters = array())
  {
    return $this->createRequest('\Omnipay\AirTM\Message\GetRequest', $parameters);
  }
}
