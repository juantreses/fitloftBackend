<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDataPersister implements DataPersisterInterface
{

    private $entityManager;
    private $userPasswordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $userPasswordEncoder)
    {

        $this->entityManager = $entityManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * Is the data supported by the persister?
     */
    public function supports($data): bool
    {
        return $data instanceof User;
    }

    /**
     * Persists the data.
     *
     * @param User $data
     * @return object|void Void will not be supported in API Platform 3, an object should always be returned
     */
    public function persist($data)
    {
        if ($data->getPlainPassword()) {
            $data->setPassword(
                $this->userPasswordEncoder->encodePassword($data, $data->getPlainPassword())
            );

            $data->eraseCredentials();
        }

        $data->setRegkey('test');


        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    /**
     * Removes the data.
     */
    public function remove($data)
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}