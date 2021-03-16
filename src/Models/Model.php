<?php


namespace Kl\Models;


use Kl\Traits\StringFormatter;

/**
 * Class Model
 * @package Kl\Models
 */
class Model
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return (array)$this;
    }
}