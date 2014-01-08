<?php
    $pageTitle = "Members List";
    //get header
    include('v-templates/header.php');
    //include sidebar
    include('v-templates/sidebar.php');
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(!empty($_GET)){
            $pageName = $_GET['pageName'];
            $pageDetails = $manageData->getPageValue($_GET['pageName']);   
            
        }
        
    }
    
?>

<!--container for content of the website-->
    <div class="span9" id="content_container">
        <blockquote>
            <p>Members List</p>
            <small>
                <cite title="Source Title">List of members of your website.</cite>
            </small>
        </blockquote>
        <div class="form-horizontal">
            <form action="" method="post">
                <div class="form-control v-form">
                    <div class="alert alert-success fade in" style="display: none">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Your Page has been updated and the please check the link at list page section.
                    </div>
                    <label class="control-label">Name of your Page</label>
                    <input type="text" id="pageName" value="<?php if(isset($pageDetails)){echo $pageDetails[0]['name'];}?>" class="textbox1" name="category" disabled="disabled"/>
                </div>
                
                <div class="form-control v-form">
                    <label class="control-label">Enter the content</label><br><br>
                    <textarea type="text" id="editor1" placeholder="Description" class="textbox1 textarea" name="description"><?php if(isset($pageDetails)){echo $pageDetails[0]['content'];}?></textarea>
                </div>   
                 
                <div class="form-control v-form">
                    <div class="function_result"></div>
                    <button type="button" value="SUBMIT" id="createPage" data-loading-text="Updating Page..." class="btn btn-large btn-inverse btn1">Update Page</button>
                    <div class="clearfix"></div>
                </div>
            </form>
            
            
        </div>
        <!-- form horizonatal ends here -->               
        
    </div>
</div>


<?php
    //get footer
    include('v-templates/footer.php');
?>
<script type="text/javascript">
$(document).ready(function(){    
    $('#createPage').click(function(){
        var pageName = $('#pageName').val();
        var pageContent = CKEDITOR.instances.editor1.getData();
        
        
        
        data = 'pageName='+pageName+'&pageContent='+pageContent+'&update=true';
        $.ajax({
                    type: "POST",
                    url:"v-includes/functions/function.createnewpage.php",
                    data: data,
                    beforeSend:function(){
                        // this is where we append a loading image
                        $('').html('');
                        $('#createPage').button('loading')
                      },
                    success:function(result){
                        $('#createPage').button('reset');
                        $('.alert').css({'display':'block'});
                        return false;
                }});
        
        
        event.preventDefault()
    });
    
    
        
  });
</script>
        