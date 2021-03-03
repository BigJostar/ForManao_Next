<?PHP
class connect {
 public function xmlconnect()
  {
    $xml =simplexml_load_file('DB/users.xml');
    return $xml ;
  }
 }
?>