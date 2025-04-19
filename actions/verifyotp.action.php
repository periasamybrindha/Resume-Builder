<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


//print_r($_POST);
if($_POST){
    $post=$_POST;

    if($post['otp'] ){

        $otp = $post['otp'];

        if($fn->getSession('otp')==$otp){
            $fn->setAlert('Yah! your email is verified');
            $fn->redirect('../change-password.php'); 

        }else{
            $fn -> setError('Oops! incorrect otp');
            $fn->redirect('../verification.php'); 

        }


    }else{
        $fn -> setError('please enter 6 digit code sended to your email id');
        $fn->redirect('../verification.php');  
    }


}else{
    $fn->redirect('../verification.php');
    
}