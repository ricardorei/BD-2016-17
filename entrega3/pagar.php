<html>
 <body>
<?php
 $numero = $_REQUEST['n'];
 $data = date('Y-m-d');
 $metodo = $_REQUEST['metodo'];
 $timestamp = date('Y-m-d G:i:s');

 try
 {
 $host = "db.ist.utl.pt";
 $user ="ist177981";
 $password = "cjrg2559";
 $dbname = $user;
 $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password,array(PDO::ATTR_PERSISTENT=> true));
 } catch (Exception $e) {
  die("Unable to connect: " . $e->getMessage());
}
 try{
 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	$db->beginTransaction();
 	$db->exec("INSERT into Paga values ($numero,'$data','$metodo')");
 	$db->exec("UPDATE Estado set estado='paga',time_stamp='$timestamp' where numero=$numero)";
 	$db->commit();
 }catch (Exception $e) {
  $db->rollBack();
  echo "Failed: " . $e->getMessage();
}
 echo("<p>A Reserva foi paga com sucesso</p>");
 $db = null;
 }
 catch (PDOException $e)
 {
 echo("<p>ERROR: {$e->getMessage()}</p>");
 }
?>
 <form><input Type="button" VALUE="Go Back" onClick="history.go(-1);return true;"></form>
 </body>
</html>