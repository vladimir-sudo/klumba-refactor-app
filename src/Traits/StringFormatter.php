<?php


namespace Kl\Traits;

/**
 * Trait StringFormatter
 * @package Kl\Traits
 */
trait StringFormatter
{
    public function format(string $string): string
    {
        $formatString = preg_replace('/[^a-z0-9]+/i', ' ', $string);
        $formatString = trim($formatString);
        $formatString = ucwords($formatString);

        return str_replace(' ', '', $formatString);
    }
}