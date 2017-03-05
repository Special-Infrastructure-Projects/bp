
 <?php

 $total_head = array(" ");
 $file = new SplFileObject("views/head/index.php");

// Loop until we reach the end of the file.
		while (!$file->eof()) {
    // Echo one line from the file.
        
			array_push($total_head, $file->fgets());
		
		}

// Unset the file to call __destruct(), closing the file handle.
 $file = null;

	for($x = 0; $x <= sizeof($total_head); $x++) {

		if (strpos($total_head[$x], '<@=') !== false) {
		
				parse($total_head[$x]);
	
		}
		else {
			
			print_r($total_head[$x]);
			
		}
	}
	function parse($obj){
		
		$words = explode(" ", $obj);
		
		$words_length = sizeof($words);
			
			if($words[1] === 'include'){
				
				if($words[2] === 'css'){
					
					parseCSS($words[3]);
					
			}
	
		}
			
	}
	
		function parseCSS($obj){
			
		$xyz = 0;
		
		$file = new SplFileObject($obj);

		$css = array();
		
			while (!$file->eof()) {
			
				array_push($css, $file->fgets());
				
			}

		$file = null;

			$final_css = array();
		
				for($x = 0; $x < sizeof($css); $x++){

//MAKE INTO A CIRCLE				
					if (strpos($css[$x],'circle:true') !== false) {
					
						include('includes/circle/index.php');						
						
					}
//MAKE INTO A CIRCLE				
					if (strpos($css[$x],'gradient') !== false) {
					
						include('includes/gradient/index.php');						
						
					}
//MAKE FULL SCREEN					
					if (strpos($css[$x],'fullscreen:true') !== false) {
					
						include('includes/full-screen/index.php');

					
					}
//SELECT INDIVIDUAL ELEMENTS BASED ON TAG NAME					
					if (strpos($css[$x],'[') !== false) {
						
						include('includes/uniques/index.php');
					
					}
				
//MOBILE VIEWPORT SCALE						
					if (strpos($css[$x],'mobile:true') !== false) {
											
						include('includes/mobile/index.php');

					}
//GOOGLE FONTS INCLUDER
					if (strpos($css[$x],'google-font') !== false) {
					
						include('includes/google-fonts/index.php');
					}
					else {
						
						    array_push($final_css, $css[$x]);
						$css_text = str_replace("\n","",trim(str_replace("circle:true;", "", implode(" ",$final_css))));
					}
				}
//CREATE THE BLUEPRINT STYLESHEET				
				if(file_exists("blueprint_".$obj)== true){
						
					
				}
				else {
					
						include('includes/stylesheet/index.php');
					
				}

	}
	
?>