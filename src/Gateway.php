<?php

namespace Omnipay\Pay360;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Pay360\Message\CompleteRedirectPurchaseRequest;
use Omnipay\Pay360\Message\RedirectPurchaseRequest;
use Omnipay\Pay360\Traits\GatewayParamsTrait;

/**
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options =[])
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array$options = [])
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options =[])
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options =[])
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options =[])
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options =[])
 */
class Gateway extends AbstractGateway
{
    use GatewayParamsTrait;
    /**
     * Get gateway name
     *
     * @return string
     */
    public function getName() : string
    {
        return 'Pay360';
    }

    /**
     * Get gateway default parameters
     *
     * @return array
     */
    public function getDefaultParameters() : array
    {
        return [
            'installationId' => '',
            'apiUsername' => '',
            'apiPassword' => '',
            'testMode' => true,
        ];
    }

    /**
     * completePuchase function to be called on provider's callback
     *
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function completePurchase(array $options = []): RequestInterface
    {
        $options = array_merge($this->getParameters(), $options);

        return $this->createRequest(
            CompleteRedirectPurchaseRequest::class,
            $options
        );
    }

    /**
     * puchase function to be called to initiate a purchase
     *
     * @param  array $parameters
     * @return RequestInterface
     */
    public function purchase(array $options = []): RequestInterface
    {
        $options = array_merge($this->getParameters(), $options);

        return $this->createRequest(
            RedirectPurchaseRequest::class,
            $options
        );
    }
}
