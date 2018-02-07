<?php

namespace Sy\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Sy\MainBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Sy\TutoBundle\Entity\Tutorial", mappedBy="categories")
     */
    private $tutorials;


    public function __toString()
    {
        return (String) $this->getName();
    }

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
     * @return Category
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
     * Constructor
     */
    public function __construct()
    {
        $this->tutorials = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tutorial
     *
     * @param \Sy\TutoBundle\Tutorial $tutorial
     *
     * @return Category
     */
    public function addTutorial(\Sy\TutoBundle\Tutorial $tutorial)
    {
        $this->tutorials[] = $tutorial;

        return $this;
    }

    /**
     * Remove tutorial
     *
     * @param \Sy\TutoBundle\Tutorial $tutorial
     */
    public function removeTutorial(\Sy\TutoBundle\Tutorial $tutorial)
    {
        $this->tutorials->removeElement($tutorial);
    }

    /**
     * Get tutorials
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTutorials()
    {
        return $this->tutorials;
    }
}
