<?php
namespace TenJava\Authentication;

interface EmailOptOutInterface {

    /**
     * @return boolean If visitor is opted in to email sharing.
     */
    public function isOptedIn();

    public function setIsOptedIn($optedIn);
} 