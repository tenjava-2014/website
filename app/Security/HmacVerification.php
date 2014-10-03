<?php
namespace TenJava\Security;


class HmacVerification implements HmacVerificationInterface {

    /**
     * @param mixed $data The data to check the signature on.
     * @param string $signature The received signature.
     * @param string $secret The shared secret.
     * @return bool Whether or not the signature we received is valid.
     */
    public function verifySignature($data, $signature, $secret) {
        if ($signature === null) {
            return false;
        }
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
            usleep(rand(0, 50 * 1000));
            return false;
        }

        $len = strlen($received);
        if ($len !== strlen($expected)) {
            usleep(rand(0, 50 * 1000));
            return false;
        }

        $status = 0;
        for ($i = 0; $i < $len; $i++) {
            $status |= ord($received[$i]) ^ ord($expected[$i]);
        }
        usleep(rand(0, 50 * 1000));
        return $status === 0;
    }

}