<?php


namespace Kl\Models;

/**
 * Class User
 * @package Kl
 *
 * @method toArray($fieldsFormat = null)
 */
class User extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var float
     */
    public $balance;

    /**
     * @var string
     */
    public $email;

    /**
     * User constructor.
     * @param $id integer
     * @param $balance float
     * @param $email string
     */
    public function __construct(int $id, float $balance, string $email)
    {
        $this->id = $id;
        $this->balance = $balance;
        $this->email = $email;
    }
}
