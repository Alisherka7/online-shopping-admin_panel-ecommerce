<?php

	class functions {
		
		function get_random_string($valid_chars, $length) {
			$random_string = "";
			$num_valid_chars = strlen($valid_chars);
			for ($i = 0; $i < $length; $i++) {
				$random_pick = mt_rand(1, $num_valid_chars);
				$random_char = $valid_chars[$random_pick-1];
				$random_string .= $random_char;
			}

			return $random_string;
		}
		
		function sanitize($string) {
			include 'includes/config.php';
			$string = mysqli_escape_string($connect, trim(strip_tags(stripslashes($string))));
			return $string;
		}
		
		function check_integer($which) {
			if(isset($_GET[$which])){
				if (intval($_GET[$which])>0) {
					return intval($_GET[$which]);
				} else {
					return false;
				}
			}
			return false;
		}

		function get_current_page() {
			if(($var=$this->check_integer('page'))) {
				return $var;
			} else {
				return 1;
			}
		}
		
		function get_license() {
			$license = "f783194a-9853-4b6f-bd6e-ce799ce6f2ea";
			return $license;
		}
		
		function doPages($page_size, $thepage, $query_string, $total=0, $keyword) {
			//per page count
			$index_limit = 10;
			
			//set the query string to blank, then later attach it with $query_string
			$query = '';
			
			if( strlen($query_string) > 0) {
				$query = "&amp;".$query_string;
			}
				
			//get the current page number example: 3, 4 etc: see above method description
			$current = $this->get_current_page();
			
			$total_pages = ceil($total / $page_size);
			$start = max($current - intval($index_limit / 2), 1);
			$end = $start + $index_limit - 1;

			echo '<div class="body pull-right">';
			echo '<ul class="pagination">';

			if ($current == 1) {
				echo '<li class="disabled"><a>Prev</a></li>';
			} else {
				$i = $current - 1;
				echo '<li><a href="'.$thepage.'?page='.$i.$query.'&keyword='.$keyword.'" rel="nofollow" title="go to page '.$i.'">Prev</a></li>';
				//echo '<p>...</p>&nbsp;';
			}
				//<button>'.$i.'</button>
			if ($start > 1) {
				$i = 1;
				echo '<li><a href="'.$thepage.'?page='.$i.$query.'&keyword='.$keyword.'" title="go to page '.$i.'">'.$i.'</a></li>';
			}

			for ($i = $start; $i <= $end && $i <= $total_pages; $i++) {
				if ($i == $current) {
					echo '<li class="active"><a>'.$i.'</a></li>';
				} else {
					echo '<li><a href="'.$thepage.'?page='.$i.$query.'&keyword='.$keyword.'" title="go to page '.$i.'">'.$i.'</a></li>';
				}
			}

			if ($total_pages > $end) {
				$i = $total_pages;
				echo '<li><a href="'.$thepage.'?page='.$i.$query.'&keyword='.$keyword.'" title="go to page '.$i.'">'.$i.'</a></li>';
			}

			if ($current < $total_pages) {
				$i = $current + 1;
				//echo '<p>...</p>&nbsp;';
				echo '<li><a href="'.$thepage.'?page='.$i.$query.'&keyword='.$keyword.'" rel="nofollow" title="go to page '.$i.'">Next</a></li>';
			} else {
				echo '<li class="disabled"><a>Next</a></li>';
			}
			
			echo '</ul>';

			//if nothing passed to method or zero, then dont print result, else print the total count below:       
			if ($total != 0) {
				//prints the total result count just below the paging
				echo '<br><div class="pull-right">( total '.$total.' )</div></div>';
			} else {
				echo '</div>';
			};
		 
		}//end of method doPages()

        public static function reArrayFiles(&$file_post) {

            $file_ary = array();
            $file_count = count($file_post['name']);
            $file_keys = array_keys($file_post);

            for ($i=0; $i<$file_count; $i++) {
                foreach ($file_keys as $key) {
                    $file_ary[$i][$key] = $file_post[$key][$i];
                }
            }

            return $file_ary;
        }
			
	}

?>