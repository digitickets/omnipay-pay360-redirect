<?php

namespace Omnipay\Pay360\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\RequestInterface;

/**
 * DataCash Response
 */
class RedirectPurchaseResponse extends AbstractPurchaseResponse
{

    const RESULT_SUCCESS = 'SUCCESS';

    /**
     * RedirectPurchaseResponse constructor.
     *
     * @param RequestInterface $request
     * @param array            $jsonData
     *
     * @throws InvalidResponseException
     */
    public function __construct(
        RequestInterface $request,
        array $jsonData
    ) {
        $this->request = $request;
        $this->data = $jsonData;
        if (!isset($this->data['status'])) {
            throw new InvalidResponseException;
        }
    }

    /**
     * Returns true if the response from the gateway is successful
     *
     * @return bool
     */
    public function isRedirect(): bool
    {
        return isset($this->data['status'])
            && static::RESULT_SUCCESS === $this->data['status'];
    }

    /**
     * @return string|null
     */
    public function getTransactionReference(): string
    {
        return $this->data['sessionId'];
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->data->merchantreference;
    }

    /**
     * @return string|null
     */
    public function getMessage(): string
    {
        return $this->data['reasonMessage'];
    }

    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->data['redirectUrl'];
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @return array
     */
    public function getRedirectData()
    {
        return $this->data;
    }
}