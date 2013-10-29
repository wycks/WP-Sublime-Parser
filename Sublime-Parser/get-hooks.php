<?php

	//get all ze hooks

	$Directory = new RecursiveDirectoryIterator('D:\Sites\3.6');
	$Iterator  = new RecursiveIteratorIterator($Directory);
	$regex     = new RegexIterator($Iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

		foreach ( $regex as $filename=>$file) {

			$content = file_get_contents($file[0]);
			$ext     = pathinfo($filename, PATHINFO_BASENAME);

			//get all
			preg_match_all("/apply_filters.*?;|do_action.*?;|add_action.*?;|apply_filters_ref_array.*?;|do_action_ref_array.*?;/", $content, $applyfilter);

			foreach($applyfilter as $filtermatch) {

				// we can get the filename and show each filter per file
				//echo '<b>' . $ext . '</b><br>';

				//this is all some what wonky and should be refactored
				$out = implode($filtermatch);

				//get filters which end in ;
				$seperate = preg_split("/;/", $out );

				foreach ($seperate as $filter) {

					$gethooks = preg_split ("/[\s,]+/", $filter);
					$out2 = implode($gethooks);

					//remove brackets
					preg_match_all("/'.*?\)/",  $out2, $filterbracket);

					foreach ($filterbracket as $value) {

						$o = implode($value);

						// trim junk like extra apostrophes
						$trimmed = trim($o, "''");

						if ($trimmed != ''){

						//get just filter name	(sumblime needs it duplicated..)
						preg_match_all("/^[^']*/", $trimmed, $out3);
						preg_match_all("/^[^']*/", $trimmed, $out4);

						$firstpart  = $out3[0][0];
						$secondpart = $out4[0][0] ;

						//sublime stuff
						$trigger = '{"trigger": ';
						$content = '"contents": ';
						$auto    = ');" },';

						echo $trigger . '"' . $firstpart . '", ' . $content . '"'. $secondpart . '" },' . '<br>';
					}

				}

			}

		}

	}
?>