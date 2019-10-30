<?php

namespace Omnipay\AirTM\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * Abstract request.
 */

class AbstractRequest extends BaseAbstractRequest
{
  /**
   * Live endpoint.
   */

  protected $liveEndpoint = 'https://payments.air-pay.io';

  /**
   * Test endpoint.
   */

  protected $testEndpoint = 'https://payments.static-stg.tests.airtm.org';

  /**
   * Get data.
   */

  public function getData()
  {
    return [
      'amount' => $this->getAmount(),
      'description' => $this->getDescription()
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
   * Get authorization.
   */

  public function getAuthorization()
  {
    $partnerId = $this->getPartnerId();
    $partnerSecret = $this->getPartnerSecret();

    return base64_encode("$partnerId:$partnerSecret");
  }

  /**
   * Send data.
   */

  public function sendData($data)
  {
    try {
      $authorizationToken = $this->getAuthorization();
      $headers = [
        'Content-Type' => 'application/json',
        'Authorization' => "Basic $authorizationToken"
      ];

      $body = $this->getHttpMethod() === 'GET' ? null : json_encode($data);
      $httpResponse = $this->httpClient->request(
        $this->getHttpMethod(),
        $this->getEndpoint(),
        $headers,
        $body
      );

      $body = (string) $httpResponse->getBody()->getContents();
      $jsonToArrayResponse = !empty($body) ? json_decode($body, true) : array();

      return $this->createResponse($jsonToArrayResponse, $httpResponse->getStatusCode());
    } catch(\Exception $e) {
      throw new InvalidResponseException(
        'Error communicating with payment gateway: ' . $e->getMessage(),
        $e->getCode()
      );
    }
  }

  /**
   * Create response.
   */

  protected function createResponse($data, $httpStatusCode)
  {
    return $this->response = new Response($this, $data, $httpStatusCode);
  }

}
