<?php
namespace App\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks()
 */
class Users
{
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    public $id;
 
    /**
     * @ORM\Column(type="string")
     */
    public $fullname;
 
    /**
     * @ORM\Column(type="string")
     */
    public $position;

    /**
     * @ORM\Column(type="string")
     */
    public $role;

    /**
     * @ORM\Column(type="string")
     */
    public $team;

    /**
     * @ORM\Column(type="integer")
     */
    public $active;

    /**
     * @ORM\Column(type="string")
     */
    public $code;
 
    public function __construct($input)
    {
        $this->setFullname($input['fullname']);
        $this->setCode($input['code']);
    }
 
    public function getId()
    {
        return $this->id;
    }
 
    public function getFullname()
    {
        return $this->fullname;
    }
 
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }
 
    public function getCode()
    {
        return $this->code;
    }
 
    public function setCode($code)
    {
        $this->code = $code;
    }
}

?>