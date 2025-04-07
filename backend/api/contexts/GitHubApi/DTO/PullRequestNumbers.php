<?php

    namespace App\Contexts\GitHubApi\DTO;

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
    }
