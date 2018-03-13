<?php

namespace Sy\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroupClass
 *
 * @ORM\Table(name="group_class")
 * @ORM\Entity(repositoryClass="Sy\MainBundle\Repository\GroupClassRepository")
 */
class GroupClass
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
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Sy\MainBundle\Entity\User", inversedBy="groupClass")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Sy\AgendaBundle\Entity\Project", mappedBy="group")
     */
    private $projects;

    /**
     * @ORM\ManyToMany(targetEntity="Sy\TutoBundle\Entity\Tutorial", inversedBy="groups")
     */
    private $tutos;

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
     * @return GroupClass
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
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \Sy\MainBundle\Entity\User $user
     *
     * @return GroupClass
     */
    public function addUser(\Sy\MainBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Sy\MainBundle\Entity\User $user
     */
    public function removeUser(\Sy\MainBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add project
     *
     * @param \Sy\AgendaBundle\Entity\Project $project
     *
     * @return GroupClass
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
     * Add tuto
     *
     * @param \Sy\TutoBundle\Entity\Tutorial $tuto
     *
     * @return GroupClass
     */
    public function addTuto(\Sy\TutoBundle\Entity\Tutorial $tuto)
    {
        $this->tutos[] = $tuto;

        return $this;
    }

    /**
     * Remove tuto
     *
     * @param \Sy\TutoBundle\Entity\Tutorial $tuto
     */
    public function removeTuto(\Sy\TutoBundle\Entity\Tutorial $tuto)
    {
        $this->tutos->removeElement($tuto);
    }

    /**
     * Get tutos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTutos()
    {
        return $this->tutos;
    }
}
