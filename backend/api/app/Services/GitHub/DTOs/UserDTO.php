<?php

namespace App\Services\GitHub\DTOs;

class UserDTO
{
    public int $id;
    public string $login;
    public string $avatarUrl;
    public string $htmlUrl;
    public ?string $name;
    public ?string $email;
    public ?string $bio;

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
        $this->email = $data['email'] ?? null;
        $this->bio = $data['bio'] ?? null;
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
            'login' => $this->login,
            'avatar_url' => $this->avatarUrl,
            'html_url' => $this->htmlUrl,
            'name' => $this->name,
            'email' => $this->email,
            'bio' => $this->bio,
        ];
    }
}