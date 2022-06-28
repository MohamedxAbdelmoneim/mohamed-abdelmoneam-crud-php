<?php
// required to include the book.php here in this file  return error
//the same work include return warning 
require_once('category.php');



class Action{


    function __construct()
    {
     
        switch($_POST['submit'])
        {
            
             case 'insert':

              //var_dump($_POST);
                  $objcat = new Category;
                  $objcat->setName($_POST['name']);
                  $objcat->setDescription($_POST['description']);
                  // $objuser->setName($_POST['uname']);
                  $objcat->setCreatedAt(date('Y-m-d H:i:s'));
                  $objcat->setUpdatedAt(date('Y-m-d H:i:s'));

                  if($objcat->insert())
                  {
                       header('location:category.php?insert=1');
                  }
                  else{
                    header('location:category.php?insert=0');
                  }
                break;


                case 'update':
                    $objcat = new Category;
                    $objcat->setName($_POST['name']);
                    $objcat->setDescription($_POST['description']);
                    $objcat->setCreatedAt($_POST['createdat']);
                    $objcat->setUpdatedAt($_POST['updatedat']);
                   
  
                    if($objcat->update())
                    {
                         header('location:category.php?update=1');
                    }
                    else{
                      header('location:category.php?update=0');
                    }
                  break;

                  case 'delete':
                  // $objcat->setId($_POST['bid']);
                   $objcat = new Category;
                   $objcat->setName($_POST['name']);
                   $objcat->setDescription($_POST['description']);
                   // $objUser->setCreatedAt($_POST['createdat']);
                   // $objUser->setUpdatedAt($_POST['updatedat']);
                   
  
                    if($objcat->delete())
                    {
                         header('location:category.php?delete=1');
                    }
                    else{
                      header('location:category.php?delete=0');
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