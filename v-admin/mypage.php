<?php
    $pageTitle = "Create Custom Pages";
    //get header
    include('v-templates/header.php');
    //include sidebar
    include('v-templates/sidebar.php');
?>



<!--container for content of the website-->
    <div class="span9" id="content_container">
        <blockquote>
            <p>Create A new Page for your Site</p>
            <small>
                <cite title="Source Title">This Page helps you to create your own page for your site</cite>
            </small>
        </blockquote>
        
        <div class="form-horizontal">
            <form action="v-includes/functions/function.createnewpage.php" method="post">
                <div class="form-control v-form">
                    <div class="alert alert-success fade in" style="display: none">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Your Page has been created and the please check the link at list page section.
                    </div>
                    <label class="control-label">Name of your Page</label>
                    <input type="text" id="pageName" placeholder="Please Enter the Name of your page" class="textbox1" name="category"/>
                </div>
                
                <div class="form-control v-form">
                    <label class="control-label">Enter the content</label><br><br>
                    <textarea type="text" id="editor1" placeholder="Description" class="textbox1 textarea" name="description"></textarea>
                </div>   
                 
                <div class="form-control v-form">
                    <div class="function_result"></div>
                    <input type="submit" value="Create Page" class="btn btn-large btn-inverse btn1" />
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
