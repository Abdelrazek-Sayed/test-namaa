<?php

namespace Modules\Transactions\Repositories;

use Modules\Transactions\Dtos\UserDataDTO;
use Modules\Transactions\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class UserRepository implements UserRepositoryInterface
{
    public function readJsonData(string $filename): array
    {
        try {
            return Storage::json('files/' . $filename);
        } catch (\Exception $e) {
            Log::channel('jsonFileLog')->error(sprintf('jsonErrorLog %s - file: %s - line: %s', $e->getMessage(), $e->getFile(), $e->getLine()));
            return [];
        }
    }

    /**
     * Applies filters to data.
     *
     * @param array $data
     * @param array $filters
     * @return array
     */
    public function applyFilters(array $data, array $filters): array
    {
        $filteredData = [];
        foreach ($data as $item) {

            $providerMatch = isset($filters['provider']) ? $item->provider === $filters['provider'] : true;
            $statusCodeMatch = isset($filters['statusCode']) ? $item->status === $filters['statusCode'] : true;
            $balanceMinMatch = isset($filters['balanceMin']) ? $item->amount >= $filters['balanceMin'] : true;
            $balanceMaxMatch = isset($filters['balanceMax']) ? $item->amount <= $filters['balanceMax'] : true;
            $currencyMatch = isset($filters['currency']) ? $item->currency === $filters['currency'] : true;

            if ($providerMatch && $statusCodeMatch && $balanceMinMatch && $balanceMaxMatch && $currencyMatch) {
                $filteredData[] = $item;
            }
        }

        return $filteredData;
    }


    public function readAndCombineJsonData(array $filenames): array
    {
        $allData = [];
        foreach ($filenames as $filename) {
            $providerKey = basename($filename, '.json');
            $rawData = $this->readJsonData($filename);
            if (!empty($rawData)) {
                foreach ($rawData as $dataEntry) {
                    if (!is_array($dataEntry)) continue;
                    $mappedData = UserDataDTO::mapData($dataEntry, $providerKey);
                    $allData[] = $mappedData;
                }
            }
        }
        return $allData;
    }


    /**
     * Retrieves a list of JSON files based on configured providers.
     *
     * @return array
     */
    public function getJsonFiles(): array
    {
        $jsonFiles = [];
        $fieldMappings = config("userdata.providers", []);

        foreach ($fieldMappings as $key => $fieldMapping) {
            $jsonFiles[] = $key . '.json';
        }
        return $jsonFiles;
    }

}
