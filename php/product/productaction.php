<?php
// required to include the book.php here in this file  return error
//the same work include return warning 
require_once('product.php');



class Action{


    function __construct()
    {
     
        switch($_POST['submit'])
        {
            
             case 'insert':

              //var_dump($_POST);
                  $objpro = new Products;

                  //  ($_POST['name'])  from names of my form i maked it 
                  $objpro->setName($_POST['name']);
                  $objpro->setPrice($_POST['price']);
                  $objpro->setDescription($_POST['description']);
                  $objpro->setCategoryId($_POST['category']);           
                  $objpro->setCreatedAt(date('Y-m-d H:i:s'));
                  $objpro->setUpdatedAt(date('Y-m-d H:i:s'));

                  if($objpro->insert())
                  {
                       header('location:product.php?insert=1');
                  }
                  else{
                    header('location:product.php?insert=0');
                  }
                break;


                case 'update':
                    $objpro = new Products;
                   // $objpro->setId($_POST['id']);
                    $objpro->setName($_POST['name']);
                    $objpro->setPrice($_POST['price']);
                    $objpro->setDescription($_POST['description']);
                    $objpro->setCategoryId($_POST['category']); 
                    $objpro->setCreatedAt('created_at');
                    $objpro->setUpdatedAt('updated_at');
                   
  
                    if($objpro->update())
                    {
                         header('location:product.php?update=1');
                    }
                    else{
                      header('location:product.php?update=0');
                    }
                  break;

                  case 'delete':
                    $objpro = new Products;
                  // $objpro->setId($_POST['id']);
                    $objpro->setName($_POST['name']);
                    $objpro->setPrice($_POST['price']);
                    $objpro->setDescription($_POST['description']);
                   // $objpro->setCategoryId($_POST['category_id']); 
                   $objpro->setCreatedAt('created_at');
                   $objpro->setUpdatedAt('updated_at');
  
                    if($objpro->delete())
                    {
                         header('location:product.php?delete=1');
                    }
                    else{
                      header('location:product.php?delete=0');
                    }
                  break;


   
                default:
                    header('location:index.html');
                break;
        }
    }
}




if(isset($_POST['submit']))
{
     $objAct = new Action();
}

else{
    header('location:index.html');
}

?>