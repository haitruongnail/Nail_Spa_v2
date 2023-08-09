<?php
require "./vendor/autoload.php";

use Twilio\Rest\Client;

// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure

// $sid = getenv("TWILIO_ACCOUNT_SID");
// $token = getenv("TWILIO_AUTH_TOKEN");

$twilio = new Client('AC5917b53b6fe53799a1f4f06dd14d65fa', '10ddba273aa81a2766e0e1ca09cc633e');
// var_dump($twilio);

echo "<br> Successful";

$message = $twilio->messages
    ->create(
        "+84969747473",//to
        [
            "body" => "First SMS from Twilio to 0969747473!",
            "from" => "+12542685884",
            "statusCallback" => "http://postb.in/1234abcd"
        ]
    );


print($message->sid);