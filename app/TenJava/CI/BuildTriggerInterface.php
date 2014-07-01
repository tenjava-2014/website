<?php
namespace TenJava\CI;

interface BuildTriggerInterface {
    public function setToken($token);
    public function triggerBuild($name, $cause=null);
} 