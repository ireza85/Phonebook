<?php
$servername = "localhost";
$database = "phones";
$username = "admin";
$password = "admin";

$conn = mysqli_connect($servername, $username, $password, $database);
$rv = mysqli_select_db($conn, "phones");
$sql = "TRUNCATE users;";
$query = mysqli_query($conn,$sql);

$xml_file = "contact.xml";

if (file_exists($xml_file)) {
  $xml = simplexml_load_file($xml_file);
  $i=0;
  foreach ($xml->xpath("//root/root_contact/contact") as $segment) {
    $row = $segment->attributes();
    $sql = "insert into users (name, phone, department) values('".$row["display_name"]."', '".$row["office_number"]."', '".$row["group_id_name"]."');";
if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
  }

}

mysqli_close($conn);
?>