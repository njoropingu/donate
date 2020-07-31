<?php

require_once(APPPATH . 'libraries/OAuth.php');
defined('BASEPATH') OR exit('no direct script access allowed');

class Response extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('pesapal');
        $this->load->model('donor_model');
        $this->load->model('pesaJwt');
    }

    public function index() {
        $pesapal_transaction_tracking_id = $this->input->get('pesapal_transaction_tracking_id');
        $pesapal_merchant_reference = $this->input->get('pesapal_merchant_reference');
        log_message('debug', 'Transaction ID : ' . $pesapal_transaction_tracking_id . ', Merchant reference: ' . $pesapal_merchant_reference);

        // recording in database these to transaction
        $data = array(
            'reference_code' => $pesapal_merchant_reference,
            'tracking_id' => $pesapal_transaction_tracking_id
        );
        $this->donor_model->track($data);

        $consumer_key = "MYFar3WdmpU2bhjighVq+qcUkWSrA4Og"; //Register a merchant account on
        //demo.pesapal.com and use the merchant key for testing.
        //When you are ready to go live make sure you change the key to the live account
        //registered on www.pesapal.com!
        $consumer_secret = "AZGIyTvbSui+V4S4xOfdZcQ+Kb4="; // Use the secret from your test
        //account on demo.pesapal.com. When you are ready to go live make sure you 
        //change the secret to the live account registered on www.pesapal.com!
        $statusrequestAPI = 'https://demo.pesapal.com/api/querypaymentstatus'; //change to      
        //https://www.pesapal.com/api/querypaymentstatus' when you are ready to go live!

        $token = $params = NULL;
        $consumer = new OAuthConsumer($consumer_key, $consumer_secret);
        $signature_method = new OAuthSignatureMethod_HMAC_SHA1();

        //get transaction status
        $request_status = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $statusrequestAPI, $params);
        $request_status->set_parameter("pesapal_merchant_reference", $pesapal_merchant_reference);
        $request_status->set_parameter("pesapal_transaction_tracking_id", $pesapal_transaction_tracking_id);
        $request_status->sign_request($signature_method, $consumer, $token);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_status);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        if (defined('CURL_PROXY_REQUIRED') && CURL_PROXY_REQUIRED == 'True') {
            $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            curl_setopt($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
        }
        $response = curl_exec($ch);
        log_message('debug', 'Transaction status response :: ' . json_encode($response));

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        curl_close($ch);

        //transaction status
        $elements = preg_split("/=/", substr($response, $header_size));
        $status = $elements[1];
        log_message('debug', $status);

        // update transactrion status
        // send to 3rd party
        $donorI = $this->donor_model->getDonors($pesapal_merchant_reference);
        $donorInfo = $donorI[0];
        log_message('debug', json_encode($donorInfo));
        $this->pesaJwt->transData($donorInfo->first_name, $donorInfo->last_name, $donorInfo->phone, $donorInfo->description, $donorInfo->date, $donorInfo->amount, $pesapal_transaction_tracking_id, $pesapal_merchant_reference, $status);

        if ($status == 'SUCCESS') {
            redirect(base_url('thankyou'));
        } else {
            redirect(base_url('error'));
        }
    }

    public function ipn() {
        // Parameters sent to you by PesaPal IPN
        $pesapalNotification = $this->input->get('pesapal_notification_type');

        $pesapal_transaction_tracking_id = $this->input->get('pesapal_transaction_tracking_id');
        $pesapal_merchant_reference = $this->input->get('pesapal_merchant_reference');
        log_message('debug', 'Transaction ID : ' . $pesapal_transaction_tracking_id . ', Merchant reference: ' . $pesapal_merchant_reference);

        // record these to transaction
        $data = array(
            'reference_code' => $pesapal_merchant_reference,
            'tracking_id' => $pesapal_transaction_tracking_id
        );
        $this->donor_model->track($data);

        if ($pesapalNotification == "CHANGE" && $pesapal_transaction_tracking_id != '') {
            $consumer_key = "MYFar3WdmpU2bhjighVq+qcUkWSrA4Og"; //Register a merchant account on
            //demo.pesapal.com and use the merchant key for testing.
            //When you are ready to go live make sure you change the key to the live account
            //registered on www.pesapal.com!
            $consumer_secret = "AZGIyTvbSui+V4S4xOfdZcQ+Kb4="; // Use the secret from your test
            //account on demo.pesapal.com. When you are ready to go live make sure you 
            //change the secret to the live account registered on www.pesapal.com!
            $statusrequestAPI = 'https://demo.pesapal.com/api/querypaymentstatus'; //change to      
            //https://www.pesapal.com/api/querypaymentstatus' when you are ready to go live!

            $token = $params = NULL;
            $consumer = new OAuthConsumer($consumer_key, $consumer_secret);
            $signature_method = new OAuthSignatureMethod_HMAC_SHA1();

            //get transaction status
            $request_status = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $statusrequestAPI, $params);
            $request_status->set_parameter("pesapal_merchant_reference", $pesapal_merchant_reference);
            $request_status->set_parameter("pesapal_transaction_tracking_id", $pesapal_transaction_tracking_id);
            $request_status->sign_request($signature_method, $consumer, $token);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request_status);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            if (defined('CURL_PROXY_REQUIRED') && CURL_PROXY_REQUIRED == 'True') {
                $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
                curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
                curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
                curl_setopt($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
            }
            $response = curl_exec($ch);
            log_message('debug', 'Transaction status response :: ' . json_encode($response));

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            curl_close($ch);

            //transaction status
            $elements = preg_split("/=/", substr($response, $header_size));
            $status = $elements[1];
            log_message('debug', $status);

            // update transactrion status
            // send to 3rd party
            $donorI = $this->donor_model->getDonors($pesapal_merchant_reference);
            $donorInfo = $donorI[0];
            log_message('debug', json_encode($donorInfo));
            $this->pesaJwt->transData($donorInfo->first_name, $donorInfo->last_name, $donorInfo->phone, $donorInfo->description, $donorInfo->date, $donorInfo->amount, $pesapal_transaction_tracking_id, $pesapal_merchant_reference, $status);
        }
    }

}
