<?php

//require_once('../product/product.php');
//require_once('../product/product.php');
//require_once('./user/user.php');

class Orders{
 
  

    protected $id;
    protected $quantity;
    protected $productId;
    protected $userId;
    protected $createdAt;
    protected $updatedAt;
    private $tableName = 'orders';
    private $dbConn;
    
    function setId($id) { $this->id = $id; }
    function getId() { return $this->id; }
    function setQuantity($quantity) { $this->quantity = $quantity; }
    function getQuantity() { return $this->quantity; }
    function setProductId($productId) { $this->productId = $productId; }
    function getProductId() { return $this->productId; }
    function setUserId($userId) { $this->userId = $userId; }
    function getUserId() { return $this->userId; }
    function setCreatedAt($createdAt) { $this->createdAt = $createdAt; }
    function getCreatedAt() { return $this->createdAt; }
    function setUpdatedAt($updatedAt) { $this->updatedAt = $updatedAt; }
    function getUpdatedAt() { return $this->updatedAt; }
    



 

    public function insert(){
        $sql = "INSERT INTO orders VALUES(null, :quantity , :productId, :userId, :createdat, :updatedat)";
        $stmt =  $this->dbConn->prepare($sql);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':productId', $this->productId);
        $stmt->bindParam(':userId', $this->userId);
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
        
        require_once('../../DbConnect.php');

        $db = new DbConnect();
        $this->dbConn = $db->connect();
    }


    public function update(){
      
        $sql = "UPDATE orders SET quantity=?, productId=?, userId=?  , createdat=?, updatedat  WHERE id=?";
        $stmt= $this->dbConn->prepare($sql);
        $statement =$stmt->execute([$this->quantity, $this->productId, $this->userId,
         $this->createdAt, $this->updatedAt,  $this->id]);

        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':productId', $this->productId);
        $stmt->bindParam(':userId', $this->userId);
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


    public function delete(){
      
        $sql = "DELETE FROM orders WHERE id=?";
        $stmt= $this->dbConn->prepare($sql);
        $statement =$stmt->execute([ $this->id]);

        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':productId', $this->productId);
        $stmt->bindParam(':userId', $this->userId);
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




    public function getAllOrders(){
        $stmt= $this->dbConn->prepare("SELECT * FROM $this->tableName");
        $stmt->execute();
        $orders= $stmt->fetchAll(PDO::FETCH_ASSOC);
        
 
        return $orders;
    }



    public function getAllProduct(){
          $stmt= $this->dbConn->prepare("SELECT * FROM  products");
          $stmt->execute();
          $Products= $stmt->fetchAll(PDO::FETCH_ASSOC);

          return $Products;
     }

    public function getAllUser(){
        $stmt= $this->dbConn->prepare("SELECT * FROM  users");
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
      <a class="nav-item nav-link active" href="../user/user.php">Users</a>
      <a class="nav-item nav-link active" href="../product/product.php">products</a>
      <a class="nav-item nav-link active" href="../category/category.php">Category</a>
    </div>
  </div>
</nav>


    <div class="container my-5 ">
         <h1 class="my-5 text-center text-danger">Order page</h1>


        <form class="my-5" method="post" action="orderaction.php">

        
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter Quantity">
             
            </div>
       
            
                <label>Product</label>
                <select class="custom-select" name="product_id" id="product">
                    <?php
                    $orders = new Orders();
                    $product = $orders->getAllProduct();
                    // var_dump($category);
                    if ($product) {
                        // show the publishers
                        foreach ($product as $pro) {?>

                    <option value="<?php echo $pro['id']?>" > <?php echo $pro['name']?></option>
                    
                    <?php	

                        }
                    }

                    ?>

                </select>

                        <label>User</label>
                         <select class=" mb-2 custom-select" name="user_id" id="user">
                    
                    <?php
                    $orders = new Orders();
                    $user = $orders->getAllUser();
                    // var_dump($category);
                    if ($user) {
                        // show the publishers
                        foreach ($user as $use) {?>

                    <option value="<?php echo $use['id']?>" > <?php echo $use['name']?></option>
                    
                    <?php		
                        }
                    }
                    

                    ?>

                  </select>

                  
                       


                  
            
                    <input id="insert" name="submit" type="submit" value="insert" class="btn btn-primary" /> 

                    <button type="submit" style="display: none;" name="submit" id="update" value="update"  class="btn btn-primary">Update</button>

                    <button type="submit" style="display: none;" name="submit" id="delete" value="delete"  class="btn btn-primary">Delete</button>

                    <input type="hidden" name="bid" id="bid" value=""> 
                

            

        </form>


            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">product ID</th>
                    <th scope="col">User ID</th>
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
                $objorder = new Orders;
                $objorder= $objorder->getAllOrders();

                foreach($orders as $order){
                            
                    // this for update data 
                    $data= json_encode($order, true);


                    echo " <tr class=''>
                              
                             <td>$Order[id]</td>
                             <td>$Order[quantity]</td>            
                             <td>$Order[productId]</td>
                             <td>$Order[userId]</td>                   
                             <td>$Order[created_at]</td>  
                             <td>$Order[updated_at]</td>                                       
                             <td><a href='javascript:updateProduct($data)'>Edite</a></td>     
                             <td><a href='javascript:deleteProduct($data)'>Delete</a></td>     
                          </tr>";

                }
                
                ?>
                  
                </tbody>

            </table>


</div>


<script type="text/javascript">
       function updateProduct(order){
          
            document.getElementById("quantity").value= order.quntity;
            document.getElementById("price").value= order.productId;
            document.getElementById("description").value= order.userId;
         // orderdocument.getElementById("createdat").value= product.createdat;
         // document.getElementById("updatedat").value= product.updatedat;
            document.getElementById("insert").style= "display: none";
            document.getElementById("update").style= "display: visible";
       }

       function deleteProduct(product){
        //    document.getElementById("id").value= product.id;
            document.getElementById("quantity").value= order.quntity;
            document.getElementById("price").value= order.productId;
            document.getElementById("description").value= order.userId;
          //  document.getElementById("createdat").value= product.createdat;
         //   document.getElementById("updatedat").value= product.updatedat;
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