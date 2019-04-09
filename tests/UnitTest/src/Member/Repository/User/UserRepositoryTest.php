<?php
namespace Marmot\Application\Member\Repository\User;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

use Marmot\Core;
use Marmot\Application\Member\Model\User;
use Marmot\Application\Member\Utils\ObjectGenerate;
use Marmot\Application\Member\Utils\UserUtils;
use Marmot\Application\Member\Adapter\User\IUserAdapter;

/**
 * Member/Repository/User/UserRepository.class.php 测试文件
 * @author chloroplast
 * @version 1.0.20160218
 */
class UserRepositoryTest extends TestCase
{
    private $repository;

    public function setUp()
    {
        $this->repository = $this->getMockBuilder('Marmot\Application\Member\Repository\User\UserRepository')
                           ->setMethods(['getAdapter'])
                           ->getMock();

        $this->childRepository = new class extends UserRepository {
            public function getAdapter() : IUserAdapter
            {
                return parent::getAdapter();
            }
        };
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->repository);
        unset($this->childRepository);
    }

    public function testImplementsIUserAdapter()
    {
        $this->assertInstanceOf(
            'Marmot\Application\Member\Adapter\User\IUserAdapter',
            $this->repository
        );
    }

    public function testGetAdapter()
    {
        $this->assertInstanceOf(
            'Marmot\Application\Member\Adapter\User\UserDataBaseAdapter',
            $this->childRepository->getAdapter()
        );
    }

    /**
     * 测试仓库add
     */
    public function testAdd()
    {
        $user = ObjectGenerate::generateUser(1);

        $adapter = $this->prophesize(IUserAdapter::class);
        $adapter->add(Argument::exact($user))
            ->shouldBeCalledTimes(1);

        $this->repository->expects($this->exactly(1))
                         ->method('getAdapter')
                         ->willReturn($adapter->reveal());

        $this->repository->add($user);
    }

    /**
     * 测试仓库save
     */
    public function testUpdate()
    {
        $user = ObjectGenerate::generateUser(1);
        $modifyKeys = array('nickName','realName');

        $adapter = $this->prophesize(IUserAdapter::class);
        $adapter->update(Argument::exact($user), Argument::exact($modifyKeys))
            ->shouldBeCalledTimes(1);

        $this->repository->expects($this->exactly(1))
                         ->method('getAdapter')
                         ->willReturn($adapter->reveal());

        $this->repository->update($user, $modifyKeys);
    }

    /**
     * 测试仓库获取单独数据
     */
    public function testGetOne()
    {
        $id = 1;

        $adapter = $this->prophesize(IUserAdapter::class);
        $adapter->getOne(Argument::exact($id))
                ->shouldBeCalledTimes(1);

        $this->repository->expects($this->exactly(1))
                         ->method('getAdapter')
                         ->willReturn($adapter->reveal());

        $this->repository->getOne($id);
    }

    /**
     * 测试仓库获取批量数据
     */
    public function testGetList()
    {
        $ids = [1,2,3,4,5,6,7,8,9,10];

        $adapter = $this->prophesize(IUserAdapter::class);
        $adapter->getList(Argument::exact($ids))
                ->shouldBeCalledTimes(1);

        $this->repository->expects($this->exactly(1))
                         ->method('getAdapter')
                         ->willReturn($adapter->reveal());

        $this->repository->getList($ids);
    }

    public function testFilter()
    {
        $filter = array('cellPhone'=>'15202939435');
        $sort = array('id'=>-1);
        $offset = 10;
        $size = 10;

        $adapter = $this->prophesize(IUserAdapter::class);
        $adapter->filter(
            Argument::exact($filter),
            Argument::exact($sort),
            Argument::exact($offset),
            Argument::exact($size)
        )->shouldBeCalledTimes(1);

        $this->repository->expects($this->exactly(1))
                         ->method('getAdapter')
                         ->willReturn($adapter->reveal());

        $this->repository->filter($filter, $sort, $offset, $size);
    }
}
