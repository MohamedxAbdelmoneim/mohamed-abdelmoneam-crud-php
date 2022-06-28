<?php

class User{

   

protected $id;
protected $name;
protected $mobile;
protected $password;
protected $address;
protected $email;
protected $createdAt;
protected $updatedAt;
private $tableName = 'users';
private $dbConn;

function setId($id) { $this->id = $id; }
function getId() { return $this->id; }
function setName($name) { $this->name = $name; }
function getName() { return $this->name; }
function setMobile($mobile) { $this->mobile = $mobile; }
function getMobile() { return $this->mobile; }
function setPassword($password) { $this->password = $password; }
function getPassword() { return $this->password; }
function setAddress($address) { $this->address = $address; }
function getAddress() { return $this->address; }
function setEmail($email) { $this->email = $email; }
function getEmail() { return $this->email; }
function setCreatedAt($createdAt) { $this->createdAt = $createdAt; }
function getCreatedAt() { return $this->createdAt; }
function setUpdatedAt($updatedAt) { $this->updatedAt = $updatedAt; }
function getUpdatedAt() { return $this->updatedAt; }




    public function insert(){
        $sql = "INSERT INTO users VALUES(null, :name , :mobile, :password, :address, :email, :createdat, :updatedat)";
        $stmt =  $this->dbConn->prepare($sql);
        // var_dump($stmt);
        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':mobile', $this->mobile);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':createdat', $this->createdAt);
        $stmt->bindParam(':updatedat', $this->updatedAt);

        if($stmt->execute())
        {
            return true;
        }

        else 
        {
            return false;
        }
    }

    
    function __construct()
    {
        // require_once('../AdminLTE-3.2.0/DbConnect.php');
        require_once('../../DbConnect.php');

        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }


    public function update(){
      
        $sql = "UPDATE users SET name=?, mobile=?, password=? , address=? , email=?, created_at=?, updated_at=?  WHERE id=?";
        $stmt= $this->dbConn->prepare($sql);
        $statement =$stmt->execute([$this->name, $this->mobile, $this->password, $this->address,
         $this->email, $this->createdAt, $this->updatedAt,  $this->id]);

        // $stmt->bindParam(':name', $this->name);
        // $stmt->bindParam(':mobile', $this->mobile);
        // $stmt->bindParam(':password', $this->password);
        // $stmt->bindParam(':address', $this->address);
        // $stmt->bindParam(':email', $this->email);
        // $stmt->bindParam(':createdat', $this->createdAt);
        // $stmt->bindParam(':updatedat', $this->updatedAt);
        // $stmt->bindParam(':id', $this->id);
    
        if( $statement)
        {
            return true;
        }

        else 
        {
            return false;
        }
    }


    public function delete(){
      
        $sql = "DELETE FROM users WHERE id=?";
        $stmt= $this->dbConn->prepare($sql);
        $statement =$stmt->execute([ $this->id]);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':mobile', $this->mobile);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':createdat', $this->createdAt);
        $stmt->bindParam(':updatedat', $this->updatedAt);
        $stmt->bindParam(':id', $this->id);
    
        if( $statement)
        {
            return true;
        }

        else 
        {
            return false;
        }
    }


    public function getAllUsers(){
        $stmt= $this->dbConn->prepare("SELECT * FROM $this->tableName");
        $stmt->execute();
        $users= $stmt->fetchAll(PDO::FETCH_ASSOC);
        
 
        return $users;
     }
 
  


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>



        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="../../index.html">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="../../index.html">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link active" href="../order/order.php">Orders</a>
            <a class="nav-item nav-link active" href="../product/product.php">products</a>
            <a class="nav-item nav-link active" href="../category/category.php">Category</a>
            </div>
        </div>
        </nav>






    <div class="container my-5 ">
         <h1 class="my-5 text-center text-danger">Users page</h1>


        <form class="my-5" method="post" action="action.php">

        
            <div class="form-group">
                <label>Name</label>
                <input type="text"  value=" " name="name" class="form-control" id="name" placeholder="Enter Name">
             
            </div>



            
            <div class="form-group">
                <label> Mobile</label>
                <input type="mobile"  name="mobile" class="form-control" id="mobile" placeholder=" Enter Mobile">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder=" Enter Your Password">
            </div>


            <div class="form-group">
                <label>Address </label>
                <input type="text" name="address" class="form-control" id="address" placeholder="Address">
            </div>

       


            <div class="form-group ">
                <label>Email</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
            </div>

            



            


            <input id="insert" name="submit" type="submit" value="insert" class="btn btn-primary" /> 

             <button type="submit" style="display: none;" name="submit" id="update" value="update"  class="btn btn-primary">Update</button>
                
            <button type="submit" style="display: none;" name="submit" id="delete" value="delete"  class="btn btn-primary">Delete</button>
               
            <input type="hidden" name="bid" id="bid" value=""> 

        </form>


            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Password</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    </tr>
                </thead>

                <tbody>
             
                <?php
                
                if(isset($_GET['insert']) && $_GET['insert'] ==1){
                    echo "inserted successfully";
                }

                elseif(isset($_GET['insert']) && $_GET['insert'] ==0){
                    echo "somthing went wrong";
                }
                elseif(isset($_GET['update']) && $_GET['update'] ==1){
                    echo "updated successfully";
                }
                elseif(isset($_GET['update']) && $_GET['update'] ==0){
                    echo "somthing went wrong";
                }
                elseif(isset($_GET['delete']) && $_GET['delete'] ==1){
                    echo "deleted successfully";
                }
                elseif(isset($_GET['delete']) && $_GET['delete'] ==0){
                    echo "somthing went wrong";
                }
               
              //  require_once('user.php');
                $objUser = new User;
                $users= $objUser->getAllUsers();

                foreach($users as $user){
                            
                    // this for update data 
                    $data= json_encode($user, true);


                    echo " <tr class=''>
                              
                             <td>$user[id]</td>
                             <td>$user[name]</td>            
                             <td>$user[mobile]</td>
                             <td>$user[password]</td>       
                             <td>$user[address]</td>      
                             <td>$user[email]</td>       
                             <td>$user[created_at]</td>  
                             <td>$user[updated_at]</td>                                       
                             <td><a href='javascript:updateUser($data)'>Edite</a></td>     
                             <td><a href='javascript:deleteUser($data)'>Delete</a></td>     
                          </tr>";

                }
                
                ?>
                  
                </tbody>

            </table>
</div>


<script type="text/javascript">
       function updateUser(user){
           // document.getElementById("id").value= user.id;
            document.getElementById("name").value= user.name;
            document.getElementById("mobile").value= user.mobile;
            document.getElementById("password").value= user.password;
            document.getElementById("address").value= user.address;
            document.getElementById("email").value= user.email;
            // document.getElementById("created_at").value= user.createdat;
            // document.getElementById("updated_at").value= user.updatedat;
            document.getElementById("insert").style= "display: none";
            document.getElementById("update").style= "display: visible";
       }

       function deleteUser(user){
            document.getElementById("id").value= user.id;
            document.getElementById("name").value= user.name;
            document.getElementById("mobile").value= user.mobile;
            document.getElementById("password").value= user.password;
            document.getElementById("address").value= user.address;
            document.getElementById("email").value= user.email;
           // document.getElementById("createdat").value= user.createdat;
           // document.getElementById("updatedat").value= user.updatedat;
             document.getElementById("insert").style= "display: none";
             document.getElementById("update").style= "display: none";
            document.getElementById("delete").style= "display: visisble";
            
       }
   </script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>