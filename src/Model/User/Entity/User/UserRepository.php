<?php


namespace App\Model\User\Entity\User;


use Doctrine\ORM\EntityManagerInterface;

class UserRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(User::class);
    }

    public function add(User $user)
    {
        $this->em->persist($user);
    }

    public function findByConfirmToken(string $token): ?User
    {
         return $this->repo->findOneBy(['token' => $token]);
    }

    public function hasByEmail(Email $email): bool
    {
        return $this->repo->createQueryBuilder('t')
            ->select('count(t.id)')
            ->where('t.email = :email')
            ->setParameter(':email', $email)
            ->getQuery()->getSingleScalarResult() > 0;
    }

    public function hasByNetworkIdentity(string $network, string $identity): bool
    {

    }

    public function get(Id $id): User
    {
        if(!$item = $this->repo->find($id)) {
            throw new \Exception('User is not found.');
        }
        return $item;
    }

    public function getByEmail(Email $email): User
    {
        if(!$item = $this->repo->findOneBy(['email' => $email])) {
            throw new \Exception('User is not found.');
        }
        return $item;
    }

    public function findByResetToken(string $resetToken): ?User
    {
        return $this->repo->findOneBy(['resetToken.token' => $resetToken]);
    }
}