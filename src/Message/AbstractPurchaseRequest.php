<?php

namespace Omnipay\Pay360\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Pay360\Traits\GatewayParamsTrait;
use function sprintf;

abstract class AbstractPurchaseRequest extends AbstractRequest
{
    use GatewayParamsTrait;

    /**
     * @var string
     */
    protected $liveEndpoint = 'https://api.pay360.com';
    /**
     * @var string
     */
    protected $testEndpoint = 'https://api.mite.pay360.com';

    /**
     * String with placeholders for the resource endpoint of the particular
     * request
     *
     * @var string
     */
    protected $apiResourceString = '';

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     * @return array
     */
    protected function getHeaders(): array
    {
        return [
            'Authorization' => 'Basic ' . base64_encode(
                    sprintf('%s:%s', $this->getApiUsername(),
                        $this->getApiPassword())),
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * @param array $data
     *
     * @return \Guzzle\Http\Message\Response
     */
    public function sendData($data)
    {
        if ($this->getTestMode()) {
            //disable ssl verification if in test mode
            $this->httpClient->setConfig(['verify' => false]);
        }

        $jsonData = json_encode($data);

        $httpResponse = $this->httpClient->post(
            $this->getEndpoint(),
            $this->getHeaders(),
            $jsonData
        )->send();

        return $httpResponse;
    }
}
