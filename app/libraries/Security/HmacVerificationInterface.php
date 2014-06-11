<?php
namespace Security;

interface HmacVerificationInterface {

    /**
     * @param mixed $data The data to verify.
     * @param string $signature Hex signature from remote end.
     * @param string $secret Shared secret.
     * @return bool Whether the signature is valid.
     */
    public function verifySignature($data, $signature, $secret);

} 