<?php

    session_start();

    require_once("dbcon.php");

    if (isAjax()) {
    
    	$data = array();
    	$username = cleanInput($_POST['userid']);
    	
    	if (checkVar($username)) {
    	
    		$getUsers = "SELECT *
    					 FROM chat_users
    					 WHERE username = '$username'";
    					 
    		if (!hasData($getUsers)) {
    		  $data['result'] = "<div class='message success'>OK! El nombre que coloco esta disponible</div>";
    		  $data['inuse'] = "notinuse";
    		} else {
    		  $data['result'] = "<div class='message warning'>El nombre que coloco esta siendo usado por otra persona. (Usernames take 2 minutes without use to expire)</div>";
    		  $data['inuse'] = "inuse";
    		}
    		
    		echo json_encode($data);
    			
    	}
    	
    } else {
    
        $username = cleanInput($_POST['userid']);
        
    	if (checkVar($username)) {
    	
    		$getUsers = "SELECT *
    					 FROM chat_users
    					 WHERE username = '$username'";
    		
    		if (!hasData($getUsers)) {
    		
    			$now = time();
    		
    		    $postUsers = "INSERT INTO `chat_users` (
    					`id` ,
    					`username` ,
    					`status` ,
    					`time_mod`
    					)
    					VALUES (
    					NULL , '$username', '1', '$now'
    					)";
    					
    		    mysql_query($postUsers);
    		    			
    			$_SESSION['userid'] = $username;
    		
    		    header('Location: chatrooms.php');
    	
    		} else {
    			
    		  header('Location: ?error=1');
    			
    		}
    
    	}
    
    }

?>