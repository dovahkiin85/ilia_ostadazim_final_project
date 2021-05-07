<?php


namespace Fira\Test\UseCase;

use Fira\Domain\Entity\UserEntity;
use Fira\Domain\Repository\UserRepository;
use Fira\Domain\UseCase\User\DeleteUserUC;
use Fira\Domain\UseCase\User\RegisterUserUC;
use PHPUnit\Framework\TestCase;

final class DeleteUserUCTest extends TestCase
{
    private UserRepository $userRepository;
    private UserEntity $userEntity;


    public function testDeleteUser(): void
    {
        $uc = new RegisterUserUC($this->userRepository);
        $uc
            ->setEmail('ilia@gmail.com')
            ->setName('ilia')
            ->setPassword('ilia2111');
        $userEntity = $uc->execute();

        $uc = new DeleteUserUC($this->userRepository, $userEntity);
        $uc->execute();

        /** @var userEntity $inRepositoryEntity */
        $this->userRepository->getById($userEntity->getId());
    }
}