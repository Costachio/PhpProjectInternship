<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ShowRepository::class)]
#[ORM\Table(name: '`show`')]
class Show
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private  $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $Title;

    #[ORM\Column(type: 'string', length: 25)]
    private ?string $Show_status;

    #[ORM\OneToOne(mappedBy: 'TV_show', targetEntity: Stats::class, cascade: ['persist', 'remove'])]
    private  $stats;

     public function __construct()
   {
        $this->Title=null;
        $this->Show_status=null;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShowStatus(): ?string
    {
        return $this->Show_status;
    }

    public function setShowStatus(?string $Show_status): self
    {
        $this->Show_status = $Show_status;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(?string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getStats(): ?Stats
    {
        return $this->stats;
    }

    public function setStats(Stats $stats): self
    {
        // set the owning side of the relation if necessary
        if ($stats->getTVShow() !== $this) {
            $stats->setTVShow($this);
        }

        $this->stats = $stats;

        return $this;
    }
}
