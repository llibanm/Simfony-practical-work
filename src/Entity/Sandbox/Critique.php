<?php

namespace App\Entity\Sandbox;

use App\Repository\Sandbox\CritiqueRepository;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Table(name: 'sb_critique')]
#[ORM\Entity(repositoryClass: CritiqueRepository::class)]
class Critique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Film::class,inversedBy: 'critiques')]
    #[ORM\JoinColumn(name:'id_film',nullable: false)]
    private ?Film $film = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): static
    {
        $this->film = $film;

        return $this;
    }
}
