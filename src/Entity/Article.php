<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => [self::ARTICLE_READ]],
    denormalizationContext: ['groups' => [self::ARTICLE_WRITE]]
)]
#[ApiFilter(SearchFilter::class, properties: [
    'status.name' => 'exact',
    'title' => 'partial',
])]
class Article
{
    public const ARTICLE_READ = 'article:read';
    public const ARTICLE_WRITE = 'article:write';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups([self::ARTICLE_READ])]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 128)]
    #[Assert\NotBlank, Assert\Length(max: 128)]
    #[Groups([self::ARTICLE_READ, self::ARTICLE_WRITE])]
    private ?string $title = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    #[Groups([self::ARTICLE_READ, self::ARTICLE_WRITE])]
    private ?string $content = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups([self::ARTICLE_READ, self::ARTICLE_WRITE])]
    private ?\DateTimeInterface $publicationDate = null;

    #[ORM\ManyToOne(targetEntity: Status::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([self::ARTICLE_WRITE])]
    private ?Status $status = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([self::ARTICLE_READ, self::ARTICLE_WRITE])]
    private ?User $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    #[Groups([self::ARTICLE_READ])]
    #[SerializedName('status')]
    public function getStatusName(): ?string
    {
        return $this->status?->getName();
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
