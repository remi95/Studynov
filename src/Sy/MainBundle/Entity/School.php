<?php

namespace Sy\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * School
 *
 * @ORM\Table(name="school")
 * @ORM\Entity(repositoryClass="Sy\MainBundle\Repository\SchoolRepository")
 */
class School
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
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Sy\MainBundle\Entity\Classroom", mappedBy="school")
     */
    private $classrooms;

    public function __toString()
    {
        return (string) $this->getName();
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
     * @return School
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
        $this->classrooms = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add classroom
     *
     * @param \Sy\MainBundle\Entity\Classroom $classroom
     *
     * @return School
     */
    public function addClassroom(\Sy\MainBundle\Entity\Classroom $classroom)
    {
        $this->classrooms[] = $classroom;

        return $this;
    }

    /**
     * Remove classroom
     *
     * @param \Sy\MainBundle\Entity\Classroom $classroom
     */
    public function removeClassroom(\Sy\MainBundle\Entity\Classroom $classroom)
    {
        $this->classrooms->removeElement($classroom);
    }

    /**
     * Get classrooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClassrooms()
    {
        return $this->classrooms;
    }
}
