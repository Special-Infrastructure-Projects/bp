<?php
$target = str_replace("#","",explode(" ", $css[$x])[0]);
						$tag = explode(" ", $css[$x])[1];
						$number = explode(" ", $css[$x])[2];
						
						$instructions = trim(str_replace(" ","",str_replace("\n","",str_replace(";", "','", str_replace("\t","", str_replace("}","", explode("{", $css[$x])[1]))))));
						
						if($target != 'body'){
							$parent = "document.getElementById('".$target."')";
						}
						else {
							$parent = "document.getElementsByTagName('body')[0]";
						}
					
						$func = "
								setTimeout(function(){
								var targ".$target." = $parent.getElementsByTagName('".$tag."')".$number.";
								var inst".$target." = ['".$instructions."'];

								var vIns".$target." = [];
								var vT".$target." = [];
								
									for(i = 0; i < inst".$target.".length; i++){
										
										vIns".$target.".push(inst".$target."[i].split(':')[0]);
										
									}
							
									for(i = 0; i < vIns".$target.".length; i++){
									
										vT".$target.".push(inst".$target."[i].split(':')[1]);
									
									}
							
								
									for(i = 0; i < vIns".$target.".length; i++){
										
										
										
										targ".$target.".style[vIns".$target."[i]] = vT".$target."[i];
									}
								
								},1);
								 
								
									
						";
						
						if(file_exists("js/uniques.js.bp")){
	
					$new_name = "js/uniques.js.bp";
					
					$myfile = fopen($new_name, "a") or die("Unable to open file!");

					$txt = $func;
					
					$cFile = file_get_contents("js/uniques.js.bp");
					if (strpos($cFile,$func) !== false) {
						
					}
					else {
					
					fwrite($myfile, $txt);
					}
					fclose($myfile);
					
						if($xyz === 0){
					echo '				<script type="text/javascript" src="js/uniques.js.bp"></script>
';							

						$xyz = 1;
					
						}
						}
						else {
					$new_name = "js/uniques.js.bp";
					
					$myfile = fopen($new_name, "w") or die("Unable to open file!");

					$txt = $func;
		
					fwrite($myfile, $txt);

					fclose($myfile);	
					
					
						if($xyz === 0){
				
					echo '				<script type="text/javascript" src="js/uniques.js.bp"></script>';					
						$xyz = 1;
						}						
					
					}
						
						
						?>