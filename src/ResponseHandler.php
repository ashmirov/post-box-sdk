<?php

namespace Post\Box\Sdk;

use SimpleXMLElement;

class ResponseHandler
{
    public static function xmlToArray(SimpleXMLElement $xml): array
    {
        $array = [];

        foreach ($xml as $name => $element) {
            $node = $element->count() ? self::xmlToArray($element) : trim($element);
            if (isset($array[$name])) {
                if (!is_array($array[$name]) || !isset($array[$name][0])) {
                    $array[$name] = [$array[$name]];
                }
                $array[$name][] = $node;
            } else {
                $array[$name] = $node;
            }
        }

        return $array;
    }
}