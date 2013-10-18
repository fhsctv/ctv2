<?php

namespace AdministrationTest\Model\Entity;

class InfoscriptTest extends \PHPUnit_Framework_TestCase {


    protected $hydrator;

    public function setUp(){

        $this->hydrator = new \Administration\Model\Mapper\Infoscript();

    }

    public function testHydratorExtraction(){

        $entity = new \Administration\Model\Entity\Infoscript();
        $entity->setId('1')->setUrlId('2')->setUserId('3');


        $expectedArray = array(
            'id'         => 1,
            'fk_url_id'  => 2,
            'fk_user_id' => 3,
        );

        $actualArray = $this->hydrator->extract($entity);

        $this->assertEquals($expectedArray, $actualArray, 'Das extrahierte Array darf keinen null- Wert enthalten oder leer sein');

    }

    public function testHydratorExtractionWithoutId(){

        $entity = new \Administration\Model\Entity\Infoscript();
        $entity->setUrlId('2')->setUserId('3');


        $expectedArray = array(
            //'id'         => '1',
            'fk_url_id'  => '2',
            'fk_user_id' => '3',
        );

        $actualArray = $this->hydrator->extract($entity);

        $this->assertEquals($expectedArray, $actualArray, 'Das extrahierte Array darf keinen null- Wert enthalten oder leer sein');

    }

    public function testHydratorExtractionWithoutUrlId(){

        $entity = new \Administration\Model\Entity\Infoscript();
        $entity->setId('1')->setUserId('3');


        $expectedArray = array(
            'id'         => '1',
            //'fk_url_id'  => '2',
            'fk_user_id' => '3',
        );

        $actualArray = $this->hydrator->extract($entity);

        $this->assertEquals($expectedArray, $actualArray, 'Das extrahierte Array darf keinen null- Wert enthalten oder leer sein');

    }

    public function testHydratorExtractionWithoutUserId(){

        $entity = new \Administration\Model\Entity\Infoscript();
        $entity->setId('1')->setUrlId('2');


        $expectedArray = array(
            'id'         => '1',
            'fk_url_id'  => '2',
//            'fk_user_id' => '3',
        );

        $actualArray = $this->hydrator->extract($entity);

        $this->assertEquals($expectedArray, $actualArray, 'Das extrahierte Array darf keinen null- Wert enthalten oder leer sein');

    }

    public function testHydratorHydration(){

        $data = array(
            'id'         => '11',
            'fk_user_id' => '12',
            'fk_url_id'  => '111',
        );

        $expectedEntity = new \Administration\Model\Entity\Infoscript();
        $expectedEntity->setId('11')->setUserId('12')->setUrlId('111');

        $actualEntity = $this->hydrator->hydrate($data, new \Administration\Model\Entity\Infoscript());

        $this->assertEquals($expectedEntity, $actualEntity);

    }

    public function testHydratorHydrationWithoutUserId(){

        $data = array(
            'id'         => '11',
//            'fk_user_id' => '12',
            'fk_url_id'  => '111',
        );

        $expectedEntity = new \Administration\Model\Entity\Infoscript();
        $expectedEntity->setId('11')->setUrlId('111');

        $actualEntity = $this->hydrator->hydrate($data, new \Administration\Model\Entity\Infoscript());

        $this->assertEquals($expectedEntity, $actualEntity);

    }

    public function testHydratorHydrationWithoutId(){

        $data = array(
//            'id'         => '11',
            'fk_user_id' => '12',
            'fk_url_id'  => '111',
        );

        $expectedEntity = new \Administration\Model\Entity\Infoscript();
        $expectedEntity->setUserId('12')->setUrlId('111');

        $actualEntity = $this->hydrator->hydrate($data, new \Administration\Model\Entity\Infoscript());

        $this->assertEquals($expectedEntity, $actualEntity);

    }


}

?>
