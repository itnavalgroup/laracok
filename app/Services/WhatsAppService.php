<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send WhatsApp message using Fontee API
     * 
     * @param string $number Target phone number
     * @param string $message Message content
     * @return mixed Response from Fontee or error message
     */
    public function sendFontee(string $number, string $message)
    {
        $token = env('FONTEE_TOKEN');
        if (!$token) {
            Log::error("WhatsAppService: FONTEE_TOKEN not found in .env");
            return 'TOKEN NOT FOUND';
        }

        // Format number: remove non-numeric, replace leading 0 with 62
        $number = preg_replace('/[^0-9]/', '', $number);
        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => trim($token),
            ])->post('https://api.fonnte.com/send', [
                'target' => $number,
                'message' => $message,
                'countryCode' => '62',
            ]);

            if ($response->failed()) {
                Log::error("WhatsAppService: Failed to send message to $number. Response: " . $response->body());
                return 'HTTP ERROR: ' . $response->status();
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error("WhatsAppService: Exception - " . $e->getMessage());
            return 'EXCEPTION: ' . $e->getMessage();
        }
    }
}
