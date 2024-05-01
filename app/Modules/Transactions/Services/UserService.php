<?php


namespace Modules\Transactions\Services;

use Modules\Transactions\Interfaces\UserRepositoryInterface;

class UserService
{

    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }


    public function getFilteredData(array $filters): array
    {
        $jsonFiles = $this->userRepository->getJsonFiles();
        $combinedData = $this->userRepository->readAndCombineJsonData($jsonFiles);
        return $this->filterData($combinedData, $filters);
    }


    /**
     * Applies filters to the combined data.
     *
     * @param array $data
     * @param array $filters
     * @return array
     */
    protected function filterData(array $data, array $filters): array
    {
        return $this->userRepository->applyFilters($data, $filters);
    }


}
