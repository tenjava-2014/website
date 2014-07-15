<?php


namespace TenJava\Security;


class HmacCreation implements HmacCreationInterface {

    /**
     * @param mixed $data The data to sign.
     * @param string $secret Shared secret.
     * @return string The data.
     */
    public function createSignature($data, $secret) {
        return http_build_query(["sha1" => hash_hmac("sha1", $data, $secret)]);
    }
}