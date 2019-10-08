<?php

namespace Omnipay\Pay360\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class CompleteRedirectPurchaseResponse extends AbstractResponse
{
    /**
     *
     */
    const RESULT_SUCCESS = 'SUCCESS';

    /**
     * @param RequestInterface $request
     * @param array            $data
     */
    public function __construct(RequestInterface $request, array $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    /**
     *
     * @return bool
     */
    public function isRedirect(): bool
    {
        return false;
    }

    /**
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return isset($this->data['hostedSessionStatus']['transactionState']['transactionState'])
            && static::RESULT_SUCCESS === $this->data['hostedSessionStatus']['transactionState']['transactionState'];
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return isset($this->data['hostedSessionStatus']['transactionState']['transactionState']) ?
            $this->data['hostedSessionStatus']['transactionState']['transactionState'] : null;
    }

    /**
     * @return string
     */
    public function getTransactionReference(): string
    {
        return isset($this->data['hostedSessionStatus']['transactionState']['id']) ?
            $this->data['hostedSessionStatus']['transactionState']['id'] : null;
    }
}
