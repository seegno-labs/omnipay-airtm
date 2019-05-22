<?php


namespace Omnipay\AirTM\Message;


class GetRequest extends AbstractRequest
{

  /**
   * Get id.
   */

  public function getId()
  {
    return $this->getParameter('id');
  }

  /**
   * Set id.
   */

  public function setId($id)
  {
    return $this->setParameter('id', $id);
  }

  /**
   * Get http method.
   */

  protected function getHttpMethod()
  {
    return 'GET';
  }
  
  /**
   * Create response.
   */

  protected function createResponse($data)
  {
    return $this->response = new GetResponse($this, $data);
  }

  /**
   * Get endpoint.
   */

  protected function getEndpoint()
  {
    $id = $this->getId();

    return $this->getTestMode() ? "$this->testEndpoint/purchases/$id" : "$this->liveEndpoint/purchases/$id";
  }

}