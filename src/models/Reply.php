<?php
namespace Reply;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="replies")
 */
class Reply
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

  /** 
   * @ORM\Column(type="string")
   */
  protected $email;

  /** 
   * @ORM\Column(type="string")
   */
  protected $name;

  /** 
   * @ORM\Column(type="string")
   */
  protected $comment;

  /** 
   * @ORM\Column(type="integer")
   * @ORM\ManyToOne(targetEntity="Comment", inversedBy="comments")
   * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
   */
  protected $post_id;

/** 
   * @ORM\Column(name="created_at", type="datetime", options={"default": "CURRENT_TIMESTAMP"})
   */
  protected $created_at;



  //getters and setters

  public function getId()
  {
    return $this->id;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setComment($comment)
  {
    $this->comment = $comment;
  }

  public function getComment()
  {
    return $this->comment;
  }

  public function setPostid($post_id)
  {
    $this->post_id = $post_id;
  }

  public function getPostid()
  {
    return $this->post_id;
  }

  public function setCreatedat($created_at)
  {
    $this->created_at = $created_at;
  }
  public function getCreatedat()
  {
    return $this->created_at;
  }
}