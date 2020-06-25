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
      'testMode' => true
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
   * Get partner information.
   */

  public function getPartnerInformation(array $parameters = array())
  {
    return $this->createRequest('\Omnipay\AirTM\Message\GetPartnerInformationRequest', $parameters);
  }

  /**
   * Purchase.
   */

  public function purchase(array $parameters = array())
  {
    return $this->createRequest('\Omnipay\AirTM\Message\PurchaseRequest', $parameters);
  }

  /**
   * Get.
   */

  public function get(array $parameters = array())
  {
    return $this->createRequest('\Omnipay\AirTM\Message\GetRequest', $parameters);
  }
}
