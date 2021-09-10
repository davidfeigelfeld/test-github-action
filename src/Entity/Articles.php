<?php

namespace App\Entity;

use DateTimeInterface;

class Articles
{
    private string $id;
    private string $title;
    private string $content;
    private DateTimeInterface $createdAt;
    private DateTimeInterface|null $updatedAt = null;

    public function __construct(
        string $id,
        string $title,
        string $content,
        DateTimeInterface|null $createdAt = null,
        DateTimeInterface|null $updatedAt = null
    ){
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->createdAt = $createdAt ?: new \DateTimeImmutable();
        $this->updatedAt = $updatedAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }
}