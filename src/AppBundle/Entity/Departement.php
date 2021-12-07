<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Departement
 *
 * @ORM\Table(name="departement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DepartementRepository")
 */
class Departement
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     */
    private $domaine;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Departement
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set domaine
     *
     * @param string $domaine
     *
     * @return Departement
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;

        return $this;
    }

    /**
     * Get domaine
     *
     * @return string
     */
    public function getDomaine()
    {
        return $this->domaine;
    }
}

