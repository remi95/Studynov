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
     * @ORM\ManyToMany(targetEntity="Sy\MainBundle\Entity\GroupClass", inversedBy="users")
     */
    private $groupClasses;

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
     * Add tutorial
     *
     * @param \Sy\TutoBundle\Entity\Tutorial $tutorial
     *
     * @return User
     */
    public function addTutorial(\Sy\TutoBundle\Entity\Tutorial $tutorial)
    {
        $this->tutorials[] = $tutorial;

        return $this;
    }

    /**
     * Remove tutorial
     *
     * @param \Sy\TutoBundle\Entity\Tutorial $tutorial
     */
    public function removeTutorial(\Sy\TutoBundle\Entity\Tutorial $tutorial)
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


    /**
     * Add groupClass
     *
     * @param \Sy\MainBundle\Entity\GroupClass $groupClass
     *
     * @return User
     */
    public function addGroupClasses(\Sy\MainBundle\Entity\GroupClass $groupClass)
    {
        $this->groupClasses[] = $groupClass;

        return $this;
    }

    /**
     * Remove groupClass
     *
     * @param \Sy\MainBundle\Entity\GroupClass $groupClass
     */
    public function removeGroupClasses(\Sy\MainBundle\Entity\GroupClass $groupClass)
    {
        $this->groupClasses->removeElement($groupClass);
    }

    /**
     * Get groupClass
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupClasses()
    {
        return $this->groupClasses;
    }
}
