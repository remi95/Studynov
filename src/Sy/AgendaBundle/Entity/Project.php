<?php

namespace Sy\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="Sy\AgendaBundle\Repository\ProjectRepository")
 */
class Project
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide")
     * @Assert\Date()
     * @Assert\Range(
     *     min = "now",
     *     minMessage = "Tu ne peux pas entrer un projet dont la date de rendu est passée",
     * )
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank(message = "Ce champs ne peut pas être vide, décrit ce qu'il faut faire")
     * @Assert\Type("string", message = "Ce champs doit être une chaîne de caractère")
     * @Assert\Length(
     *     min = 10,
     *     minMessage = "La description doit faire au moins {{ limit }} caractères",
     * )
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Sy\MainBundle\Entity\User", inversedBy="projects")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Sy\MainBundle\Entity\Course", inversedBy="projects")
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide, décrit ce qu'il faut faire")
     */
    private $course;

    /**
     * @ORM\ManyToOne(targetEntity="Sy\MainBundle\Entity\Classroom", inversedBy="projects")
     */
    private $classroom;



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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Project
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set author
     *
     * @param \Sy\MainBundle\Entity\User $author
     *
     * @return Project
     */
    public function setAuthor(\Sy\MainBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Sy\MainBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set course
     *
     * @param \Sy\MainBundle\Entity\Course $course
     *
     * @return Project
     */
    public function setCourse(\Sy\MainBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \Sy\MainBundle\Entity\Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set classroom
     *
     * @param \Sy\MainBundle\Entity\Classroom $classroom
     *
     * @return Project
     */
    public function setClassroom(\Sy\MainBundle\Entity\Classroom $classroom = null)
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * Get classroom
     *
     * @return \Sy\MainBundle\Entity\Classroom
     */
    public function getClassroom()
    {
        return $this->classroom;
    }
}
