<?php
  session_start();
  require_once "Connect.class.php";
  class  register {
    public function checkUser_forValidation()
    {
        if (preg_match('/^[a-zA-Z0-9_-]{6,}$/', $_POST['login']))
        {
        }
        else
        {
          $response = array("type" =>"1","message" =>"Wrong login");
          echo json_encode($response);
          die();
        }
        if ($_POST['password']==$_POST['password_repeat'])
        {
        }
        else
        {
          $response = array("type" =>"2","message" =>"Your password repeat was wrong");
          echo json_encode($response);
          die();
        }
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&].{6,}$/', $_POST['password']))
        {
        }
        else
        {
          $response = array("type" =>"3","message" =>"Your password too easy");
          echo json_encode($response);
          die();
        }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
        }
        else
        {
          $response = array("type" =>"4","message" =>"Your email was wrong");
          echo json_encode($response);
          die();
        }
        if (preg_match('/^[a-zA-Z0-9_-]{2,}$/', $_POST['name']))
        { 
          $response = array("type" =>"0");
          echo json_encode($response);
          die();
        }
        else
        {
          $response = array("type" =>"5","message" =>"Your name was wrong");
          echo json_encode($response);
          die();
        } 
    }
    public function AddNewUser($xmlfiles)
    {
      $salt='DeutshlandfromRammstein';
      $user_xml = $xmlfiles->addChild('User');
      $user_xml->addChild('login', $_POST['login']);
      $user_xml->addChild('password',md5($_POST['password'].$salt));
      $user_xml->addChild('password_repeat',md5($_POST['password_repeat'].$salt));
      $user_xml->addChild('email', $_POST['email']);
      $user_xml->addChild('name', $_POST['name']);
      $xmlfiles->asXML('DB/users.xml');
    }
    public function checkUser_forExists($xmlfiles)
    {
      foreach ($xmlfiles as $key) {
        if ($key->login == $dataUser['login'] || $key->email == $dataUser['email'])
        {
          $response = array("type" =>"6","message" =>"This login or email already exists");
          echo json_encode($response);
          die();
        }
      }
    }
  }
  $newConnect= new connect ();
  $xml=$newConnect->xmlconnect();
  $newUser = new register();
  $newUser->checkUser_forExists($xml);
  $newUser->checkUser_forValidation();
  $newUser->AddNewUser($xml);
?>