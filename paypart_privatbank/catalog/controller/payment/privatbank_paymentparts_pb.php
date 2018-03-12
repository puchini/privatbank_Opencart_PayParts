<?php
class ControllerPaymentPrivatbankPaymentpartsPb extends Controller {
	public function index() {
		$this->language->load('payment/privatbank_paymentparts_pb');

//		$data['text_testmode'] = $this->language->get('text_testmode');
		$data['button_confirm'] = $this->language->get('button_confirm');
        $data['text_label_partsCount'] = $this->language->get('text_label_partsCount');
        $partsCount = $this->config->get('privatbank_paymentparts_pb_merchantType');
        $partsCountArr = array();
        for($i=$partsCount;$i>=2;$i--){
            $partsCountArr[] = $i;           
        }
        $data['partsCounts'] = $partsCountArr;        

//		$data['testmode'] = $this->config->get('pp_standard_test');

		if (!$this->config->get('privatbank_paymentparts_pb_test')) {
//			$data['action'] = 'https://www.paypal.com/cgi-bin/webscr';
            $data['action'] = $this->url->link('payment/privatbank_paymentparts_pb/sendDataDeal', '', 'SSL');
		} else {
//			$data['action'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
            $data['action'] = 'https://brtp.test.it.loc/ipp/';
		}

		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        if ($order_info) {

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/privatbank_paymentparts_pb.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/payment/privatbank_paymentparts_pb.tpl', $data);
            } else {
                return $this->load->view('default/template/payment/privatbank_paymentparts_pb.tpl', $data);
            }
        }
	}
    
    private function generateAnswerSignature ($dataAnsweArr){
        
        $passwordStore = $this->config->get('privatbank_paymentparts_pb_shop_password');
        $storeId = $this->config->get('privatbank_paymentparts_pb_shop_id');
        
        $signatureAnswerStr = $passwordStore.
                              $storeId.
                              $dataAnsweArr['orderId'].
                              $dataAnsweArr['paymentState'].
                              $dataAnsweArr['message'].
                              $passwordStore;
                              
        $signatureAnswer = base64_encode(hex2bin(SHA1($signatureAnswerStr)));
        
        return $signatureAnswer;                               
        
    }
    
    private function generateSignature ($dataArr){
        $productsString = '';
        $signatureStr = '';
        $amountStr ='';
        $passwordStore ='';
        $signature ='';
        $decimalSeparatorArr = array(",", ".");
        foreach ($dataArr['products'] as $key_product=>$val_product) {
              if(!fmod(round($val_product['price'],2),1)){
                $valProductPrice = round($val_product['price'],2).'00';  
              }else{
                $valProductPrice = round($val_product['price'],2);
                $valProductPriceRateArr = explode('.', $valProductPrice);  
                if(strlen($valProductPriceRateArr[1])==1){
                   $valProductPrice = $valProductPrice.'0'; 
                }
              }              
              $productPrice = str_replace($decimalSeparatorArr,'',$valProductPrice);            

              $productsString .= $val_product['name'].$val_product['count'].$productPrice;              
        }
        
        if(!fmod(round($dataArr['amount'],2),1)){
            $dataArrAmount = round($dataArr['amount'],2).'00';
        }else{
             $dataArrAmount = round($dataArr['amount'],2);
             $dataArrAmountRateArr = explode('.', $dataArrAmount);  
             if(strlen($dataArrAmountRateArr[1])==1){
                $dataArrAmount = $dataArrAmount.'0'; 
             }             
        }
        $amountStr = str_replace($decimalSeparatorArr,'',$dataArrAmount);
        $passwordStore = $this->config->get('privatbank_paymentparts_pb_shop_password');
                        
        $signatureStr = $passwordStore.
                        $dataArr['storeId'].
                        $dataArr['orderId'].
                        $amountStr.
                        $dataArr['currency'].
                        $dataArr['partsCount'].
                        $dataArr['merchantType'].
                        $dataArr['responseUrl'].
                        $dataArr['redirectUrl'].
                        $productsString.
                        $passwordStore;                        
                      
         $signature = base64_encode(hex2bin(SHA1($signatureStr)));
               
//         print_r($productsString);exit;
         return $signature;       
    }
    
    private function generateOrderId($orderId,$length = 128){
      $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
      $numChars = strlen($chars);
      $string = '';
      for ($i = 0; $i < $length; $i++) {
        $string .= substr($chars, rand(1, $numChars) - 1, 1);
      }
      
      $stringRes = substr($string,0,(int)strlen($string)-(int)strlen('_'.$orderId)).'_'.$orderId;
      
      return $stringRes;
    }
    
    private function curlPostWithData($url, $request)
    {
    try{
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Accept-Encoding: UTF-8','Content-Type: application/json; charset=UTF-8'));
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        //execute curl
        $response = curl_exec($curl);
        
        //get execute result
        $curl_errno = curl_errno($curl);
        $curl_error = curl_error($curl);
        $aInfo = @curl_getinfo($curl);            
        //close curl
        curl_close($curl);          
        //analysis of the information received
        $this->language->load('payment/privatbank_paymentparts_pb');    
        if($curl_errno!=0){
            $this->log->write('PRIVATBANK_PAYMENTPARTS_PB :: CURL failed ' . $curl_error . '(' . $curl_errno . ')');  
            return $this->language->get('error_curl');
        } 
        if($aInfo["http_code"]!='200'){
            $this->log->write('PRIVATBANK_PAYMENTPARTS_PB :: HTTP failed ' . $aInfo["http_code"] . '(' . $response . ')');  
            return $this->language->get('error_curl');
        } 
              
           
        return json_decode($response,true);
       
    } catch(Exception $e){
        return false;
    }
    }
    
    private function clearCartOnSuccess($order_id){
        
        if (isset($this->session->data['order_id'])) {
            $this->cart->clear();

            // Add to activity log
            $this->load->model('account/activity');

            if ($this->customer->isLogged()) {
                $activity_data = array(
                    'customer_id' => $this->customer->getId(),
                    'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName(),
                    'order_id'    => $this->session->data['order_id']
                );

                $this->model_account_activity->addActivity('order_account', $activity_data);
            } else {
                $activity_data = array(
                    'name'     => $this->session->data['guest']['firstname'] . ' ' . $this->session->data['guest']['lastname'],
                    'order_id' => $this->session->data['order_id']
                );

                $this->model_account_activity->addActivity('order_guest', $activity_data);
            }

            unset($this->session->data['shipping_method']);
            unset($this->session->data['shipping_methods']);
            unset($this->session->data['payment_method']);
            unset($this->session->data['payment_methods']);
            unset($this->session->data['guest']);
            unset($this->session->data['comment']);
            unset($this->session->data['order_id']);
            unset($this->session->data['coupon']);
            unset($this->session->data['reward']);
            unset($this->session->data['voucher']);
            unset($this->session->data['vouchers']);
            unset($this->session->data['totals']);
        } 
    }
    
    public function sendDataDeal(){
   
        //create arr to request Deal
        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
           
        if ($order_info) {
            $data_deal['storeId'] = $this->config->get('privatbank_paymentparts_pb_shop_id');
            $data_deal['orderId'] = $this->generateOrderId($order_info['order_id']);
            $data_deal['amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
            $data_deal['currency'] = $order_info['currency_code'];
            $data_deal['partsCount'] = $this->request->post['partsCount'];
            $data_deal['merchantType'] = 'PB';
            
            $data_deal['products'] = array();

            foreach ($this->cart->getProducts() as $product) {
                $data_deal['products'][] = array(
                    'name'     => htmlspecialchars($product['name']),
                    'count' => $product['quantity'],
                    'price'    => $this->currency->format($product['price'], $order_info['currency_code'], $order_info['currency_value'], false)
                );
            }
            
            //add shipped in products
            if(!empty($this->session->data['shipping_method']) && count($this->session->data['shipping_method'])>0){
                $data_deal['products'][] = array(
                    'name'     => htmlspecialchars($this->session->data['shipping_method']['title']),
                    'count' => 1,
                    'price'    => $this->currency->format($this->session->data['shipping_method']['cost'], $order_info['currency_code'], false, false)
                );                
            }
            //End add shipped in products

            $data_deal['responseUrl'] = $this->url->link('payment/privatbank_paymentparts_pb/callback', '', 'SSL');
//            $data_deal['responseUrl'] =  $this->url->link('checkout/success');
            $data_deal['redirectUrl'] = $this->url->link('checkout/checkout', '', 'SSL');
//            $data_deal['redirectUrl'] = $this->url->link('checkout/success');
//            $data_deal['redirectUrl'] = $this->url->link('payment/privatbank_paymentparts_pb/callback', '', 'SSL');
            $data_deal['signature'] = $this->generateSignature($data_deal);
        }
        //End create arr to request Deal        

        //request url for create Deal  
        $requestDial = json_encode($data_deal);       
        $url = 'https://payparts2.privatbank.ua/ipp/v2/payment/create';        
     
        $responseResDeal = $this->curlPostWithData($url,$requestDial);

        if(is_array($responseResDeal)){
            if(strcmp($responseResDeal['state'], 'FAIL') == 0){
                $this->log->write('PRIVATBANK_PAYMENTPARTS_PB :: DATA DEAL failed: ' . json_encode($responseResDeal));                
            }            
            echo  json_encode($responseResDeal);         
        } else {
            echo json_encode(array('state'=>'sys_error','message'=>$responseResDeal));
        }
        
//        print_r($responseResDeal);exit;        
//        print_r($request);exit; 
        
    }                        

    public function callback() {
        
        $requestPostRaw = file_get_contents('php://input');        
        $requestArr = json_decode(trim($requestPostRaw),true);
//        print_r($requestArr);exit;        

        $this->load->model('checkout/order');

        $orderIdArr = explode('_',$requestArr['orderId']);
        $order_id = $orderIdArr[1];
        $comment = $requestArr['message'];
        $localAnswerSignature = $this->generateAnswerSignature ($requestArr);
        $order_info = $this->model_checkout_order->getOrder($order_id);
        
        if ($order_info) {        
            if (strcmp($requestArr['signature'], $localAnswerSignature) == 0) {
                switch($requestArr['paymentState']) {
                  case 'SUCCESS':
                      $order_status_id = $this->config->get('privatbank_paymentparts_pb_completed_status_id');
    //                  header('Location: '.$this->url->link('checkout/success'));    
                      $this->clearCartOnSuccess($order_id);
                      break;
                  case 'CANCELED':
                      $order_status_id = $this->config->get('privatbank_paymentparts_pb_canceled_status_id');
                      break;
                  case 'FAIL':
                      $order_status_id = $this->config->get('privatbank_paymentparts_pb_failed_status_id');
                      $this->log->write('PRIVATBANK_PAYMENTPARTS_PB :: PAYMENT FAIL!  ORDER_ID:'.$order_id .' MESSAGE:'. $requestArr['message']);
                      break;
                  case 'REJECTED':
                      $order_status_id = $this->config->get('privatbank_paymentparts_pb_rejected_status_id');
                      $this->log->write('PRIVATBANK_PAYMENTPARTS_PB :: PAYMENT REJECTED!  ORDER_ID:'.$order_id .' MESSAGE:'. $requestArr['message']);
                      break;                                                            
                }

                $this->model_checkout_order->addOrderHistory($order_id, $order_status_id, $comment);                
                
            } else {
                $this->log->write('PRIVATBANK_PAYMENTPARTS__PB :: RECEIVED SIGNATURE MISMATCH!  ORDER_ID:'.$order_id .' RECEIVED SIGNATURE:'. $requestArr['signature']);
                $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('config_order_status_id'));
            } 
        }
        
    }
}