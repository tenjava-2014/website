<?php namespace TenJava\Tools\String;

/**
 * Interface StringTruncatorInterface
 * @package TenJava\Tools\String
 */
interface StringTruncatorInterface {
    /**
     * @param string $string The string to truncate.
     * @param int $maxLength The maximum length.
     * @return string The truncated string (if it's too long) or the original.
     */
    public function truncateString($string, $maxLength);
}
