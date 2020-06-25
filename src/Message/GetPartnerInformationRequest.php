<?php


namespace Omnipay\AirTM\Message;


class GetPartnerInformationRequest extends AbstractRequest
{

  /**
   * Get endpoint.
   */

  protected function getEndpoint()
  {
    return parent::getEndpoint() . '/partners/me';
  }

}
