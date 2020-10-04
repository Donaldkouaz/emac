<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 * @Vich\Uploadable
 */
class Projet
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
     * @ORM\Column(type="datetime")
     */
    private $datecreation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_de_modification;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="boolean")
     */
    private $avant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $auteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="projets", fileNameProperty="image1.name", size="image1.size", mimeType="image1.mimeType", originalName="image1.originalName", dimensions="image1.dimensions")
     * 
     * @var File|null
     */
    private $image1File;

     /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="projets", fileNameProperty="image2.name", size="image2.size", mimeType="image2.mimeType", originalName="image2.originalName", dimensions="image2.dimensions")
     * 
     * @var File|null
     */
    private $image2File;

     /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="projets", fileNameProperty="image3.name", size="image3.size", mimeType="image3.mimeType", originalName="image3.originalName", dimensions="image3.dimensions")
     * 
     * @var File|null
     */
    private $image3File;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image1;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image2;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image3;

    public function __construct() {
        $this->datecreation = new \DateTime;
        $this->active = false;
        $this->avant = false;
        $this->image1 = new EmbeddedFile();
        $this->image2 = new EmbeddedFile();
        $this->image3 = new EmbeddedFile();
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

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getDateDeModification(): ?\DateTimeInterface
    {
        return $this->date_de_modification;
    }

    public function setDateDeModification(?\DateTimeInterface $date_de_modification): self
    {
        $this->date_de_modification = $date_de_modification;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getAvant(): ?bool
    {
        return $this->avant;
    }

    public function setAvant(bool $avant): self
    {
        $this->avant = $avant;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(?string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
    public function __toString()
    {
        return $this->getNom() ?: '';
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

    public function getImage2(): \Vich\UploaderBundle\Entity\File
    {
        return $this->image2;
    }

    public function setImage2(\Vich\UploaderBundle\Entity\File $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3(): \Vich\UploaderBundle\Entity\File
    {
        return $this->image3;
    }

    public function setImage3(\Vich\UploaderBundle\Entity\File $image3): self
    {
        $this->image3 = $image3;

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
    public function setImage1File(?File $imageFile = null)
    {
        $this->image1File = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->date_de_modification = new \DateTimeImmutable();
        }
    }

    public function setImage2File(?File $imageFile = null)
    {
        $this->image2File = $imageFile;

        if (null !== $imageFile) {
            $this->date_de_modification = new \DateTimeImmutable();
        }
    }

    public function setImage3File(?File $imageFile = null)
    {
        $this->image3File = $imageFile;

        if (null !== $imageFile) {
            $this->date_de_modification = new \DateTimeImmutable();
        }
    }

    public function getImage1File(): ?File
    {
        return $this->image1File;
    }
    public function getImage2File(): ?File
    {
        return $this->image2File;
    }
    public function getImage3File(): ?File
    {
        return $this->image3File;
    }

}
