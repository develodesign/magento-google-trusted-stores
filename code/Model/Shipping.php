<?php
/**
 * Created by PhpStorm.
 * User: paul
 * Date: 29/01/15
 * Time: 11:10
 */
class Develo_GoogletrustedStores_Model_Shipping
{
    private $_maxDays = 10;

    /**
     * Get all valid options as an array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $timeOptions = array();

        for( $i = 1; $i <= $this->_maxDays; $i++ )
        {
            $timeOptions[] = array(

                'label' => Mage::helper('develo_googletrustedstores')->__( $i . ' days' ),
                'value' => $i
            );
        }
        return $timeOptions;
    }
}