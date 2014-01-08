<?php
	$pageTitle = "MLM Structure";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>
<!--container for content of the website-->
	<div class="span9" id="content_container">
    
    	<blockquote>
            <p>Tree Structure</p>
            <small>
                <cite title="Source Title">Tree Structure of your website.</cite>
            </small>
        </blockquote>
        
        <?php	$membership_id = $GLOBALS['_GET']['member_id']; ?>
        
        <div class="row-fluid">
        	<div class="span4 parent_element">
            	<h4><u>Parent Member</u></h4>
                <?php $parent_member = $manageData->getParentElement($membership_id); ?>
            </div>
            <div class="span4 member_element">
            	<h4><u>Member</u></h4>
                <a href="treeStructure.php?member_id=<?Php echo $membership_id; ?>"><button class="btn btn-danger btn-block"><?php echo $membership_id; ?></button></a>
            </div>
            <div class="span4 child_element">
            	<h4><u>Child Members</u></h4>
                <?php $child_member = $manageData->getChildElements($membership_id); ?>
            </div>
        </div>
        
    </div>
</div>
<!--body main container ends here-->



<?php
	//get footer
	include('v-templates/footer.php');
?>