<?php
	$pageTitle = "Members List";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Members List</p>
            <small>
                <cite title="Source Title">List of members of your website.</cite>
            </small>
        </blockquote>
        
        <!--form for adding the product-->
        <div class="form-horizontal">
        	<form action="v-includes/functions/function.searchMember.php" method="post">
            	<div class="form-control v-form">
                	<label class="control-label">Search Member:</label>
                    <select class="selectbox1" name="search_key">
                    	<option value="name">By Name</option>
                        <option value="membership_id">By Membership Id</option>
                    </select>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Input Value:</label>
                    <input type="text" placeholder="Search Element" class="textbox1" name="value"/>
                </div>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                    <input type="hidden" name="redirect_page" value="listMembers" />
                	<input type="submit" value="SEARCH" class="btn btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>Membership Id</th>
                    <th>Name</th>
                    <th>Email id</th>
                    <th>Membership Validiation</th>
                    <th>Details</th>
                    <th>Order History</th>
                    <th>Withdraw History</th>
                    <th>Ewallet Details</th>
                </tr>
            </thead>
            
			<?php
				//selecting the values according to search method
				if(!empty($GLOBALS['_GET']))
				{
					//getting the key field by which data will fetched
					if(isset($GLOBALS['_GET']['name']))
					{
						$search_key = $GLOBALS['_GET']['name'];
						$column_name = "name";
					}
					else if(isset($GLOBALS['_GET']['membership_id']))
					{
						$search_key = $GLOBALS['_GET']['membership_id'];
						$column_name = "membership_id";
					}
				}
				else
				{
					$search_key = "";
					$column_name = "";
				}
		   
				//call the method from BLL to get members list
				$manageData->getMembersList($column_name,$search_key);							
			
            ?>           
        </table>
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>