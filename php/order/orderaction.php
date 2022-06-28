<?php
// required to include the book.php here in this file  return error
//the same work include return warning 
require_once('order.php');



class Action{


    function __construct()
    {
     
        switch($_POST['submit'])
        {
            
             case 'insert':

              //var_dump($_POST);
                  $objorder = new Orders;
                  $objorder->setQuantity($_POST['quantity']);
                  $objorder->setProductId($_POST['product_id']);
                  $objorder->setUserId($_POST['user_id']);          
                  $objorder->setCreatedAt(date('Y-m-d H:i:s'));
                  $objorder->setUpdatedAt(date('Y-m-d H:i:s'));

                  if($objorder->insert())
                  {
                       header('location:order.php?insert=1');
                  }
                  else{
                    header('location:order.php?insert=0');
                  }
                break;





                case 'update':
                    $objorder = new Orders;
                    $objorder->setQuantity($_POST['quantity']);
                    $objorder->setProductId($_POST['product_id']);
                    $objorder->setUserId($_POST['user_id']);      
                    $objorder->setCreatedAt('created_at');
                    $objorder->setUpdatedAt('updated_at');
                   
  
                    if($objorder->update())
                    {
                         header('location:order.php?update=1');
                    }
                    else{
                      header('location:order.php?update=0');
                    }
                  break;

                  case 'delete':
                    $objorder = new Orders;
                    $objorder->setQuantity($_POST['quantity']);
                    $objorder->setProductId($_POST['product_id']);
                    $objorder->setUserId($_POST['user_id']);    
                   $objorder->setCreatedAt('created_at');
                   $objorder->setUpdatedAt('updated_at');
  
                    if($objorder->delete())
                    {
                         header('location:order.php?delete=1');
                    }
                    else{
                      header('location:order.php?delete=0');
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