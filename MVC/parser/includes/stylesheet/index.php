<?php
$new_name = $obj.".bp";
					
					$myfile = fopen($new_name, "w") or die("Unable to open file!");

					$txt = $css_text;
		
					fwrite($myfile, $txt);

					fclose($myfile);	
					
			echo '<link rel="stylesheet" type="text/css" href="'.$new_name.'" />
';
?>