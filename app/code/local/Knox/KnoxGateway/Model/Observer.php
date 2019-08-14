<?php

class Knox_KnoxGateway_Model_Observer
/**
*sends a new order confirmation email whenever an order is sucessfully placed.
*
*/

{

    public function sendOrderEmails(Varien_Event_Observer $observer){

        $orderIds = $observer->getData('order_ids');

        foreach($orderIds as $_orderId){

            $order = Mage::getModel('sales/order')->load($_orderId);

            try {

                $order->sendNewOrderEmail();

             Mage::log('email sent');

            } catch (Exception $e) {

                Mage::logException($e);

            }

        }

        return $this;

    }

}
?>
