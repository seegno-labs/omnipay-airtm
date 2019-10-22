<?php


namespace Omnipay\AirTM\Message;


class GetRequest extends AbstractRequest
{

  /**
   * Get data.
   */

  public function getData()
  {
    $this->validate('id');

    $data = parent::getData();

    return $data;
  }

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
   * Get endpoint.
   */

  protected function getEndpoint()
  {
    $id = $this->getId();
    $host =$this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;

    return "$host/operations/$id";
  }

}
