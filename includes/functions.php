 <?php 

 	function redirect_to($new_location = NULL){

 		if( $new_location != null ){
 			header("Location: " . $new_location);
 			exit;
 		}
 	}
 		
 		function strip_zeros_from_date($marked_string= ""){
 			//first remove the marked zeros
 			$no_zeros = str_replace("0", " ", $marked_string);
 			//then remove any remaining marks
 			$cleaned_string = str_replace("*", "", $no_zeros);

 			return $cleaned_string;
 		}

 		function __autoload($class_name){
 			$class_name = strtolower($class_name);
 			$path = LIB_PATH.DS."{$class_name}.php";

 			if( file_exists($path) ){
 				require_once($path);
 			}else {
 				die("Could not find class: " . $class_name);
 			}
 		}

 		function output_message($message=""){
 			if( !empty($message) ){
 				return "<p class=\"message\" > {$message} </p> ";
 			} else {
 				return "";
 			}
 		}

 		function log_action($action, $message = "" ){
 			$logfile = "log.txt";
 			$new = file_exists($logfile) ? false : true;
 			if( $handle = fopen($logfile, 'a')){
 				$timestamp = strftime('%d/%m/%Y %H:%M:%S', time());
 				$content = "{$timestamp} | {$action}: {$message}\n";
 				fwrite($handle,$content);
 				fclose($handle);
 				if($new) {chmod($logfile,07555); }
 			} else {
 				echo "Could not open file for writing";
 			}	
 		}

 		function datetime_to_text($datetime=""){
 			$unixdatetime = strtotime($datetime);
 			return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
 		}
 		
 ?>