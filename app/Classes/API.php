<?php

namespace MHN\Akademie;

class API
{
    const REFERENTENTOOL_API_URL = 'http://referenten/api/ma.php';

    public static function erfrageBeitraegeVonRT ($jahr, $event) {

        $curl = curl_init(self::REFERENTENTOOL_API_URL);

        //set the url, number of POST vars, POST data
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(['jahr' => $jahr, 'kennzeichen' => $event]));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $response = curl_exec($curl);

        if ($response === false) {
            return [
                'success' => false,
                'meldung' => 'Fehler beim Abfragen der Daten vom dem Referententool ("' . curl_error($curl
                    ) . '")!',
            ];
        } else {
            $json_decode = json_decode($response, true);
            //close connection
            curl_close($curl);

            if ($json_decode['status'] == 'success') {
                return [
                    'success' => true,
                    'meldung' => 'Alles super! :)',
                    'data' => $json_decode['data'],
                ];
            } else {
                $meldung = '';
                if (isset($json_decode['errorMessage'])) {
                    $meldung .= '[';
                    $errorMessage = $json_decode['errorMessage'];
                    if (isset($errorMessage['errstr'])) {
                        $meldung .= 'errorMessage: "' . $errorMessage['errstr'];
                    }
                    if (isset($json_decode['errorMessage']) && isset($errorMessage['buffer_contents'])) {
                        $meldung .= ' | ';
                    }
                    if (isset($errorMessage['buffer_contents'])) {
                        $meldung .= 'buffer_contents: ' . $errorMessage['buffer_contents'];
                    }
                    $meldung .= ']';

                } else {
                    $meldung = $response;
                }

                return [
                    'success' => false,
                    'meldung' => 'Fehler beim Abfragen der Daten vom dem Referententool ("' . curl_error($curl
                        )
                        . '","' . $meldung . '")!',
                ];
            }
        }
    }
}