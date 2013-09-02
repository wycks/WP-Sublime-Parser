<?php

	//just load at the way WP does
	include dirname(__FILE__) . '/wp-blog-header.php';
	require_once(ABSPATH . 'wp-admin/includes/admin.php');

	$functions = get_defined_functions();
	
		// set to user, we don't want internal functions
		// sublime stuff
		foreach ($functions['user'] as $func) {

			$wordpressfunctions = new ReflectionFunction($func);	         
			$sublimetab = array();

			$i = 2; //count start at 2! 1 is added for default sublime tab

			foreach ( $wordpressfunctions->getParameters() as $param) {
								
				$tmparg = '';              
				$tmparg.= '$' . $param->getName(); 
				$result = strstr($tmparg, '$');

					if ($result !== false){

						$result       = str_replace(')', '', $result);
						$count        = $i++;

						$sublimetab[] = ' ${' . $count . ':\\' .'\\' . $result . '}';
						$start        = '${1:';
						$end          = '}';			      				       		
					}			
			}
		
			$trigger = '{"trigger": ';
			$content = ' "contents": ';
			$auto    = ');" },';
			
			if(array_key_exists('0', $sublimetab)){
				echo $trigger . '"' . $func .'",' . $content . '"' . $func . '(' . $start . implode(', ', $sublimetab) . $end .' );"},' . '<br>';
			}else{
				echo $trigger . '"' . $func .'",' . $content . '"' . $func  .'(' . implode(', ', $sublimetab)  .');"},' . '<br>';
			}
		}

		//pipe this out to .json to compare with functions and deprected functions
?>