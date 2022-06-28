
<?php


require_once('.././DbConnect.php');





$obj= new DbConnect();

$obj->connect();




class login{

   
	private $tableName = 'users';
	
	
	
	
	
	
	
	
		public function getAllUsers(){
			$stmt= $this->dbConn->prepare("SELECT * FROM $this->tableName");
			$stmt->execute();
			$users= $stmt->fetchAll(PDO::FETCH_ASSOC);
			
	 
			return $users;
		 }


		 public function login($name, $pass){
			
			$allUser= $this->getAllUsers();

		  	foreach($allUser as $user){
                 if($user->name == $name && $user->pass = $pass){
					header('location: index.html');
				 }
				 else{
					header('location: login.php');
				 }
			}
		 }
	 
	  
	
	
	}





?>




<!DOCTYPE html>
<html>
<head>
	<title> Login Form in HTML5 and CSS3</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" a href="./login.css">

</head>
<body>
	<div class="container">
	<img src="./download (1).jpg"/>
		<form method="POST" action="../index.html">
			<div class="form-input">
				<input type="text" name="username" placeholder="Enter the User Name"/>	
			</div>
			<div class="form-input">
				<input type="password" name="password" placeholder="password"/>
			</div>
			<input type="submit" type="submit" value="LOGIN" class="btn-login"/>
		</form>
	</div>
</body>
</html>