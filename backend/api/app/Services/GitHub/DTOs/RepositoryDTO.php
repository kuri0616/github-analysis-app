<?php

namespace App\Services\GitHub\DTOs;

class RepositoryDTO
{
    public int $id;
    public string $name;
    public string $fullName;
    public string $description;
    public bool $private;
    public ?UserDTO $owner;
    public string $htmlUrl;
    public ?string $language;
    public int $forksCount;
    public int $stargazersCount;
    public int $watchersCount;
    public int $openIssuesCount;
    public string $defaultBranch;
    public string $createdAt;
    public string $updatedAt;
    public ?string $pushedAt;

    /**
     * コンストラクタ
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->fullName = $data['full_name'];
        $this->description = $data['description'] ?? '';
        $this->private = $data['private'];
        $this->owner = isset($data['owner']) ? new UserDTO($data['owner']) : null;
        $this->htmlUrl = $data['html_url'];
        $this->language = $data['language'] ?? null;
        $this->forksCount = $data['forks_count'];
        $this->stargazersCount = $data['stargazers_count'];
        $this->watchersCount = $data['watchers_count'];
        $this->openIssuesCount = $data['open_issues_count'];
        $this->defaultBranch = $data['default_branch'];
        $this->createdAt = $data['created_at'];
        $this->updatedAt = $data['updated_at'];
        $this->pushedAt = $data['pushed_at'] ?? null;
    }

    /**
     * 配列に変換
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'github_id' => $this->id,
            'name' => $this->name,
            'full_name' => $this->fullName,
            'description' => $this->description,
            'is_private' => $this->private,
            'owner_login' => $this->owner ? $this->owner->login : null,
            'owner_github_id' => $this->owner ? $this->owner->id : null,
            'html_url' => $this->htmlUrl,
            'language' => $this->language,
            'forks_count' => $this->forksCount,
            'stargazers_count' => $this->stargazersCount,
            'watchers_count' => $this->watchersCount,
            'open_issues_count' => $this->openIssuesCount,
            'default_branch' => $this->defaultBranch,
            'github_created_at' => $this->createdAt,
            'github_updated_at' => $this->updatedAt,
            'github_pushed_at' => $this->pushedAt,
        ];
    }
}
