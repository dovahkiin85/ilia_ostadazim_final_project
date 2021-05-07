<?php


namespace Fira\Test\Entity;

use Fira\Domain\Entity\CategoryEntity;
use PHPUnit\Framework\TestCase;

final class CategoryEntityTest extends TestCase
{
    public function testSetterAndGetters(): string
    {
        $res = new CategoryEntity();
        $res->setCategory('ilia');
        $this->assertEquals('ilia', $res->getCategory());
        return $res->getCategory();
    }
}