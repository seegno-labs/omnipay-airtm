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

    return parent::getData();
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
   * Get endpoint.
   */

  protected function getEndpoint()
  {
    $id = $this->getId();

    return parent::getEndpoint() . "/operations/$id";
  }

}
