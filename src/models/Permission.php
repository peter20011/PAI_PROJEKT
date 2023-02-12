<?php

class Permission
{
    private $can_delate_band;

    public function __construct( bool $can_delate_band)
    {
        $this->can_delate_band = $can_delate_band;
    }

    public function getPermission(string  $permissionName){
        return $this->$permissionName;
    }

    public function setPermission( string $permissionName, bool $value){
        $this->$permissionName=$value;
    }

}