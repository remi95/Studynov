<?php

namespace Sy\MainBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\OneToMany(targetEntity="Sy\AgendaBundle\Entity\Project", mappedBy="author")
     */
    private $projects;

    /**
     * @ORM\ManyToOne(targetEntity="Sy\MainBundle\Entity\Classroom", inversedBy="students")
     */
    private $classroom;

    /**
     * @ORM\OneToMany(targetEntity="Sy\TutoBundle\Entity\Tutorial", mappedBy="author")
     */
    private $tutorials;



    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add project
     *
     * @param \Sy\AgendaBundle\Entity\Project $project
     *
     * @return User
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

    /**
     * Set classroom
     *
     * @param \Sy\MainBundle\Entity\Classroom $classroom
     *
     * @return User
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
