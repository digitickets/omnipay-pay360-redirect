<?php

namespace Omnipay\Pay360\Message;

class CompleteRedirectPurchaseRequest extends AbstractPurchaseRequest
{
    protected $apiResourceString = '%s/hosted/rest/sessions/%s/%s/status';

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->httpRequest->query->all();
    }

    /**
     * @param mixed $data
     *
     * @return \Omnipay\Pay360\Message\CompleteRedirectPurchaseResponse
     */
    public function sendData($data): CompleteRedirectPurchaseResponse
    {
        if ($this->getTestMode()) {
            //disable ssl verification if in test mode
            $this->httpClient->setConfig(['verify' => false]);
        }

        $jsonData = json_encode($data);

        $httpResponse = $this->httpClient->get(
            $this->getEndpoint(),
            $this->getHeaders()
            // , $jsonData
        )->send();

        return $this->response = new CompleteRedirectPurchaseResponse(
            $this,
            $httpResponse->json()
        );
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        $endpoint = sprintf($this->apiResourceString, parent::getEndpoint(),
            $this->getInstallationId(),
            $this->httpRequest->query->get('sessionId')
        );

        return $endpoint;
    }

}
