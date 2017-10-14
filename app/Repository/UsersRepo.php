<?php
namespace App\Repository;
use App\Entity\Users;
use Doctrine\ORM\EntityManager;
 
class UsersRepo
{
 
    /**
     * @var string
     */
    private $class = 'App\Entity\Users';
    /**
     * @var EntityManager
     */
    private $em;
 
 
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
 
 
    public function create(Users $users)
    {
        $this->em->persist($users);
        $this->em->flush();
    }
 
    public function update(Users $users, $data)
    {
        $users->setFullname($data['namesurname']);
        $users->setCode($data['code']);
        $this->em->persist($users);
        $this->em->flush();
    }
 
    public function UsersOfId($id)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'id' => $id
        ]);
    }


	public function getUserData($code)
    {
        $q = $this->em->getRepository($this->class)
        				->findOneBy(['code'=>$code]);
        $iterate = $q;
        return $iterate;

    }

    public function UsersList()
    {
        $q = $this->em->getRepository($this->class)
        			  ->findAll();

        $iterate = $q;
        return $iterate;

    }
 
    public function delete(Users $users)
    {
        $this->em->remove($users);
        $this->em->flush();
    }
 
    /**
     * create Users
     * @return Users
     */
    private function prepareData($data)
    {
        return new Users($data);
    }
}

?>