<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WHATSAPP extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function send_wa($phone, $message)
    {
        $setting = $this->db->get('SETTING')->row();
        $token_wa = $setting->TOKEN_WA;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token_wa . '' //change TOKEN to your actual token
            ),
        ));

        // KODE BAWAAN FONNTE
        // $response = curl_exec($curl);
        // if (curl_errno($curl)) {
        //     $error_msg = curl_error($curl);
        // }
        // curl_close($curl);

        // if (isset($error_msg)) {
        //     echo $error_msg;
        // }
        // echo $response;


        // KODE CUSTOM
        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            log_message('error', 'CURL Error: ' . $error_msg);
        }

        curl_close($curl);

        // Log response untuk debugging
        log_message('info', 'WA Response: ' . $response);

        // Kembalikan nilai true atau false sesuai status pengiriman
        if ($http_code == 200) {
            return true;
        } else {
            return false;
        }
    }

    public function send_wa_group_it($message)
    {
        $id_wa_group_it = "120363399381262566@g.us";
        $setting = $this->db->get('SETTING')->row();
        $token_wa = $setting->TOKEN_WA;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $id_wa_group_it,
                'message' => $message,
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token_wa . '' //change TOKEN to your actual token
            ),
        ));

        // KODE BAWAAN FONNTE
        // $response = curl_exec($curl);
        // if (curl_errno($curl)) {
        //     $error_msg = curl_error($curl);
        // }
        // curl_close($curl);

        // if (isset($error_msg)) {
        //     echo $error_msg;
        // }
        // echo $response;


        // KODE CUSTOM
        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            log_message('error', 'CURL Error: ' . $error_msg);
        }

        curl_close($curl);

        // Log response untuk debugging
        log_message('info', 'WA Response: ' . $response);

        // Kembalikan nilai true atau false sesuai status pengiriman
        if ($http_code == 200) {
            return true;
        } else {
            return false;
        }
    }

    // Fetch WA Group
    public function fetch_wa_group_it()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/fetch-group',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: XmYMkw6PgTm3NhPrx4K6'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    // Get WA Group
    public function get_wa_group_it()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/get-whatsapp-group',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: XmYMkw6PgTm3NhPrx4K6'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
