<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 * @Vich\Uploadable
 */
class Service
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
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDeModification;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="projets", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName", dimensions="image.dimensions")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="services", fileNameProperty="image1.name", size="image1.size", mimeType="image1.mimeType", originalName="image1.originalName", dimensions="image1.dimensions")
     * 
     * @var File|null
     */
    private $imageAvantFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $avant;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionAvant;

    /**
     * @ORM\ManyToMany(targetEntity=Projet::class, mappedBy="ServicesLies")
     */
    private $projets;

    public function __construct()
    {
        $this->dateDeModification = new \DateTime;
        $this->image = new EmbeddedFile();
        $this->active = false;
        $this->avant = false;
        $this->image1 = new EmbeddedFile();
        $this->projets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        $slug = new Slugify();
        $slug = $slug->slugify($nom);
        $this->setSlug($slug);

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

    public function getDateDeModification(): ?\DateTimeInterface
    {
        return $this->dateDeModification;
    }

    public function setDateDeModification(?\DateTimeInterface $dateDeModification): self
    {
        $this->dateDeModification = $dateDeModification;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom() ?: '';
    }

    public function getImage(): \Vich\UploaderBundle\Entity\File
    {
        return $this->image;
    }

    public function setImage(\Vich\UploaderBundle\Entity\File $image): self
    {
        $this->image = $image;

        return $this;
    }

     /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->dateDeModification = new \DateTimeImmutable();
        }
    }
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile|null $imageFile
     */
    public function setImageAvantFile(?File $imageFile = null)
    {
        $this->imageAvantFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->dateDeModification = new \DateTimeImmutable();
        }
    }
    public function getImageAvantFile(): ?File
    {
        return $this->imageAvantFile;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAvant(): ?bool
    {
        return $this->avant;
    }

    public function setAvant(?bool $avant): self
    {
        $this->avant = $avant;

        return $this;
    }

    public function getDescriptionAvant(): ?string
    {
        return $this->descriptionAvant;
    }

    public function setDescriptionAvant(?string $descriptionAvant): self
    {
        $this->descriptionAvant = $descriptionAvant;

        return $this;
    }

    public function getImage1(): \Vich\UploaderBundle\Entity\File
    {
        return $this->image1;
    }

    public function setImage1(\Vich\UploaderBundle\Entity\File $image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets[] = $projet;
            $projet->addServicesLy($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->contains($projet)) {
            $this->projets->removeElement($projet);
            $projet->removeServicesLy($this);
        }

        return $this;
    }
}
