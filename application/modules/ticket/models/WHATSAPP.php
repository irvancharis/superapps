<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WHATSAPP extends CI_Model
{

    public function send_wa($phone, $message)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: 6GCwLNwRZzPZGh7e87Gg' //change TOKEN to your actual token
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
}
