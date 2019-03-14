<?php

/*
 * Pull your hearder here, for exemple, Licence header.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BacklogRepository")
 */
class Backlog
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @Gedmo\SortablePosition()
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $status;

    /**
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $updatedBy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Acceptation", mappedBy="backlog", orphanRemoval=true)
     */
    private $acceptations;

    public function __construct()
    {
        $this->acceptations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @return Collection|Acceptation[]
     */
    public function getAcceptations(): Collection
    {
        return $this->acceptations;
    }

    public function addAcceptation(Acceptation $acceptation): self
    {
        if (!$this->acceptations->contains($acceptation)) {
            $this->acceptations[] = $acceptation;
            $acceptation->setBacklog($this);
        }

        return $this;
    }

    public function removeAcceptation(Acceptation $acceptation): self
    {
        if ($this->acceptations->contains($acceptation)) {
            $this->acceptations->removeElement($acceptation);
            // set the owning side to null (unless already changed)
            if ($acceptation->getBacklog() === $this) {
                $acceptation->setBacklog(null);
            }
        }

        return $this;
    }
}
