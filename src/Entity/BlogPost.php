<?php

namespace App\Entity;

use App\Repository\BlogPostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogPostRepository::class)
 */
class BlogPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subtitel;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $published_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $preview_text;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $main_text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archived = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitel(): ?string
    {
        return $this->titel;
    }

    public function setTitel(string $titel): self
    {
        $this->titel = $titel;

        return $this;
    }

    public function getSubtitel(): ?string
    {
        return $this->subtitel;
    }

    public function setSubtitel(string $subtitel): self
    {
        $this->subtitel = $subtitel;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->published_at;
    }

    public function setPublishedAt(\DateTimeImmutable $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }

    public function getPreviewText(): ?string
    {
        return $this->preview_text;
    }

    public function setPreviewText(?string $preview_text): self
    {
        $this->preview_text = $preview_text;

        return $this;
    }

    public function getMainText(): ?string
    {
        return $this->main_text;
    }

    public function setMainText(string $main_text): self
    {
        $this->main_text = $main_text;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getArchived (): ?bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }
}
