<?php
namespace TenJava\Security;

interface HmacCreationInterface {

    /**
     * @param mixed $data The data to sign.
     * @param string $secret Shared secret.
     * @return mixed The data.
     */
    public function createSignature($data, $secret);

}