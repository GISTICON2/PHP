--TEST--
PDO_Firebird: rowCount
--SKIPIF--
<?php extension_loaded("pdo_firebird") or die("skip"); ?>
--FILE--
<?php /* $Id: rowCount.phpt 305476 2010-11-18 01:24:00Z felipe $ */

require("testdb.inc");

$dbh = new PDO("firebird:dbname=$test_base",$user,$password) or die;

@$dbh->exec('DROP TABLE testz');
$dbh->exec('CREATE TABLE testz (A VARCHAR(10))');
$dbh->exec("INSERT INTO testz VALUES ('A')");
$dbh->exec("INSERT INTO testz VALUES ('A')");
$dbh->exec("INSERT INTO testz VALUES ('B')");
$dbh->commit();

$query = "SELECT * FROM testz WHERE A = ?";

$stmt = $dbh->prepare($query);
$stmt->execute(array('A'));
$rows = $stmt->fetch();
$rows = $stmt->fetch();
var_dump($stmt->fetch());
var_dump($stmt->rowCount());

$stmt = $dbh->prepare('UPDATE testZ SET A="A" WHERE A != ?');
$stmt->execute(array('A'));
var_dump($stmt->rowCount());
$dbh->commit();

$stmt = $dbh->prepare('DELETE FROM testz');
$stmt->execute();
var_dump($stmt->rowCount());

$dbh->commit();

$dbh->exec('DROP TABLE testz');

unset($dbh);

?>
--EXPECT--
bool(false)
int(2)
int(1)
int(3)
