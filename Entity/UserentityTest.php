<?php

namespace Fira\Test\Entity;

use Fira\App\DependencyContainer;
use Fira\Domain\Entity\UserEntity;
use PHPUnit\Framework\TestCase;

final class UserentityTest extends TestCase
{
    public int $assert;
    public function testSetterAndGetters(): bool
    {
        $locationEntity = new UserEntity();
        $locationEntity->setFamily('ostadazim');
        $locationEntity->setName('ilia');
        $locationEntity->setEmail('test.test@gmail.com');
        $locationEntity->setPasswordHash('test2916');




        $this->assertEquals('ostadazim', $locationEntity->getFamily());
        $this->assertEquals('ilia', $locationEntity->getName());
        $this->assertEquals('test.test@gmail.com', $locationEntity->getEmail());
        $this->assertEquals('test2916', $locationEntity->getPasswordHash());
        return true;
    }
    public function testSetterAndGetters2(): void
    {
        $res = DependencyContainer::getSqlDriver()->select('1231','12323','123123');
        if($res) {
            $assert = 1;
        }
        self::assertEquals(1,$assert);
        }

}