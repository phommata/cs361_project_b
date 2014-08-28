<?php
ini_set('display_errors', 'On');
/********************************************************/
/*  (include)  */
/********************************************************/
$mypassword = "RdNAmTfkrFADuWx1";
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "osterbit-db", $mypassword, "osterbit-db");
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }


/********************************************************/
/*  test_defn  */
/********************************************************/
function test_acct_already_exists($mysqli){
  $test_name="test_add_acct";
  $expected_outcome= "'sampleuser1' is unavailable";
  //ensure that the userName_available function is working
  //we know that username 'sampleuser1' is already taken

  //define test
  $test = !(userName_available("sampleuser1", $mysqli));
  if ($test) {
    $actual = "true";
  }
  else {
    $actual = "false";
  }

  
  echo "<b>".$test_name."</b>: expectation  '".$expected_outcome."' is <b><i>".$actual."</i></b>";
}
/********************************************************/
/*  function/functionality being tested  */
/********************************************************/
function userName_available($test_name, $mysqli){

  //if ($mysqli->connect_errno){ echo "<script>alert('Failed to connect to MySQL (".$mysqli->connect_errno.") ".$mysqli->connect_error."')</script>";}
  $dbquery= "SELECT username FROM usr_db WHERE username='".$test_name."'";
  //db query: prepare->execute->bind->evaluate
  //prepare
  if (!($stmt = $mysqli->prepare($dbquery))) { echo "Falied to prepare query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
  //execute
  if (!$stmt->execute()) {echo "Falied to execute query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
  //bind
  $db_usr = NULL;
  if (!($stmt->bind_result($db_usr))) {echo "Falied to bind parameters (".$mysqli->connect_errno.") </p>".$mysqli->connect_error;}
  //evaluate
  $result=0;
  $db_temp = NULL;
  while ($stmt->fetch()) {
    $result += 1;
    $db_temp = $db_usr;
  }
  $stmt->close();
  if ($db_temp) {
    return 0;
  }
  else 
    return 1;
}
/********************************************************/
/*  RUN TEST */
/********************************************************/
test_acct_already_exists($mysqli);

/********************************************************/
?>
