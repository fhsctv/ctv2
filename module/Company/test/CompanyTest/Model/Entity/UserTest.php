<?php

namespace CompanyTest\Model\Entity;

class CompanyTest extends \PHPUnit_Framework_TestCase {


    protected $hydrator;

    public function setUp(){

        $this->hydrator = new \Company\Model\Mapper\User();

    }

    public function testHydratorExtraction(){

        $entity = new \Company\Model\Entity\User();
        $entity->setDisplayName('Administrator')
               ->setEmail('zirnsak@stud.fh-sm.de')
               ->setState('1')
               ->setUsername('administrator')
               ->setPassword('123456');


        $expectedArray = array(
            //'user_id' => null,
            'username'    => 'administrator',
            'email'        => 'zirnsak@stud.fh-sm.de',
            'display_name' => 'Administrator',
            'password'     => '123456',
            'state'        => 1,
        );

        $actualArray = $this->hydrator->extract($entity);

        $this->assertEquals($expectedArray, $actualArray, 'Das extrahierte Array darf keinen null- Wert enthalten oder leer sein');

    }

    public function testHydratorHydrationWithEmptyUserId(){

        $data = array(
            'username'     => 'administrator',
            'email'        => 'zirnsak@stud.fh-sm.de',
            'display_name' => 'Administrator',
            'password'     => '123456',
            'state'        => '1',
        );

        $expectedEntity = new \Company\Model\Entity\User();
        $expectedEntity->setUserName('administrator')
                ->setEmail('zirnsak@stud.fh-sm.de')
                ->setDisplayName('Administrator')
                ->setPassword('123456')
                ->setState('1');

        $actualEntity = $this->hydrator->hydrate($data, new \Company\Model\Entity\User());

        $this->assertEquals($expectedEntity, $actualEntity);

    }

    public function testHydratorHydrationWithSetUserId(){

        $data = array(
            'user_id'      => '21',
            'username'     => 'administrator',
            'email'        => 'zirnsak@stud.fh-sm.de',
            'display_name' => 'Administrator',
            'password'     => '123456',
            'state'        => '1',
        );

        $expectedEntity = new \Company\Model\Entity\User();
        $expectedEntity->setUserName('administrator')
                ->setEmail('zirnsak@stud.fh-sm.de')
                ->setDisplayName('Administrator')
                ->setPassword('123456')
                ->setState('1')
                ->setId(21);

        $actualEntity = $this->hydrator->hydrate($data, new \Company\Model\Entity\User());

        $this->assertEquals($expectedEntity, $actualEntity);


    }




}

?>
