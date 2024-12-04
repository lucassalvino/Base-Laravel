<?php

namespace App\Servicos;

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\Log;

class IntregracaoSES {
    public function SendEmail(string $recipient_email, string $subject, string $message) {

        $sesClient = new SesClient([
            'version' => 'latest',
            'region' => env('AWS_SES_DEFAULT_REGION', 'us-east-1'),
            'credentials' => [
                'key' => env('AWS_SES_ACCESS_KEY_ID', ''),
                'secret' => env('AWS_SES_SECRET_ACCESS_KEY', ''),
            ],
        ]);

        $sender_email = env('AWS_SES_EMAIL_ENVIO', 'noreply@cit.com.br');
        
        $emailParams = [
            'Source' => "<$sender_email>",
            'Destination' => [
                'ToAddresses' => [$recipient_email],
            ],
            'Message' => [
                'Subject' => [
                    'Charset' => 'UTF-8',
                    'Data' => $subject,
                ],
                'Body' => [
                    'Html' => [
                        'Charset' => 'UTF-8',
                        'Data' => $message,
                    ],
                ],
            ],
        ];
        try {
            return $sesClient->sendEmail($emailParams);
        } catch (AwsException $e) {
            Log::error($e);
        }
    }
}
