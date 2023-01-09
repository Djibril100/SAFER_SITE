<?php

namespace App\Entity;

use App\Repository\BienRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/*L'entité Bien possede : 
    - id
    - reference	
    - intitule	
    - descriptif	
    - localisation	
    - surface	
    - prix	
    - type	
    - categorie
*/

#[ORM\Entity(repositoryClass: BienRepository::class)]
class Bien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 15)]
    private ?string $reference = null;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 200)]
    private ?string $intitule = null;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 200)]
    private ?string $descriptif = null;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 10)]
    private ?string $localisation = null;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 10)]
    private ?string $surface = null;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 15)]
    private ?string $prix = null;

    /**
     * @Assert\NotBlank
     */
    #[ORM\Column(length: 20)]
    private ?string $type = null;

    /**
     * @Assert\NotBlank
     */
    #[ORM\ManyToOne(inversedBy: 'biens')]
    private ?Categorie $categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
