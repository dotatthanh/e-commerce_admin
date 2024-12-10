<?php

namespace App\Services;

use App\Models\Product;
use GuzzleHttp\Client;
use Exception;

class AIService
{
    protected $httpClient;
    protected $gpt_model;

    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . config('app.chatgpt_api_key'),
                'Content-Type' => 'application/json',
            ],
        ]);
        $this->gpt_model = 'gpt-3.5-turbo';
    }

    public function generateChatAI($message)
    {
        $text = "Bạn là chủ sở hữu của cửa hàng. Vui lòng viết trả lời tin nhắn của khách hàng dựa trên những thông tin sau:\n".Product::getAllProductInfo();

        try {
            $response = $this->httpClient->post('chat/completions', [
                'json' => [
                    'model' => $this->gpt_model,
                    'messages' => [
                        ['role' => 'system', 'content' => $text],
                        ['role' => 'user', 'content' => $message],
                    ],
                    'max_tokens' => 200,
                ]
            ]);

            $content = json_decode($response->getBody(), true)['choices'][0]['message']['content'];
            return [
                'status' => "success",
                'data' => $content,
            ];
        } catch (Exception $e) {
            \Log::error($e);
            return [
                'status' => "fail",
                'error' => $e->getMessage(),
            ];
        }
    }
}
