<?php


namespace Kl\DbTables;

/**
 * Class UserPaymentDbTable
 * @package Kl\DbTables
 */
class UserPaymentDbTable
{
    /**
     * @var array
     */
    private $storage = [];

    /**
     * @param $paymentData
     * @return bool
     */
    public function add($paymentData)
    {
        if (empty($paymentData['id'])) {
            $paymentData['id'] = count($this->storage) + 1;
        }

        $this->storage[] = $paymentData;

        return true;
    }
}
