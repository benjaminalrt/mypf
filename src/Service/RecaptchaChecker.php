<?php
// src/Service/FileUploader.php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;


class RecaptchaChecker
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function isValid($user_response)
    {
        $datas = [
            "secret" => $_ENV['CAPTCHA_KEY'],
            "response" => $user_response
        ];

        $response = $this->client->request(
            'POST',
            'https://www.google.com/recaptcha/api/siteverify',
            [
                "body" => $datas
            ]
        );
        
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
        return $content["success"];
    }
}