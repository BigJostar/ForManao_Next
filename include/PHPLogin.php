<?php
  require "Connect.php";
  $datalogin=$_POST;
  $pathtoJSON=$datalogin['login'];
  function putToJSON($path,$fileToPut)
  {
    file_put_contents($path,'['.json_encode($fileToPut).']');
  };
  if($datalogin['login']=='')
  {
    $response=array("status"=>false,"type"=>'1',"message"=>'Press your login please');
    putToJSON($pathtoJSON,$response);

  }
  if($datalogin['password']=='')
  {
    $response=array("status"=>false,"type"=>'2',"message"=>'Press your password please');
    putToJSON($pathtoJSON,$response);
  }
  function checklogin($dataforcheck,$xmlfile){
    $salt='DeutshlandfromRammstein';
    foreach($xmlfile as $key){
        if ($key->login==$dataforcheck['login'])
        {
          if($key->password==md5($dataforcheck['password'] . $salt))
          {
            $response=array("status"=>true,"login"=>$dataforcheck['login']);
            putToJSON('JS_AJAX/'.$dataforcheck['login'].'.json',$response);
            die();
          }
          else
          { 
            $response=array("status"=>false,"type"=>'0',"message"=>'Wrong password');
            putToJSON('JS_AJAX/'.$dataforcheck['login'].'.json',$response);
          }
        }
        else
        {
          $response=array("status"=>false,"type"=>'3',"message"=>'Wrong login');
          putToJSON('JS_AJAX/'.$dataforcheck['login'].'.json',$response);
        }
    }
  }
  checklogin($datalogin,$xml);
?>