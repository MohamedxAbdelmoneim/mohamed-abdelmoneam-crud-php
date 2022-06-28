<?php
// required to include the book.php here in this file  return error
//the same work include return warning 
require_once('user.php');



class Action{


    function __construct()
    {
     
        switch($_POST['submit'])
        {
            
             case 'insert':

              //var_dump($_POST);
                  $objuser = new User;
                  $objuser->setName($_POST['name']);
                  $objuser->setMobile($_POST['mobile']);
                  $objuser->setPassword($_POST['password']);
                  $objuser->setAddress($_POST['address']); 
                  $objuser->setEmail($_POST['email']);
                  // $objuser->setName($_POST['uname']);
                  $objuser->setCreatedAt(date('Y-m-d H:i:s'));
                  $objuser->setUpdatedAt(date('Y-m-d H:i:s'));

                  if($objuser->insert())
                  {
                       header('location:user.php?insert=1');
                  }
                  else{
                    header('location:user.php?insert=0');
                  }
                break;


                case 'update':
                    $objUser = new User;
                   $objUser->setId($_POST['bid']);
                    $objUser->setName($_POST['name']);
                    $objUser->setMobile($_POST['mobile']);
                    $objUser->setPassword($_POST['password']);
                    $objUser->setAddress($_POST['address']);
                    $objUser->setEmail($_POST['email']);
                    $objUser->setCreatedAt(date('Y-m-d H:i:s'));
                    $objUser->setUpdatedAt(date('Y-m-d H:i:s'));
                   
  
                    if($objUser->update())
                    {
                         header('location:user.php?update=1');
                    }
                    else{
                      header('location:user.php?update=0');
                    }
                  break;

                  case 'delete':
                    $objUser = new User;
                   $objUser->setId($_POST['id']);
                    $objUser->setName($_POST['name']);
                    $objUser->setMobile($_POST['mobile']);
                    $objUser->setPassword($_POST['password']);
                    $objUser->setAddress($_POST['address']);
                    $objUser->setEmail($_POST['email']);
                   $objUser->setCreatedAt(date('Y-m-d H:i:s'));
                   $objUser->setUpdatedAt(date('Y-m-d H:i:s'));
                   
  
                    if($objUser->delete())
                    {
                         header('location:user.php?delete=1');
                    }
                    else{
                      header('location:user.php?delete=0');
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