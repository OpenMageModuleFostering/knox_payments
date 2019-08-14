<?php

class Knox_KnoxGateway_Model_Standard extends Mage_Payment_Model_Method_Abstract {
    /**
     * @var $_code defines the name of our plugin when we register to magento
     */
    protected $_code = 'KnoxGateway';
  
    /**
     * @var $_isInitializeNeeded is set to true to declare we need
     * to initialize while the order is in place
     */
    protected $_isInitializeNeeded      = true;
    /**
     * @var $_canUseInternal is set to true to declare that people can pay
     * with knox from the admin pages
     */
    protected $_canUseInternal          = true;
    /**
     * @var $_canUseForMultishipping is set to false so that we don't try
     * to send to multiple shipping addresses
     */
    protected $_canUseForMultishipping  = false;
    /**
     * @var $_canUseCheckout is set to true due to the fact that we want to
     * be used like any other normal payment gateway
     */
    protected $_canUseCheckout          = true;

    /**
    *@var %_canOrder is true 
    *
    */
    protected $_canOrder=true;




    
    /**
     * @return getOrderPlacedRedirectUrl directs user to complete payment with Knox
     */
    public function getOrderPlaceRedirectUrl() {
        $key = Mage::getStoreConfig('payment/KnoxGateway/api_key');
        $grandTotal = Mage::getSingleton('checkout/cart')->getQuote()->getGrandTotal();//'11.50';
        $reccur = "ot";
        $info = "none";//Mage::getStoreConfig('payment/KnoxGateway/info_request');
        $invoice = Mage::getStoreConfig('payment/KnoxGateway/invoice_detail');
        //get store url and order id for passing through to api connection to update order status. 
        $orderId = Mage::getModel("sales/order")->getCollection()->getLastItem()->getIncrementId();
        $storeURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $callback = "https://knoxpayments.com/pay/success.php?orderId=".$orderId."&storeUrl=".$storeURL."&api=".$key."";//Mage::getStoreConfig('payment/KnoxGateway/callback_url');//"https://www.knoxpayments.com";//
        
      return "https://knoxpayments.com/pay?api_key=".$key."&amount=".$grandTotal."&redirect_url=".$callback."&recurring=".$reccur."&information_request=".$info."&invoice_detail=".$invoice."";
          
         }
         
       

   

}
?>
