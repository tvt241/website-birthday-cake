<?php
namespace Modules\Core\Services\Location;

interface ILocationService
{
    public function province();
    public function district($province);
    public function ward($district);
}