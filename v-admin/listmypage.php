<?php
    $pageTitle = "List Custom Pages";
    //get header
    include('v-templates/header.php');
    //include sidebar
    include('v-templates/sidebar.php');
?>

    <div class="span9" id="content_container">
        <blockquote>
            <p>List Of Custom Pages</p>
            <small>
                <cite title="Source Title">List of custom pages of your website.</cite>
            </small>
        </blockquote>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Page Name</th>
                    <th>Page Content</th>
                    <th>Edit</th>
                    <th>Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            
            <?php
                $manageData->getPageList();                          
            
            ?>           
        </table>  
        
        
        
    </div>
    <!-- content container ends here -->
    















<?php
    //get footer
    include('v-templates/footer.php');
?>