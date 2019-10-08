<?php

namespace Omnipay\Pay360\Test\Gateway;

use Omnipay\Pay360\Gateway;
use Omnipay\Tests\GatewayTestCase;

class Pay360Test extends GatewayTestCase
{
    /**
     * @var \Omnipay\Pay360\Gateway
     */
    protected $gateway;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var array
     */
    protected $cardData = null;

    /**
     * Setup
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->gateway = new Gateway(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );
    }
}
