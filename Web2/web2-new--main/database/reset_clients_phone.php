<?php

require_once __DIR__ . "/connectDB.php";
require_once __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;



// Twilio configuration
$accountSid = 'AC5df65a9cbe2019cced0c47fee0652a55';
$authToken = '9aff3f087da1d16a29b526d3ab83819c';
$twilioNumber = '+15075967096';

if (isset($_POST['verify-phone'])) {
    $phone = $_POST['phone'];
    $otp = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

    if (empty($phone)) {
        echo "Hãy nhập đầy đủ thông tin";
        exit();
    }

    $sql_insert = "UPDATE clients SET OTP='$otp', created_at=NOW() WHERE phone='$phone'";

    if ($conn->query($sql_insert) !== TRUE) {
        echo "Lỗi: " . $conn->error;
        exit();
    }

    //send OTP to phone
    $client = new Client($accountSid, $authToken);
    $message = $client->messages->create(
        $phone, // To number
        [
            'from' => $twilioNumber, // From a valid Twilio number
            'body' => "Your verification code is: $otp"
        ]
    );

    if (!$message->sid) {
        echo "Lỗi khi gửi tin nhắn: " . $message->ErrorInfo;
        exit();
    }

    $sql_update_phone = "UPDATE clients SET status='active' WHERE phone='$phone'";

    if ($conn->query($sql_update_phone) === TRUE) {
        echo "verification_code";
        //header("Location: ../page/reset_password/OTP_phone_reset.php");
        //exit();
    } else {
        echo "incorrect_otp";
        exit();
    }

    $conn->close();
}

