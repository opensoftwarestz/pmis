<?php
	require('connection.php');
	require('injectionKiller.php');

	if($_SERVER['QUERY_STRING'] == 'logout') {
		session_start();
		logout();
		}

	function login(){
		if (isset($_POST['loginbutton'])) {
		
			require('connection.php');
			
			//authenticate
			$username  = addslashes($_POST['uname']);
			$password  = addslashes($_POST['passwd']);
			//$username  = noInjection($connect, $username);
			//$password  = noInjection($connect, $password);
			
			//alert the user if the username is not filled
			if(empty($username) && !empty($password)){
				$error = urlencode("Enter username");
				header("location:http://".$_SERVER['HTTP_HOST']."/pmis/index.php?error=$error");
				//header("location:index.php?error=$error");
				exit;
				}
			
			//alert the user if the password is not filled
			if(empty($password) && !empty($username)){
				$error = urlencode("Enter password");
				header("location:http://".$_SERVER['HTTP_HOST']."/pmis/index.php?error=$error");
				//header("location:index.php?error=$error");
				exit;
				}
			
			//alert the user if the password and username are not filled
			if(empty($password) && empty($username)){
				$error = urlencode("Enter username and password");
				header("location:http://".$_SERVER['HTTP_HOST']."/pmis/index.php?error=$error");
				exit;
				}
					
			else{
				$password = md5($password);
				$query = "SELECT id, fname, mname, lname FROM users WHERE uname='$username' AND passwd='$password'";
				$result = mysqli_query($connect, $query);
				$result_rows = mysqli_num_rows($result);
				
				//$result_array = mysqli_fetch_array($result, MYSQLI_ASSOC);
				list($id,$fname,$mname,$lname) = mysqli_fetch_array($result, MYSQLI_NUM);
				
				if($result_rows==1){				
					session_start();
					$_SESSION['allow']='yes';
					$_SESSION['username'] = $username;
					$_SESSION['name'] = $fname." ". $mname." ". $lname;
					//$_SESSION['priv'] = $rows['privilege'];
					@header("Location: http://".$_SERVER['HTTP_HOST']."/pmis/frontpage.php");
					exit;
					}
				else{
					$error = urlencode("Enter valid username and/ or password.");
					header("Location: http://".$_SERVER['HTTP_HOST']."/pmis/index.php?error=$error");
					//header("location:index.php?error=$error");
					//Execution of 'if' above will echo make sure you fill all the fields				
					}
				}
			}	
		}
	
	function logout(){
		$_SESSION['allow'] = 'no';
		$_SESSION['username'] = "";
		$message = urlencode("You have successfully logged out!");
		header("Location:http://" . $_SERVER['HTTP_HOST'] . "/police/index.php?info=$message");
		}
	
	login();
	?>
    
