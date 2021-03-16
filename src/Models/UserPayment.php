<?php


namespace Kl\Models;

/**
 * Class UserPayment
 * @package Kl
 *
 * @method toArray($fieldsFormat = null)
 */
class UserPayment extends Model
{
    /**
     * @var integer|null
     */
    public $id;

    /**
     * @var integer
     */
    public $userId;

    /**
     * @var string
     */
    public $type;

    /**
     * @var float
     */
    public $balanceBefore;

    /**
     * @var float
     */
    public $amount;

    /**
     * UserPayment constructor.
     * @param $userId
     * @param $type
     * @param $balanceBefore
     * @param $amount
     * @param null $id
     */
    public function __construct($userId, $type, $balanceBefore, $amount, $id = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->type = $type;
        $this->balanceBefore = $balanceBefore;
        $this->amount = $amount;
    }
}