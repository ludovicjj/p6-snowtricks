<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class User
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * User constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->enabled = false;
        $this->createdAt = new \DateTime();
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     */
    public function registrationUser(
        string $username,
        string $password,
        string $email
    )
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}