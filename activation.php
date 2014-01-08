<?php
    session_start();
    $page_title = 'activation';
    
    
    
    if(!isset($_SESSION['memberId'])){
        header("Location: sign_up.php");
    }
    
    
    //include header section
    include 'v-templates/header.php';
     
    
        if($_SERVER['REQUEST_METHOD'] == 'GET' && count($GLOBALS['_GET'])>2)
            {
               $activate = $_GET['activated'];
               $mid = $_GET['mid'];
               $email_id = $_GET['mail'];
               
               $userActivated = $manageContent->activateUser($mid,$email_id);
               
            }
           
            $activatedUser = $manageContent->checkActivation($_SESSION['memberId']);
       
    
    
    
?>
<style type="text/css">
    .activation-result {
        height: 500px;
        margin-top: 12%;
        margin-left: 4%;
    }
    
    
</style>

<div class="row-fluid">
    <div class="span12">
        <div class="activation-result">
            <?php
            
            
            if(!isset($userActivated)){
                if($activatedUser[0]['membership_validiation'] != 1){
                    echo '<h1>Your are not activated Please check your email for activation link or ask system provider in case of you dont get the link</h1>';
                    echo $activatedUser['membership_validiation'];
                }
                else if($activatedUser[0]['membership_validiation'] == 1){
                     echo '<h1>You are Already Activated</h1>';
                }
            }
            
            if(isset($userActivated)){
                if($userActivated == 1){
                        echo '<h1>You have been activated and now you can go and buy products</h1>';
                     }
    
                else if($userActivated == 0){
                      echo '<h1>Please contact service provider to get the link again</h1>';   
                }
            }
            
            
            
            ?>
            <a href="editProfile.php"><button class="btn btn-primary pull-right">Edit Your Account</button></a>
        </div>
        
    </div>
</div>





















<?php
    //include footer section
    include 'v-templates/footer.php';
?> 