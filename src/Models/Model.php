<?php


namespace Kl\Models;


use Kl\Traits\StringFormatter;

/**
 * Class Model
 * @package Kl\Models
 */
class Model
{
    use StringFormatter;

    const FIELDS_TYPE_CAMEL_CASE = 'camelCase';

    const FIELDS_TYPE_LOWER_CASE = 'lowerCase';

    /**
     * @param string $fieldsFormat
     * @return array
     */
    public function toArray($fieldsFormat = null): array
    {
        $result = [];

        foreach ((array)$this as $key => $value)
        {
            $keyFormatted = $this->format($key);

            switch ($fieldsFormat) {
                case $fieldsFormat === self::FIELDS_TYPE_CAMEL_CASE:
                    $keyFormatted = lcfirst($keyFormatted);
                    break;
                case $fieldsFormat === self::FIELDS_TYPE_LOWER_CASE:
                    $keyFormatted = strtolower($keyFormatted);
                    break;
                default:
                    $keyFormatted = $key;
            }
            $result[$keyFormatted] = $value;
        }
        return $result;
    }
}