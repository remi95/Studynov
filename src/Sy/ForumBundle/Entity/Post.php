<?php

namespace Sy\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Sy\ForumBundle\Repository\PostRepository")
 */
class Post
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Sy\MainBundle\Entity\User", inversedBy="posts")
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="Sy\ForumBundle\Entity\Comment", mappedBy="post")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="Sy\MainBundle\Entity\Category", inversedBy="posts")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity="Sy\TutoBundle\Entity\Tutorial", inversedBy="post")
     */
    private $tuto;

    /**
     * @ORM\ManyToOne(targetEntity="Sy\AgendaBundle\Entity\Project", inversedBy="post")
     */
    private $project;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Post
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
     * Set author
     *
     * @param \Sy\MainBundle\Entity\User $author
     *
     * @return Post
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
     * Add comment
     *
     * @param \Sy\ForumBundle\Entity\Comment $comment
     *
     * @return Post
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
     * Add category
     *
     * @param \Sy\MainBundle\Entity\Category $category
     *
     * @return Post
     */
    public function addCategory(\Sy\MainBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Sy\MainBundle\Entity\Category $category
     */
    public function removeCategory(\Sy\MainBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set tuto
     *
     * @param \Sy\TutoBundle\Entity\Tutorial $tuto
     *
     * @return Post
     */
    public function setTuto(\Sy\TutoBundle\Entity\Tutorial $tuto = null)
    {
        $this->tuto = $tuto;

        return $this;
    }

    /**
     * Get tuto
     *
     * @return \Sy\TutoBundle\Entity\Tutorial
     */
    public function getTuto()
    {
        return $this->tuto;
    }

    /**
     * Set project
     *
     * @param \Sy\AgendaBundle\Entity\Project $project
     *
     * @return Post
     */
    public function setProject(\Sy\AgendaBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Sy\AgendaBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
