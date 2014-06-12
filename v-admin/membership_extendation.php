<?php
	$pageTitle = "Memebership Extension";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Memebership Extension List</p>
            <small>
                <cite title="Source Title">Memebership Extension of your page.</cite>
            </small>
        </blockquote>
        
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>Membership Id</th>
                    <th>Name</th>
                    <th>Joining Date</th>
                    <th>Expiration Date</th>
                    <th>Remaining Days</th>
                    <th>Action</th>
                </tr>
            </thead>
            
			<?php
				//call the method from BLL to get members list
				$manageData->memberExtension();
            ?>           
        </table>
        
     </div>
</div>
<!--body main container ends here--> 

<?php
	//get footer
	include('v-templates/footer.php');
?>