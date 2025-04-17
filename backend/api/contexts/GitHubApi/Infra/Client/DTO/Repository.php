<?php

namespace App\Contexts\GitHubApi\Infra\Client\DTO;

class Repository
{
    public int $id;
    public string $name;
    public string $description;
    public bool $private;
    public ?User $owner;
    public string $htmlUrl;
    public string $createdAt;
    public string $updatedAt;

    /**
     * コンストラクタ
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'] ?? '';
        $this->private = $data['private'];
        $this->owner = isset($data['owner']) ? new User($data['owner']) : null;
        $this->htmlUrl = $data['html_url'];
        $this->createdAt = $data['created_at'];
        $this->updatedAt = $data['updated_at'];
    }

    /**
     * 配列に変換
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'is_private' => $this->private,
            'user_id' => $this->owner ? $this->owner->id : null,
            'html_url' => $this->htmlUrl,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
