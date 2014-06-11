<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 11/06/14
 * Time: 17:56
 */

namespace Security;


class HmacVerification implements HmacVerificationInterface {

    /**
     * @param mixed $data The data to check the signature on.
     * @param string $signature The received signature.
     * @param string $secret The shared secret.
     * @return bool Whether or not the signature we received is valid.
     */
    public function verifySignature($data, $signature, $secret) {
        $calculatedSignature = hash_hmac("sha1", $data, $secret);
        return ($this->compareHashes($signature, $calculatedSignature));
    }

    /**
     * Hash comparison function that mitigates timing attacks.
     *
     * @param string $received Received hash.
     * @param string $expected Expected hash.
     * @author Michael
     * @see http://www.php.net/manual/en/function.hash-hmac.php#111435
     * @return bool Whether the hashes match.
     */
    public function compareHashes($received, $expected) {
        if (!is_string($received) || !is_string($expected)) {
            return false;
        }

        $len = strlen($received);
        if ($len !== strlen($expected)) {
            return false;
        }

        $status = 0;
        for ($i = 0; $i < $len; $i++) {
            $status |= ord($received[$i]) ^ ord($expected[$i]);
        }
        return $status === 0;
    }
}