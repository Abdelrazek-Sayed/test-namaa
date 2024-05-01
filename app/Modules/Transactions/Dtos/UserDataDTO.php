<?php

namespace Modules\Transactions\Dtos;

use Modules\Transactions\Interfaces\DTOInterface;


class UserDataDTO implements DTOInterface
{
    public float $amount;
    public string $provider;
    public string $currency;

    public string $email;
    public string $status;
    public string $registrationDate;
    public string $identification;


    public static function mapData($data, $providerKey): DTOInterface
    {
        $instance = new self;
        $fieldMappings = config("userdata.providers.$providerKey.fields", []);

        foreach ($fieldMappings as $userDataProperty => $dataKey) {
            if ($userDataProperty !== 'status') { // Skip status mapping here
                $instance->$userDataProperty = $data[$dataKey] ?? null;
            }
        }
        $instance->status = self::mapStatus($data, $fieldMappings['status'] ?? null, $providerKey);

        return $instance;
    }

    private static function mapStatus($data, $statusKey, $providerKey): ?string
    {
        if (is_null($statusKey) || !isset($data[$statusKey])) {
            return null;
        }
        $statusCodes = config("userdata.providers.$providerKey.statusCodes", []);

        return $statusCodes[$data[$statusKey]] ?? 'unknown';
    }

}
