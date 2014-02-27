<?php

class PaymillAPI {

    private $request;
    private $transaction;
    private $response;

    /**
     * Instantiate Paymill API
     * @param string $PAYMILL_API_KEY
     */
    function __construct($PAYMILL_API_KEY) {
        $this->request = new Paymill\Request($PAYMILL_API_KEY);
        $this->transaction = new Paymill\Models\Request\Transaction();
    }
    
    /**
     * Performs Paymill transaction and returns response
     * @param string $currency
     * @param string $token
     * @param string $description
     * @return string responseCode
     */
    public function doTransaction($amount, $currency, $token, $description) {
        $this->transaction->setAmount($amount) // e.g. "4200" for 42.00 EUR
                ->setCurrency('USD')
                ->setToken($token)
                ->setDescription('Test Transaction');
        
        $this->response = $this->request->create($this->transaction);
        
        return $this->response;
    }
    
    public function getResponseCode() {
        return $this->response->getResponseCode();
    }
    
    public function getCurrency() {
        return $this->response->getCurrency();
    }
}
