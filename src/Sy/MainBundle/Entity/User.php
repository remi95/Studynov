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

    /**
     * @ORM\OneToMany(targetEntity="Sy\ForumBundle\Entity\Comment", mappedBy="author")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="Sy\ForumBundle\Entity\Post", mappedBy="author")
     */
    private $tutos;

    /**
     * @ORM\OneToMany(targetEntity="Sy\ForumBundle\Entity\Vote", mappedBy="user")
     */
    private $votes;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function getVoteOnComment($comment)
    {
        foreach ($this->getVotes() as $userVote) {
            foreach ($comment->getVotes() as $commentVote) {
                if ($userVote == $commentVote) {
                    return $userVote->getVote() ? "J'aime" : "Je n'aime pas";
                }
            }
        }
        return null;
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

    /**
     * Add groupClass
     *
     * @param \Sy\MainBundle\Entity\GroupClass $groupClass
     *
     * @return User
     */
    public function addGroupClass(\Sy\MainBundle\Entity\GroupClass $groupClass)
    {
        $this->groupClasses[] = $groupClass;

        return $this;
    }

    /**
     * Remove groupClass
     *
     * @param \Sy\MainBundle\Entity\GroupClass $groupClass
     */
    public function removeGroupClass(\Sy\MainBundle\Entity\GroupClass $groupClass)
    {
        $this->groupClasses->removeElement($groupClass);
    }

    /**
     * Add comment
     *
     * @param \Sy\ForumBundle\Entity\Comment $comment
     *
     * @return User
     */
    public function addComment(\Sy\ForumBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Sy\ForumBundle\Entity\Comment $comment
     */
    public function removeComment(\Sy\ForumBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add tuto
     *
     * @param \Sy\ForumBundle\Entity\POst $tuto
     *
     * @return User
     */
    public function addTuto(\Sy\ForumBundle\Entity\POst $tuto)
    {
        $this->tutos[] = $tuto;

        return $this;
    }

    /**
     * Remove tuto
     *
     * @param \Sy\ForumBundle\Entity\POst $tuto
     */
    public function removeTuto(\Sy\ForumBundle\Entity\POst $tuto)
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

    /**
     * Add vote
     *
     * @param \Sy\ForumBundle\Entity\Vote $vote
     *
     * @return User
     */
    public function addVote(\Sy\ForumBundle\Entity\Vote $vote)
    {
        $this->votes[] = $vote;

        return $this;
    }

    /**
     * Remove vote
     *
     * @param \Sy\ForumBundle\Entity\Vote $vote
     */
    public function removeVote(\Sy\ForumBundle\Entity\Vote $vote)
    {
        $this->votes->removeElement($vote);
    }

    /**
     * Get votes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotes()
    {
        return $this->votes;
    }
}
