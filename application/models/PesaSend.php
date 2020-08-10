<?php

defined('BASEPATH') OR exit('no direct script access allowed');

class PesaSend extends CI_Model {

    public function transData($first_name,$last_name,$phone,$description,$date,$amount,$pesapal_transaction_tracking_id,$pesapal_merchant_reference,$status) {
        /* API URL */
        $url = 'http://localhost/donateb/pesapal';

        /* Init cURL resource */
        $ch = curl_init($url);

        /* Array Parameter Data */
        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'amount' => $amount,
            'date' => $date,
            'description' => $description,
            'transaction_code'=>$pesapal_transaction_tracking_id,
             'merchant_id'=>$pesapal_merchant_reference,
            'status'=>$status
        );

        /* pass encoded JSON string to the POST fields */
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        /* set the content type json */
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        /* set return type json */
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        /* execute request */
        $result = curl_exec($ch);
        log_message('debug', 'Post response :: ' . json_encode($result));

        /* close cURL resource */
        curl_close($ch);
    }

}
