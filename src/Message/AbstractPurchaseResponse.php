<?php

namespace Omnipay\Pay360\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

abstract class AbstractPurchaseResponse extends AbstractResponse implements
    RedirectResponseInterface
{
    /**
     * Returns true if the transaction is successful and complete.
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return false;
    }
}
