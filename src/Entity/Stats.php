<?php

namespace App\Entity;

use App\Repository\StatsRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Show;

#[ORM\Entity(repositoryClass: StatsRepository::class)]
class Stats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private ?int $Season;

    #[ORM\Column(type: 'integer')]
    private ?int $Episode;

    #[ORM\Column(type: 'string', length: 15)]
    private ?string $Time_stamp;

    #[ORM\OneToOne(inversedBy: 'stats', targetEntity: Show::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Show $TV_show;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeason(): ?int
    {
        return $this->Season;
    }

    public function setSeason(int $Season): self
    {
        $this->Season = $Season;

        return $this;
    }

    public function getEpisode(): ?int
    {
        return $this->Episode;
    }

    public function setEpisode(int $Episode): self
    {
        $this->Episode = $Episode;

        return $this;
    }

    public function getTimeStamp(): ?string
    {
        return $this->Time_stamp;
    }

    public function setTimeStamp(string $Time_stamp): self
    {
        $this->Time_stamp = $Time_stamp;

        return $this;
    }

    public function getTVShow(): ?Show
    {
        return $this->TV_show;
    }

    public function setTVShow(?Show $TV_show): self
    {
        $this->TV_show = $TV_show;

        return $this;
    }
}
