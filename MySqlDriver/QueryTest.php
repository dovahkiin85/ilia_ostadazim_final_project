<?php


namespace Fira\Test\MySqlDriver;


use Fira\App\DependencyContainer;
use PHPUnit\Framework\TestCase;
use Fira\Infrastructure\Database\Sql\Mysql\LocationRepository;
use Fira\Infrastructure\Database\Sql\Mysql\MySqlDriver;
use function PHPUnit\Framework\assertEmpty;

$col = ["name","latitude","longtitude","description"];
$val = ["name",12312312312.6,213123123.1,"descriptio"];
final class QueryTest extends TestCase
{
    public function testSetterAndGetters(): string
    {
        $res = DependencyContainer::getSqlDriver()->select('test','locationentity','222');
        if (self::assertEquals('ilia',$res) == false){
            return 'yep';
        }
    }
    public function testSetterAndGetters2(): string{
        $res = DependencyContainer::getSqlDriver()->delete('locationentity','id = 1');
        assertEmpty($res,'not found');
        return  'cant connect it to the database sir what ever i do ';

    }
    

}

