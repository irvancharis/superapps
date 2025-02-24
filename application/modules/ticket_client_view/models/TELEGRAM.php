<?php
class TELEGRAM extends CI_Model
{

    private $botToken = '7337958813:AAHEleZfJPKqSRVWg2vDIMp9AzPtj5eYpf0'; // Ganti dengan token bot Anda
    private $apiUrl = 'https://api.telegram.org/bot';

    public function send_message($chatId, $message)
    {
        $url = $this->apiUrl . $this->botToken . "/sendMessage?chat_id=$chatId&text=" . urlencode($message);
        return file_get_contents($url); // Kirim permintaan HTTP untuk mengirim pesan
    }
}
