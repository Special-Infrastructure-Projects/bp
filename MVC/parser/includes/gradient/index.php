<?php
	
	$colors = explode(':', $css[$x])[1];
	$first_color = trim(explode(',',$colors)[0]);
	$second_color = trim(str_replace(';','',explode(',',$colors)[1]));
	
		$styles = '
	background: -webkit-linear-gradient('.$first_color.','.$second_color.'); /* Safari 5.1-6.0 */
    background: -o-linear-gradient('.$first_color.','.$second_color.'); /* Opera 11.1-12.0 */ 
    background: -moz-linear-gradient('.$first_color.','.$second_color.'); /* Firefox 3.6-15 */
    background: linear-gradient('.$first_color.','.$second_color.'); /* Standard syntax */
    ';		
    
	array_push($final_css,$styles);
	
	?>