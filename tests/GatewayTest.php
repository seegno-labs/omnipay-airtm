<?php

namespace Omnipay\AirTM;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
  /**
   * Gateway.
   */

  public $gateway;

  /**
   * Options.
   */

  public $options;

  /**
   * SetUp.
   */

  public function setUp()
  {
    parent::setUp();

    $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    $this->options = array(
      'amount' => '10.00',
      'description' => 'foobar',
      'code' => 'waldo',
      'cancelUrl' => 'fred',
      'confirmationUrl' => 'biz',
      'items' => [
          [
          'description' => 'foobar',
          'amount' => '10.00',
          'quantity' => '1'
          ]
      ]
    );
  }

  public function testPurchaseSuccess()
  {
    $this->setMockHttpResponse('PurchaseSuccess.txt');

    $response = $this->gateway->purchase($this->options)->send();

    $this->assertTrue($response->isSuccessful());
    $this->assertEquals('a3f5ba6e-9eb1-43d2-abbf-565d7a88aac4', $response->getTransactionReference());
    $this->assertEquals([
      'operation_type' => 'purchase',
      'amount' => '1.00',
      'created_at' => '2018-10-24T16:24:17.000Z',
      'code' => 'foo',
      'airtm_operation_id' => null,
      'airtm_user_email' => null,
      'status' => 'created',
      'airtm_user_id' => null,
      'confirmation_uri' => 'https://foo.com/bar',
      'description' => 'Test',
      'cancel_uri' => 'https://foo.com/bar',
      'updated_at' => '2018-10-24T16:24:17.000Z',
      'id' => 'a3f5ba6e-9eb1-43d2-abbf-565d7a88aac4'
    ], $response->getData());

    $this->assertEquals(['checkout_uri' => 'https://payments.static-stg.tests.airtm.org/checkout/a3f5ba6e-9eb1-43d2-abbf-565d7a88aac4'], $response->getMessage());
    $this->assertEquals([], $response->getMessages());
  }

  public function testPurchaseFail()
  {
    $this->setMockHttpResponse('PurchaseFail.txt');

    $response = $this->gateway->purchase($this->options)->send();

    $this->assertFalse($response->isSuccessful());
        $this->assertEquals([
      'amount' => ['amount is a required field'],
      'confirmation_uri' => ['confirmation_uri is a required field'],
      'cancel_uri' => ['cancel_uri is a required field'],
      'items' => ['items is a required field'],
      'code' => ['code is a required field']
    ], $response->getMessages());

    $this->assertEquals([
      'message' => 'Unprocessable entity',
      'messages' => [
        'amount' => ['amount is a required field'],
        'confirmation_uri' => ['confirmation_uri is a required field'],
        'cancel_uri' => ['cancel_uri is a required field'],
        'items' => ['items is a required field'],
        'code' => ['code is a required field']
      ]
    ], $response->getData());
    
    $this->assertNull($response->getTransactionReference());
  }

  public function testGetPartnerInformationSuccess()
  {
    $this->setMockHttpResponse('GetPartnerInformationSuccess.txt');

    $response = $this->gateway->getPartnerInformation()->send();

    $this->assertTrue($response->isSuccessful());
    $this->assertEquals([], $response->getMessages());
    $this->assertNull($response->getMessage());
    $this->assertEquals([
      'balance' => 20,
      'id' => 'foobar',
      'currency' => 'USD',
      'email' => 'fred@waldo.com',
      'name' => 'plugh'
    ], $response->getData());
    $this->assertEquals('foobar', $response->getTransactionReference());
  }

  public function testGetPartnerInformationFail()
  {
    $this->setMockHttpResponse('GetPartnerInformationFail.txt');

    $response = $this->gateway->getPartnerInformation()->send();

    $this->assertFalse($response->isSuccessful());
    $this->assertEquals([], $response->getMessages());
    $this->assertEquals('Invalid credentials', $response->getMessage());
    $this->assertEquals(['message' => 'Invalid credentials'], $response->getData());
    $this->assertNull($response->getTransactionReference());
  }
}
