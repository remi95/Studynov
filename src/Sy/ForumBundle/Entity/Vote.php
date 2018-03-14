<?php

namespace Sy\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="vote")
 * @ORM\Entity(repositoryClass="Sy\ForumBundle\Repository\VoteRepository")
 */
class Vote
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
     * @var bool
     *
     * @ORM\Column(name="vote", type="boolean", nullable=true)
     */
    private $vote;

    /**
     * @ORM\ManyToOne(targetEntity="Sy\ForumBundle\Entity\Comment", inversedBy="votes")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="Sy\MainBundle\Entity\User", inversedBy="votes")
     */
    private $user;


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
     * Set vote
     *
     * @param boolean $vote
     *
     * @return Vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * Get vote
     *
     * @return bool
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Set comment
     *
     * @param \Sy\ForumBundle\Entity\Comment $comment
     *
     * @return Vote
     */
    public function setComment(\Sy\ForumBundle\Entity\Comment $comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return \Sy\ForumBundle\Entity\Comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set user
     *
     * @param \Sy\MainBundle\Entity\User $user
     *
     * @return Vote
     */
    public function setUser(\Sy\MainBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Sy\MainBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
