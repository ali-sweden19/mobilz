<?php

/**
 * Performs Unit Testing of Company model
 */
class CompanyTest extends CTestCase {

    /**
     * @var Company
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Company;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        unset($this->object);
    }

    /**
     * @covers Company::tableName
     * @todo   Implement testTableName().
     */
    public function testTableName() {
        $tableName=  Company::model()->tableName();
        $this->assertEquals('company', $tableName);
    }

}
