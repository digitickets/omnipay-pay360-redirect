<?php

namespace Omnipay\Pay360\Traits;

/**
 * Parameters that can be set at the gateway class, and so
 * must also be available at the request message class.
 */
trait GatewayParamsTrait
{

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setInstallationId($value)
    {
        return $this->setParameter('installationId', $value);
    }

    /**
     * @return mixed
     */
    public function getInstallationId()
    {
        return $this->getParameter('installationId');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setApiUsername($value)
    {
        return $this->setParameter('apiUsername', $value);
    }

    /**
     * @return mixed
     */
    public function getApiUsername()
    {
        return $this->getParameter('apiUsername');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setApiPassword($value)
    {
        return $this->setParameter('apiPassword', $value);
    }

    /**
     * @return mixed
     */
    public function getApiPassword()
    {
        return $this->getParameter('apiPassword');
    }

}
