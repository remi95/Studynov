<?php

namespace Sy\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classroom
 *
 * @ORM\Table(name="classroom")
 * @ORM\Entity(repositoryClass="Sy\MainBundle\Repository\ClassroomRepository")
 */
class Classroom
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
     * @ORM\ManyToOne(targetEntity="Sy\MainBundle\Entity\School", inversedBy="classrooms")
     */
    private $school;

    /**
     * @ORM\OneToMany(targetEntity="Sy\MainBundle\Entity\User", mappedBy="classroom")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity="Sy\AgendaBundle\Entity\Project", mappedBy="classroom")
     */
    private $projects;


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
     * @return Classroom
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
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set school
     *
     * @param \Sy\MainBundle\Entity\School $school
     *
     * @return Classroom
     */
    public function setSchool(\Sy\MainBundle\Entity\School $school = null)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return \Sy\MainBundle\Entity\School
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Add student
     *
     * @param \Sy\MainBundle\Entity\User $student
     *
     * @return Classroom
     */
    public function addStudent(\Sy\MainBundle\Entity\User $student)
    {
        $this->students[] = $student;

        return $this;
    }

    /**
     * Remove student
     *
     * @param \Sy\MainBundle\Entity\User $student
     */
    public function removeStudent(\Sy\MainBundle\Entity\User $student)
    {
        $this->students->removeElement($student);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Add project
     *
     * @param \Sy\AgendaBundle\Entity\Project $project
     *
     * @return Classroom
     */
    public function addProject(\Sy\AgendaBundle\Entity\Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \Sy\AgendaBundle\Entity\Project $project
     */
    public function removeProject(\Sy\AgendaBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }
}
