<?php

/**
 * Performs Unit Testing fo Pamilltoken model
 */
class PaymilltokenTest extends CTestCase {

    /**
     * @var Paymilltoken model
     */
    protected $Paymill;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->Paymill = new Paymilltoken;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        unset($this->Paymill);
    }

    /**
     * @covers Paymilltoken::tableName
     * @todo   Implement testTableName().
     */
    public function testTableName() {
        $tableName = 'paymilltoken';
        $this->assertEquals($tableName, $this->Paymill->tableName());
    }

    /**
     * @covers Paymilltoken::rules
     * @todo   Implement testRules().
     */
    public function testRules() {
        $count = 2;
        $this->assertEquals($count, count($this->Paymill->rules()));
    }
    
    /**
     * @covers Paymilltoken::relations
     * @todo   Implement testRelations().
     */
    public function testRelations() {
        $relation = array(
            'purchases' => array(Paymilltoken::HAS_MANY, 'Purchase', 'token_id'),
        );
        
        $this->assertTrue($relation === $this->Paymill->relations());
    }

    /**
     * @covers Paymilltoken::attributeLabels
     * @todo   Implement testAttributeLabels().
     */
    public function testAttributeLabels() {
        $attributeLabels = array(
			'id' => 'ID',
			'token' => 'Token',
		);
        
        $this->assertTrue($attributeLabels === $this->Paymill->attributeLabels());
    }
    
    /**
     * @covers Paymilltoken::search
     * @todo   Implement testSearch().
     */
    public function testSearch() {
        $this->assertTrue($this->Paymill->search() instanceof CActiveDataProvider);
        // add token to search for
        $token ='test_token_search';
        $this->Paymill->addToken($token);
        $this->assertTrue($this->search($token));
        // remove token
        $this->removeToken($token);
        
    }
    
    /**
     * @covers Paymilltoken::model
     * @todo   Implement testModel().
     */
    public function testModel() {
        $this->assertTrue($this->Paymill->model() instanceof Paymilltoken);
    }
    
    /**
     * @covers Paymilltoken::alreadyProcessed
     * @todo   Implement testAlreadyProcessed().
     */
    public function testAlreadyProcessed() {
        $token = 'test_token1';
        $this->Paymill->addToken($token);
        $this->assertTrue($this->Paymill->alreadyProcessed($token));
        // remove token
        $this->removeToken($token);
    }
    
    /**
     * @covers Paymilltoken::addToken
     * @todo   Implement testAddToken().
     */
    public function testAddToken() {
        $token = 'test_token2';
        $this->assertTrue($this->Paymill->addToken($token));
        $this->assertFalse($this->Paymill->addToken($token));
        // remove token
        $this->removeToken($token);
    }
    
    /**
     * Searches a token in the DB
     * @param string $token
     * @return boolean
     */
    private function search($token) {
        
        $this->Paymill->unsetAttributes();
        $this->Paymill->token=$token;
        
        $dataProvider = $this->Paymill->search();
        foreach ($dataProvider->getData() as $row) {
            if($row->token == $token) {
                return TRUE;
            }
        }
        
        return FALSE;
    }

    /**
     * Removes the model with the given token
     * @param string $token
     */
    private function removeToken($token) {
        $model = $this->Paymill->findByAttributes(array('token'=>$token));
        $model->delete();
    }


}
