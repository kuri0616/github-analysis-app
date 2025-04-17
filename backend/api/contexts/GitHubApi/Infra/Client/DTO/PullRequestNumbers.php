<?php

    namespace App\Contexts\GitHubApi\Infra\Client\DTO;

    class PullRequestNumbers
    {
        /**
         * @var int[]
         */
        public array $numbers;

        /**
         * @param array $data
         */
        public function __construct(array $data)
        {
            $this->numbers = array_map(fn($item) => (int)$item['number'], $data);
        }

        public function toArray(): array
        {
            return $this->numbers;
        }
    }
