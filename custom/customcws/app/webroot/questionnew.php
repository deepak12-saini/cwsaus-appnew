<?php 
$db['hostname'] = 'localhost';
$db['username'] = 'customer_duro';
$db['password'] = 'fI06li!2'; 
$db['database'] = 'customer_durotech';
$link = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);

	// include database connection file.
	require('store_app/config.php' );
	
	isset($_REQUEST['user_id'])? $user_id = $_REQUEST['user_id'] : $user_id = 0;
	isset($_REQUEST['device_id'])? $device_id = $_REQUEST['device_id'] : $device_id = 'nan';
	$sql =  mysqli_query($link,"SELECT * FROM `questions` order by id asc"); 
	$questionArr = array();
	while($fetch = mysqli_fetch_assoc($sql)){	
				
		$useranswer = mysqli_query($link,"SELECT * FROM  `user_answers` where (device_id = '".$device_id."' OR user_id = '".$user_id."')  and  question_id = '".$fetch['id']."'");		
		$answerArr = array();
		
		$rows = mysqli_num_rows($useranswer);
		if($rows > 0){
			$useranswer = mysqli_fetch_assoc($useranswer);
			$answerArr = explode('%%',$useranswer['options']);
		}	
		
		$question['question_id'] = 	$fetch['id'];	
		$question['question_title'] = 	$fetch['title'];		
		$question['question_type'] = 	$fetch['type'];		
		$options = array();		
		$questionsql =  mysqli_query($link,"SELECT * FROM `question_options` where question_id = '".$fetch['id']."'"); 
		while($optionArr = mysqli_fetch_assoc($questionsql)){	
		
			$is_correct = $optionArr['is_correct'];
			
			if($fetch['type'] == 1){
				$option['title'] = $optionArr['title'];
				$option['id'] = $optionArr['id'];
				$option['flag'] = $is_correct;
			
			}else if($fetch['type'] == 3){
				$option['title'] = $optionArr['title'];
				$option['id'] = $optionArr['id'];
				$option['flag'] = $is_correct;
							
			}else if($fetch['type'] == 2){
			
				$option['title'] = $optionArr['title'];
				$option['id'] = $optionArr['id'];
				//$option['type'] = 'true_false';
				if(in_array($optionArr['id'].'_false',$answerArr)){					
					$option['flag'] = 0;					
				}else if(in_array($optionArr['id'].'_true',$answerArr)){
					$option['flag'] = 1;	
				}
			}
		
			$options[] = $option;
		}
	
		$question['option'] = $options;
				
		$questionArr[] = $question;
	}	
	
	echo  json_encode($questionArr);
	
	// echo '<pre>';
	// print_r($questionArr);
	// die();
	
?>
