<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StatusRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => [self::STATUS_READ]],
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
class Status
{
    public const DRAFT = 1;
    public const PUBLISHED = 2;
    public const DELETED = 3;
    public const STATUS_READ = 'status:read';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 10)]
    #[Groups([self::STATUS_READ])]
    private string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
