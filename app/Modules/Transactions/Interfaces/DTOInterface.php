<?php

namespace Modules\Transactions\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface DTOInterface
{
    public static function mapData($data, $providerKey): DTOInterface;
}
