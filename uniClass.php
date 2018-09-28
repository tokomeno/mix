<?php 
class Unipay {
    public $MerchantID = 7507231;
    public $SecretKey = "80BB6BD4-F996-4B03-8E05-C8DCA7B95DC1";
    public $MerchantUser = 'Testdev';
    public $MerchantOrderID = "2";
    public $OrderPrice = 1300; 
    public $backLink;
    public $language = 'GE';
    // public $submit_url = "https://api.unipay.com/checkout/createorder";
    public $submit_url = "http://localhost:8000/foo/bar";


    public function __construct() {
         $this->backLink = base64_encode("http://localhost:8080/plain/req.php");
    }

    /**
     * Parse each items.
     * @var object $order
     * @var object $items
     * @return array hash and opts
     */
    public function unipayData(){  
        
        $data = [
            "MerchantID"        => $this->MerchantID,
            "MerchantUser"      => $this->MerchantUser,
            "MerchantOrderID"   => $this->MerchantOrderID,
            "OrderPrice"        => $this->OrderPrice,
            "OrderCurrency"     =>"GEL",
            "BackLink"          => $this->backLink,
            "Language"		    => $this->language, 
            // "Mlogo"            => base64_encode($this->logo),
            // "Mslogan"		   => preg_replace( '/[^\p{L}0-9\s]+/u', '',substr($this->slogan,0,70)),
            "OrderName"         => 'test order',
            "OrderDescription"  => "Star Wars : Episode VII The Force Awakens...",
        ]; 

        $hash= [ 'Hash' => md5($this->SecretKey.'|'.implode('|',$data))];
        $result = array_merge($hash, $data);
        
        return array(
            'password' => $hash['Hash'],
            'opts'     => json_encode($result)
        );
    }

    
    

    /**
     * Curl
     * @param array $params
     * @return curl $response
     */
    public function sendCurl(array $params)
    {
        $curl = curl_init($params['environmentUrl']);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "$params[merchantId]:$params[password]"); //Your credentials goes here
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params['opts']); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //IMP if the url has https and you don't want to verify source certificate
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                        
                'Content-Type: application/json',                                                                                
                'Content-Length: ' . strlen($params['opts']))                                                                       
            );  
        curl_setopt($curl, CURLOPT_HEADER, false);

        $curlResponse = curl_exec($curl);				
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        if ( $status != 200 ) {
            die($status);
            // $this->log( "Error: call to URL failed with status $status, response $curlResponse, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl), 'error' );
            // die("Error: call to URL failed with status $status, response $curlResponse, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }
        
        $response = json_decode($curlResponse);
        curl_close($curl);	
        return $curlResponse;
        return $response;
    }
}


    $unipay = new Unipay;
    $responseItem = $unipay->unipayData(); 
    $curl_response = $unipay->sendCurl([
        'environmentUrl' => $unipay->submit_url, 
        'merchantId' => $unipay->MerchantID, 
        'password' => $responseItem['password'], 
        'opts' => $responseItem['opts']
    ]);
    var_dump($curl_response); 
