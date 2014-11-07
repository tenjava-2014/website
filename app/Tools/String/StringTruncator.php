<?php namespace TenJava\Tools\String;

/**
 * Class StringTruncator
 * @package TenJava\Tools\String
 */
class StringTruncator implements StringTruncatorInterface {

    /**
     * @param string $string The string to truncate.
     * @param int $maxLength The maximum length.
     * @return string The truncated string (if it's too long) with "..." appended or the original.
     */
    public function truncateString($string, $maxLength) {
        if (strlen($string) <= $maxLength) {
            return $string;
        } else {
            $maxLength = $maxLength - 3;
            $truncatedString = substr($string, 0, $maxLength) . "...";
            return $truncatedString;
        }
    }
}
