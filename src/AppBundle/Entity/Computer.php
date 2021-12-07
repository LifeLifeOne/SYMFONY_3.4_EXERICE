<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Computer
 *
 * @ORM\Table(name="computer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComputerRepository")
 */
class Computer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner le nom du modèle")
     * @Assert\Length(min=2, max="12", minMessage="Le nom du modèle doit faire au moins {{ limit }} caractères", maxMessage="Le nom du modèle ne peut pas faire plus de {{ limit }} caractères") 
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="system", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner le système d'exploitation")
     * @Assert\Length(min=2, max=30, minMessage="Le système d'exploitation doit faire au moins {{ limit }} caractères", maxMessage="Le système d'exploitation ne peut pas faire plus de {{ limit }} caractères")
     */
    private $system;

    /**
     * @var string
     *
     * @ORM\Column(name="macAdresse", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner l'adresse MAC")
     */
    private $macAdresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchase", type="datetime")
     * @Assert\NotBlank(message="Veuillez renseigner la date d'achat")
     */
    private $purchase;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Departement")
     * @ORM\JoinColumn(name="departement_id", referencedColumnName="id")
     *
     */
    private $nameDepartement;

    /**
     * @var string
     * 
     * @ORM\Column(name="images", type="array")
     * 
     */
    private $images = [];
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Computer
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set system
     *
     * @param string $system
     *
     * @return Computer
     */
    public function setSystem($system)
    {
        $this->system = $system;

        return $this;
    }

    /**
     * Get system
     *
     * @return string
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * Set purchase
     *
     * @param \DateTime $purchase
     *
     * @return Computer
     */
    public function setPurchase($purchase)
    {
        $this->purchase = $purchase;

        return $this;
    }

    /**
     * Get purchase
     *
     * @return \DateTime
     */
    public function getPurchase()
    {
        return $this->purchase;
    }

    /**
     * Set nameDepartement
     *
     * @param \AppBundle\Entity\Departement $nameDepartement
     *
     * @return Computer
     */
    public function setNameDepartement(\AppBundle\Entity\Departement $nameDepartement = null)
    {
        $this->nameDepartement = $nameDepartement;

        return $this;
    }

    /**
     * Get nameDepartement
     *
     * @return \AppBundle\Entity\Departement
     */
    public function getNameDepartement()
    {
        return $this->nameDepartement;
    }

    /**
     * Set macAdresse
     *
     * @param string $macAdresse
     *
     * @return Computer
     */
    public function setMacAdresse($macAdresse)
    {
        $this->macAdresse = $macAdresse;

        return $this;
    }

    /**
     * Get macAdresse
     *
     * @return string
     */
    public function getMacAdresse()
    {
        return $this->macAdresse;
    }

    /**
     * Set images
     *
     * @param array $images
     *
     * @return Computer
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }
}
