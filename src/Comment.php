<?php
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment
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
   * @ORM\OneToMany(targetEntity="Comment", mappedBy="id", cascade={"persist"})
   * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
   */
  protected $post_id;

/** 
   * @ORM\Column(type="datetime")
   */
  protected $created_at;

/** 
   * @ORM\Column(type="integer")
   */
  protected $reply_of;




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

  public function setReplyof($reply_of)
  {
    $this->reply_of = $reply_of;
  }
  public function getReplyof()
  {
    return $this->reply_of;
  }
}