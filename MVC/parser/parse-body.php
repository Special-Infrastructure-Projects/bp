 <?php

 $total_head = array(" ");
 $file = new SplFileObject("views/body/index.php");

// Loop until we reach the end of the file.
while (!$file->eof()) {
    // Echo one line from the file.
        
		array_push($total_head, $file->fgets());
		
}

// Unset the file to call __destruct(), closing the file handle.
$file = null;

	for($x = 0; $x <= sizeof($total_head); $x++) {

		if (strpos($total_head[$x], '<@=') !== false) {
		
				parser($total_head[$x]);
				
		}
		else {
			
			print_r($total_head[$x]);
			
		}
	}
	
	function parser($obj){
		//<@= ajax_link: 'test', 'example', 'test.html' @>
		$type = trim(strip_tags(str_replace(" @>", "", str_replace("<@=","", explode(":", $obj)[0]))));

		$text = trim(strip_tags(str_replace("'","",explode(",",str_replace(" @>", "", str_replace("<@=","", explode(":", $obj)[1])))[0])));
		
		$target = trim(strip_tags(str_replace("'","",explode(",",str_replace(" @>", "", str_replace("<@=","", explode(":", $obj)[1])))[1])));
		
		$url = trim(strip_tags(str_replace("'","",explode(",",str_replace(" @>", "", str_replace("<@=","", explode(":", $obj)[1])))[2])));		
		
		if($type === 'ajax_link'){
		
		
		
		

		
		echo "
			<a href='#' onclick='ajaxLoad".$target."()'>".$text."</a>
		
		
		
				<script type='text/javascript'>
				
					function ajaxLoad".$target."(){
						
						var xhttp = new XMLHttpRequest();
  
							xhttp.onreadystatechange = function() {
   
								if (this.readyState == 4 && this.status == 200) {
     
									document.getElementById('".$target."').innerHTML = this.responseText;
		
								}
 
							};
 
						xhttp.open('GET', '".$url."', true);
  
						xhttp.send();						
						
					}
				
				</script>
		
		";
		
	}
		if($type === 'taggable_input'){
			
			echo "<input contenteditable='true' aria-label='taggable' onkeypress='taggable(event,this)' style='width:200px; height:40px; background:#fff; border:1px solid #000; float:left;'>";
			
			echo"
				<script type='text/javascript'>
				
					function taggable(ev,obj){
						
						if(ev.keyCode === 13){
							
							var text = obj.value.split(' ');
							
						}
						
						for(i = 0; i < text.length; i++){
							
							if(text[i].indexOf('#') > -1){
								
								
								
							}
							
						}
						
						
					}
				
				</script>";
			
		}
	
	
	
		if($type === 'autocomplete_input'){
			
			
				
				$instructions = explode(':', $obj)[1];
				
				$i_instructions = explode(',',$instructions);
			
					$controller = trim(str_replace("'","",explode('=>',$i_instructions[0])[1]));
					
					$id = trim(str_replace("'","",explode('=>',$i_instructions[1])[1]));

					$style = str_replace('@>','',trim(str_replace("'","",explode('=>',$i_instructions[2])[1])));
					
					echo '<input type="text" id="'.$id.'" onkeypress="autoxcomplete_'.$id.'(this)">
						  <div id="result_'.$id.'"></div>
					';
			
					echo '<script type="text/javascript">
					
							function autoxcomplete_'.$id.'(obj){
							
								var inp = obj.value;
								
 								var xhttp = new XMLHttpRequest();
  									
  									xhttp.onreadystatechange = function() {
   
   										 if (this.readyState == 4 && this.status == 200) {
     
     								document.getElementById("result_'.$id.'").innerHTML = this.responseText;
    
    								}
  
  								};
  								
  						xhttp.open("GET", "autocomplete/new_autocomplete.php?input_value="+inp, true);
  
  						xhttp.send();								
							
							}
							</script>';
							
							$row = explode('@',file_get_contents('controllers/autocomplete.bp'));
							$db_name = explode(':',$row[1])[1];
							$tb_name = trim(explode(':',$row[2])[1]);
							$f_column = trim(explode(':',$row[3])[1]);
							$f_link = trim(explode(':',$row[4])[1]);
							$f_body = trim(explode('=>',(explode(':',$row[5])[1]))[0]);
							$f_len = trim(explode('=>',(explode(':',$row[5])[1]))[1]);											
							mkdir("autocomplete");
							
		$myfile = fopen("autocomplete/new_autocomplete.php", "w") or die("Unable to open file!");

		$txt = file_get_contents('config/db_config.php') . '
		<?php
		
		$input_value = $_GET["input_value"];
		
		$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM '.$tb_name.' WHERE '.$f_column.' LIKE '."'%".'$input_value'."%'".' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       
       echo "<a href='.$f_link.'>";
       echo $row["'.$f_column.'"];
       echo "</a><br>";
       echo        substr($row["'.$f_body.'"],0,'.$f_len.')."...";
       echo "<br>";
       
    }
} else {
    echo "0 results";
}
$conn->close();
?>';

		fwrite($myfile, $txt);



		fclose($myfile);							
							
							
							
		}
	
	
	}
	
	
		
	
		
?>