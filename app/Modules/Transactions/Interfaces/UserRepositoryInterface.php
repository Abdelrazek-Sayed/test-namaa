<?php

namespace Modules\Transactions\Interfaces;

interface UserRepositoryInterface
{
    public function readJsonData(string $filename): array;


    public function applyFilters(array $data, array $filters): array;

    public function readAndCombineJsonData(array $filenames): array;


    public function getJsonFiles(): array;
}
