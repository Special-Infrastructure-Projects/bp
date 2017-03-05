<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "autocomplete";
?>
		<?php
		
		$input_value = $_GET["input_value"];
		
		$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM articles WHERE article_title LIKE '%$input_value%' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       
       echo "<a href=test.html>";
       echo $row["article_title"];
       echo "</a><br>";
       echo        substr($row["article_body"],0,100)."...";
       echo "<br>";
       
    }
} else {
    echo "0 results";
}
$conn->close();
?>