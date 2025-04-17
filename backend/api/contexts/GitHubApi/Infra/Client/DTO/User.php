<?php

namespace App\Contexts\GitHubApi\Infra\Client\DTO;

class User
{
    public int $id;
    public string $login;
    public string $avatarUrl;
    public string $htmlUrl;
    public ?string $name;

    /**
     * コンストラクタ
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->login = $data['login'];
        $this->avatarUrl = $data['avatar_url'];
        $this->htmlUrl = $data['html_url'];
        $this->name = $data['name'] ?? null;
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
            'avatar_url' => $this->avatarUrl,
            'html_url' => $this->htmlUrl,
        ];
    }
}