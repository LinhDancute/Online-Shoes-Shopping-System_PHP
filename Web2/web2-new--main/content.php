<?php
if (isset($_GET["id"])) {
    switch ($_GET["id"]){
        case 1:
            echo "Trang chủ";
            break;
        case 2:
            echo "Thông tin tuyển sinh";
            break;
        case 3:
            echo "Thông tin đào tạo";
            break;
        case 4:
            require("page/FormDK.php");
            break;
        }
}
if(isset($_GET['number'])) {
    switch ($_GET['number']) {
        case "showAccount":
            require("page/showAccount.php");
            break;
        case "login":
            require("page/FormLogin.php");
            break;
        case "signup":
            require("page/register/FormSignUp.php");
            break;
        case "signup-next":
            require("page/register/FormSignUpNext.php");
            break;
        case "OTP_email_register";
            require("page/register/OTP_email_register.php");
            break;
        case "OTP_phone_register";
            require("page/register/OTP_phone_register.php");
            break; 
        case "sum":
            require("page/FormTinh.php");
            break;
        case "reset_passwd":
            require("page/reset_password/FormForget.php");
            break;
        case "OTP_email_reset";
            require("page/reset_password/OTP_email_reset.php");
            break;
        case "OTP_phone_reset";
            require("page/reset_password/OTP_phone_reset.php");
            break; 
        case "reset-password-form";
            require("page/reset_password/FormReset.php");
        default:
    }
}
?>