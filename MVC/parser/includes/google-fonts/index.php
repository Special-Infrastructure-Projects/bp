<?php					
					$font = trim(str_replace(";","",str_replace("/",":", explode(":", $css[$x])[1])));
						
						$width = explode("/", $font)[1];
					
						echo '				<link href="https://fonts.googleapis.com/css?family='.$font.'" rel="stylesheet" />';
						
							array_push($final_css,"	font-family:".str_replace("+"," ",explode(":",$font)[0].";
"));
						

						
						?>
					
						