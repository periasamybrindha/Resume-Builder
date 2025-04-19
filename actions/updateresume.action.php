
<?php
//session_start();
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


//print_r($_POST);
if($_POST){
    $post=$_POST;

 
    echo "<pre>";
    print_r($_POST);
    //die();

    
    if($post['id'] && $post['slug'] && $post['full_name'] && $post['email_id'] && $post['objective'] && $post['mobile_no'] && $post['dob'] && $post['religion'] && 
    $post['nationality'] && $post['marital_status'] && $post['hobbies'] && $post['languages'] && $post['address']){


        $columns="";
        $values="";

        $post2= $post;
        unset($post2['id']);
        unset($post2['slug']);

        foreach($post2 as $index =>$value){
            $$index = $db->real_escape_string($value);
            $columns.=$index."='$value',";
           // $values.="'$value',";
        }


        $columns.='updated_at='.time();
        
       
        

        try{

            $query = "UPDATE resumes SET " ;
            $query.="$columns ";
            $query.="WHERE id={$post['id']} AND slug='{$post['slug']}'";


            
            $db-> query($query);
            //die();
            $fn -> setAlert('resume updated !');
            $fn->redirect('../updateresume.php?resume=' .$post['slug']);
 die();
        }catch(Exception $error){
            $fn -> setError($error ->getMessage());
            $fn->redirect('../updateresume.php?resume=' .$post['slug']);
        }




    }else{
        $fn -> setError('please fill the form');
        $fn->redirect('../updateresume.php?resume=' .$post['slug']);  
    }


}else{
    $fn->redirect('../updateresume.php?resume=' .$post['slug']);
    
}