<?php
  session_start();
  require "Connect.class.php";
  class login {
    public function checklogin_ForEmpty()
    {
      if($_POST['login']=='')
      {   
        $response = array("type" =>"1","message" =>"Empty login");
        echo json_encode($response);
        die();
      }
      if($_POST['password']=='')
      { 
        $response = array("type" =>"2","message" =>"Empty password");
        echo json_encode($response);
        die();
      }
    }
    public function checklogin_ForTrue($xmlfile)
    {
      $i=0;
      $salt='DeutshlandfromRammstein';
      foreach($xmlfile as $key)
      {
          if ($key->login==$_POST['login'] )
          {
            
            if($key->password==md5($_POST['password'] . $salt))
            {
              $response = array("type" =>"0");
              echo json_encode($response);
              $_SESSION['username']=$_POST['login'];
              $_SESSION['status']=true;
              die();
            }
            else
            { 
              $response = array("type" =>"3","message" =>"False password");
              echo json_encode($response);
              die();
            }
          }
          else
          {
            $i++;
            if($i== count($xmlfile))
            {
              $response = array("type" =>"4","message" =>"Wrong login");
              echo json_encode($response);
            }
          }
      }
    }
  }
$newLogin=new login();
$newConnect=new connect();
$xml = $newConnect->xmlconnect();
$newLogin->checklogin_ForEmpty();
$newLogin->checklogin_ForTrue($xml);
?>
