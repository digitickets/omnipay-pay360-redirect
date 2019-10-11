<?php

namespace Omnipay\Pay360\Message;

use Omnipay\Common\CreditCard;
use function sprintf;

/**
 * DataCash Purchase Request
 */
class RedirectPurchaseRequest extends AbstractPurchaseRequest
{
    /**
     *The resource string this request will consume
     */
    protected $apiResourceString = '%s/hosted/rest/sessions/%s/payments';

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount', 'card');

        $card = $this->getCard();

        $data = [
            'session' => $this->getSessionData(),
            'transaction' => $this->getTransactionData(),
            'customer' => $this->getCustomerData($card),
        ];

        return $data;
    }

    /**
     * @param \Omnipay\Common\CreditCard $card
     *
     * @return array
     */
    protected function getCustomerData(CreditCard $card): array
    {
        $data = [
            'registered' => false,
            'details' => [
                'name' => $card->getName(),
                'address' => [
                    'line1' => $card->getBillingAddress1(),
                    'line2' => $card->getBillingAddress2(),
                    'city' => $card->getBillingCity(),
                    'region' => $card->getBillingState(),
                    'postcode' => $card->getBillingPostcode(),
                    'countryCode' => $card->getBillingCountry(),
                ],
                'telephone' => $card->getBillingPhone(),
                'emailAddress' => $card->getEmail(),
            ],
        ];

        return $data;
    }

    /**
     * @return array
     */
    protected function getTransactionData(): array
    {
        $data = [
            'merchantReference' => $this->getTransactionId(),
            'money' => [
                'currency' => $this->getCurrency(),
                'amount' => [
                    'fixed' => $this->getAmountInteger(),
                ],
            ],
        ];

        return $data;
    }

    /**
     * @return array
     */
    protected function getSessionData(): array
    {
        $data = [
            'returnUrl' => [
                'url' => $this->getReturnUrl(),
            ],
        ];

        return $data;
    }

    /**
     * @param array $data
     *
     * @return \Omnipay\Pay360\Message\RedirectPurchaseResponse
     */
    public function sendData($data): RedirectPurchaseResponse
    {
        $httpResponse = parent::sendData($data);

        return $this->response = new RedirectPurchaseResponse(
            $this,
            $httpResponse->json()
        );
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        $endpoint = sprintf(
            $this->apiResourceString,
            parent::getEndpoint(),
            $this->getInstallationId()
        );

        return $endpoint;
    }
}