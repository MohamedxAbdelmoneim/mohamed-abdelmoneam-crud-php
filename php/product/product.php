<?php

class Products{
    protected $id;
    protected $name;
    protected $price;
    protected $description;
    protected $categoryId;
    protected $updatedAt;
    protected $createdAt;
    private $tableName = 'products';
    private $dbConn;

    function setId($id) { $this->id = $id; }
    function getId() { return $this->id; }
    function setName($name) { $this->name = $name; }
    function getName() { return $this->name; }
    function setPrice($price) { $this->price = $price; }
    function getPrice() { return $this->price; }
    function setDescription($description) { $this->description = $description; }
    function getDescription() { return $this->description; }
    function setCategoryId($categoryId) { $this->categoryId = $categoryId; }
    function getCategoryId() { return $this->categoryId; }
    function setUpdatedAt($updatedAt) { $this->updatedAt = $updatedAt; }
    function getUpdatedAt() { return $this->updatedAt; }
    function setCreatedAt($createdAt) { $this->createdAt = $createdAt; }
    function getCreatedAt() { return $this->createdAt; }

    




    public function insert(){
        $sql = "INSERT INTO products VALUES(null, :name , :price, :description, :categoryid, :createdat, :updatedat)";
        $stmt =  $this->dbConn->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':categoryid', $this->categoryId);
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
      
        $sql = "UPDATE products SET name=?, price=?, description=? , category_id=? , created_at=?, updated_at=?  WHERE id=?";
        $stmt= $this->dbConn->prepare($sql);
        $statement =$stmt->execute([$this->name, $this->price, $this->description, $this->categoryId,
         $this->createdAt, $this->updatedAt,  $this->id]);

        $stmt->bindParam(':name', $this->name);     /// returns from class fields 
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':categoryid', $this->categoryId);
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
      
        $sql = "DELETE FROM products WHERE id=?";
        $stmt= $this->dbConn->prepare($sql);
        $statement =$stmt->execute([ $this->id]);

        // use bindparam when we using variables in the sql query
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':categoryid', $this->categoryId);
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


    public function getAllProducts(){
        $stmt= $this->dbConn->prepare("SELECT * FROM $this->tableName");
        $stmt->execute();
        $products= $stmt->fetchAll(PDO::FETCH_ASSOC);
        
 
        return $products;
    }




    public function getAllCategory(){
          $stmt= $this->dbConn->prepare("SELECT * FROM  category");
          $stmt->execute();
          $category= $stmt->fetchAll(PDO::FETCH_ASSOC);

          return $category;
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
      <a class="nav-item nav-link active" href="../order/order.php">Orders</a>
      <a class="nav-item nav-link active" href="../category/category.php">Category</a>
    </div>
  </div>
</nav>







    <div class="container my-5 ">
         <h1 class="my-5 text-center text-danger">Product page</h1>


        <form class="my-5" method="post" action="productaction.php">

        
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
             
            </div>



            
            <div class="form-group">
                <label> price</label>
                <input type="number" name="price" class="form-control" id="price" placeholder=" Enter price">
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" id="description" placeholder=" Enter Your Description">
            </div>


      

       
                <label>Category</label>
                <select class="mb-3 custom-select" name="category" id="category">
                    <?php
                    $product = new Products();
                    $category = $product->getAllCategory();
                    // var_dump($category);
                    if ($category) {
                        // show the publishers
                        foreach ($category as $cat) {?>

                    <option value="<?php echo $cat['id']?>" > <?php echo $cat['name']?></option>
                    
                    <?php		
                        }
                    }
                    
                    ?>


                       


                  
            
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
                    <th scope="col">price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category ID</th>
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
                $objproduct = new Products;
                $products= $objproduct->getAllProducts();

                foreach($products as $product){
                            
                    // this for update data 
                    $data= json_encode($product, true);


                    echo " <tr class=''>
                              
                             <td>$product[id]</td>
                             <td>$product[name]</td>            
                             <td>$product[price]</td>
                             <td>$product[description]</td>       
                             <td>$product[category_id]</td>             
                             <td>$product[created_at]</td>  
                             <td>$product[updated_at]</td>                                       
                             <td><a href='javascript:updateProduct($data)'>Edite</a></td>     
                             <td><a href='javascript:deleteProduct($data)'>Delete</a></td>     
                          </tr>";

                }
                
                ?>
                  
                </tbody>

            </table>


</div>


<script type="text/javascript">
       function updateProduct(product){
          //  document.getElementById("id").value= product.id;
            document.getElementById("name").value= product.name;
            document.getElementById("price").value= product.price;
            document.getElementById("description").value= product.description;
            document.getElementById("category").value= product.category;
         //   document.getElementById("createdat").value= product.createdat;
         //   document.getElementById("updatedat").value= product.updatedat;
            document.getElementById("insert").style= "display: none";
            document.getElementById("update").style= "display: visible";
       }

       function deleteProduct(product){
        //    document.getElementById("id").value= product.id;
            document.getElementById("name").value= product.name;
            document.getElementById("price").value= product.price;
            document.getElementById("description").value= product.description;
            document.getElementById("category").value= product.category;
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