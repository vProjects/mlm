<?php
	//include the library for DAL
	include('library.DAL.php');
	
	class manageContent_BLL
	{
		private $manageContent;
		//contructor of the class
		function __construct()
		{
			$this->manageContent = new manageContent_DAL();
			return $this->manageContent;
		}
		
		/*
			getting product list from database table
			Auth: Dipanjan
		*/
		function getProductList(){
			//fetching values from database
			$products = $this->manageContent->getValue_descending("product_table","*");
			//showing the values in form
			foreach($products as $product)
			{
				if($product['status'] == 1)
				{
					echo '<tbody>
							<tr>
								<td class="span1 model_thumb"><img src="../'.$product['image'].'"/></td>
								<td>'.$product['category'].'</td>
								<td>'.$product['product_name'].'</td>
								<td> €'.$product['old_price'].'</td>
								<td> €'.$product['price_guest'].'</td>
								<td> €'.$product['price_members'].'</td>
								<td>'.$product['tax'].'</td>
								<td>'.$product['discount'].'</td>
								<td>'.$product['stock'].'</td>
								<td>'.$product['expiration_date'].'</td>
								<td>'.$product['maxpick'].'</td>
								<td><a href="editProduct.php?product_id='.$product['product_id'].'"><button class="btn btn-warning btn-mini" type="button">
									<span class="icon-pencil"></span>&nbsp;&nbsp;EDIT</button></a>
								</td>';
								if($product['expiration_date'] == '0000-00-00')
								{
								echo '<td><a href="v-includes/functions/function.actionProduct.php?value=1&id='.$product['id'].'">
								<button class="btn btn-success btn-mini" type="button">
										<span class="icon-pencil"></span>&nbsp;&nbsp;ENABLE</button></a>
									</td>';
								}
								else
								{
									echo '<td><a href="v-includes/functions/function.actionProduct.php?value=0&id='.$product['id'].'">
									<button class="btn btn-danger btn-mini" type="button">
										<span class="icon-pencil"></span>&nbsp;&nbsp;DISABLE</button></a>
									</td>';
								}
							 echo '<td><a href="v-includes/functions/function.deleteProduct.php?id='.$product['id'].'">
								<button class=" btn btn-danger btn-mini" type="button">
									<span class=" icon-trash"></span>&nbsp;&nbsp;DELETE</button></a>
								</td>
							</tr>
						</tbody>';
				}	
			}
		}
		
		/*
			getting coupon list from database table
			Auth: Dipanjan
		*/
		function getCouponList(){
			//fetching values from database
			$coupons = $this->manageContent->getValue_descending("coupon_table","*");
			//showing the values in form
			foreach($coupons as $coupon)
			{
				if($coupon['status'] == 1)
				{
					echo '<tbody>
							<tr>
								<td class="span1 model_thumb"><img src="../'.$coupon['image'].'"/></td>
								<td>'.$coupon['category'].'</td>
								<td>'.$coupon['coupon_name'].'</td>
								<td>'.$coupon['coupon_code'].'</td>
								<td> €'.$coupon['old_price'].'</td>
								<td> €'.$coupon['price_guest'].'</td>
								<td> €'.$coupon['price_members'].'</td>
								<td>'.$coupon['tax'].'</td>
								<td>'.$coupon['discount'].'</td>
								<td>'.$coupon['stock'].'</td>
								<td>'.$coupon['expiration_date'].'</td>
								<td>'.$coupon['maxpick'].'</td>
								<td><a href="editCoupon.php?coupon_id='.$coupon['coupon_id'].'"><button class="btn btn-warning btn-mini" type="button">
									<span class="icon-pencil"></span>&nbsp;&nbsp;EDIT</button></a>
								</td>';
								if($coupon['expiration_date'] == '0000-00-00')
								{
								echo '<td><a href="v-includes/functions/function.actionCoupon.php?value=1&id='.$coupon['id'].'">
								<button class="btn btn-success btn-mini" type="button">
										<span class="icon-pencil"></span>&nbsp;&nbsp;ENABLE</button></a>
									</td>';
								}
								else
								{
									echo '<td><a href="v-includes/functions/function.actionCoupon.php?value=0&id='.$coupon['id'].'">
									<button class="btn btn-danger btn-mini" type="button">
										<span class="icon-pencil"></span>&nbsp;&nbsp;DISABLE</button></a>
									</td>';
								}
							 echo '<td><a href="v-includes/functions/function.deleteCoupon.php?id='.$coupon['id'].'">
								<button class=" btn btn-danger btn-mini" type="button">
									<span class=" icon-trash"></span>&nbsp;&nbsp;DELETE</button></a>
								</td>
							</tr>
						</tbody>';
				}	
			}
		}
		
		/*
			method for getting product details
			Auth: Dipanjan
		*/
		function getProductDetails($product_id){
			//fetching values from database
			$products = $this->manageContent->getValueWhere("product_table","*","product_id",$product_id);
			//showing the values in ui layer form
			echo '<div class="form-control v-form">
                	<label class="control-label">Product Name:</label>
                    <input type="text" placeholder="Product Name" class="textbox1" name="product_name" value="'.$products[0]['product_name'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Category:</label>
                    <input type="text" placeholder="Category" class="textbox1" value="'.$products[0]['category'].'" readonly="readonly"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label"></label>
                    <select class="selectbox1" multiple="multiple" name="category[]">';
                     $this->getCategoryListSelectBox();
                   echo '</select>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Description</label><br><br>
                    <textarea type="text" id="editor1" placeholder="Description" class="textbox1 textarea" name="description">'.$products[0]['product_description'].'</textarea>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">References:</label>
                    <input type="text" placeholder="Reference link" class="textbox1" name="references" value="'.$products[0]['references'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Old Price:</label>
                    <input type="text" placeholder="Old Price" class="textbox1" name="old_price" value="'.$products[0]['old_price'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Price for Guest:</label>
                    <input type="text" placeholder="Price for Guest" class="textbox1" name="price_guest" value="'.$products[0]['price_guest'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Price for Members:</label>
                    <input type="text" placeholder="Price for Members" class="textbox1" name="price_members" value="'.$products[0]['price_members'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Tax:</label>
                    <input type="text" placeholder="Tax" class="textbox1" name="tax" value="'.$products[0]['tax'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Discount Rate:</label>
                    <input type="text" placeholder="Discount" class="textbox1" name="discount" value="'.$products[0]['discount'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Stock of Product:</label>
                    <input type="text" placeholder="Stock of Product" class="textbox1" name="stock" value="'.$products[0]['stock'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Expiration Date:</label>
                    <input type="text" placeholder="date of Expiration of product" id="calender_date" class="textbox1" name="expiration_date" value="'.$products[0]['expiration_date'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Maximum No of Product:</label>
                    <input type="text" placeholder="Maximum no of product selling at one buyer" class="textbox1" name="maxpick" value="'.$products[0]['maxpick'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Upload Main Image of Product:</label>
                    <input type="file" class="textbox1" name="photo"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo1"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo2"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo3"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo4"/>
                </div>
				<input type="hidden" name="product_id" value="'.$products[0]['product_id'].'"/>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                	<input type="submit" value="UPDATE" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>';
		
		}
		
		/*
			method for getting coupon details
			Auth: Dipanjan
		*/
		function getCouponDetails($coupon_id){
			//fetching values from database
			$coupons = $this->manageContent->getValueWhere("coupon_table","*","coupon_id",$coupon_id);
			//showing the values in ui layer form
			echo '<div class="form-control v-form">
                	<label class="control-label">Coupon Name:</label>
                    <input type="text" placeholder="Coupon Name" class="textbox1" name="coupon_name" value="'.$coupons[0]['coupon_name'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Category:</label>
                    <input type="text" placeholder="Category" class="textbox1" value="'.$coupons[0]['category'].'" readonly="readonly"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label"></label>
                    <select class="selectbox1" multiple="multiple" name="category[]">';
                     $this->getCouponCategoryListSelectBox();
                   echo '</select>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Description</label><br><br>
                    <textarea type="text" id="editor1" placeholder="Description" class="textbox1 textarea" name="description">'.$coupons[0]['coupon_description'].'</textarea>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">References:</label>
                    <input type="text" placeholder="Reference link" class="textbox1" name="references" value="'.$coupons[0]['references'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Coupon Code:</label>
                    <input type="text" placeholder="Coupon Code" class="textbox1" name="coupon_code" value="'.$coupons[0]['coupon_code'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Old Price:</label>
                    <input type="text" placeholder="Old Price" class="textbox1" name="old_price" value="'.$coupons[0]['old_price'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Price for Guest:</label>
                    <input type="text" placeholder="Price for Guest" class="textbox1" name="price_guest" value="'.$coupons[0]['price_guest'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Price for Members:</label>
                    <input type="text" placeholder="Price for Members" class="textbox1" name="price_members" value="'.$coupons[0]['price_members'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Tax:</label>
                    <input type="text" placeholder="Tax" class="textbox1" name="tax" value="'.$coupons[0]['tax'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Discount Rate:</label>
                    <input type="text" placeholder="Discount" class="textbox1" name="discount" value="'.$coupons[0]['discount'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Stock of Product:</label>
                    <input type="text" placeholder="Stock of Product" class="textbox1" name="stock" value="'.$coupons[0]['stock'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Expiration Date:</label>
                    <input type="text" placeholder="date of Expiration of product" id="calender_date" class="textbox1" name="expiration_date" value="'.$coupons[0]['expiration_date'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Maximum No of Product:</label>
                    <input type="text" placeholder="Maximum no of product selling at one buyer" class="textbox1" name="maxpick" value="'.$coupons[0]['maxpick'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Upload Image of Product:</label>
                    <input type="file" class="textbox1" name="photo"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo1"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo2"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo3"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo4"/>
                </div>
				<input type="hidden" name="coupon_id" value="'.$coupons[0]['coupon_id'].'"/>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                	<input type="submit" value="UPDATE" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>';
		
		}
		
		/*
			method for getting category details
			Auth: Dipanjan
		*/
		function getCategoryDetails($category_id){
			//fetching values from database
			$category = $this->manageContent->getValueWhere("product_category","*","id",$category_id);
			//showing the values in ui layer form
			echo '<div class="form-control v-form">
                	<label class="control-label">Category Name:</label>
                    <input type="text" placeholder="Category Name" class="textbox1" name="category" value="'.$category[0]['category'].'"/>
                </div>
				<input type="hidden" name="id" value="'.$category[0]['id'].'"/>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                	<input type="submit" value="UPDATE" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>';
		
		}
		
		/*
			method for checking username and password of admin
			Auth: Dipanjan
		*/
		function loginAdmin($username,$password){
			//fetching values from database
			$admin_info = $this->manageContent->getValueWhere("admin_info","*","id",1);
			//checking values with database
			if($username == $admin_info[0]['username'] && $password == $admin_info[0]['password'])
			{
				return 'success';
			}
			else
			{
				return 'failed';
			}
		
		}
		
		/*
			method for getting coupon category details
			Auth: Dipanjan
		*/
		function getCouponCategoryDetails($category_id){
			//fetching values from database
			$category = $this->manageContent->getValueWhere("coupon_category","*","id",$category_id);
			//showing the values in ui layer form
			echo '<div class="form-control v-form">
                	<label class="control-label">Category Name:</label>
                    <input type="text" placeholder="Category Name" class="textbox1" name="category" value="'.$category[0]['category'].'"/>
                </div>
				<input type="hidden" name="id" value="'.$category[0]['id'].'"/>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                	<input type="submit" value="UPDATE" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>';
		
		}
		
		/*
			method for getting footer link of an id
			Auth: Dipanjan
		*/
		function getFooterBottomText(){
			//fetching values from database
			$footer_link = $this->manageContent->getValueWhere("footer_content","*","name","bottom_text");
			//showing the values in ui layer form
			echo '<div class="form-control v-form">
                	<label class="control-label">Bottom Text:</label><br><br>
                    <textarea type="text" id="editor1" placeholder="write bottom text" class="textbox1 textarea" name="bottom_text">'.$footer_link[0]['bottom_text'].'</textarea>
                </div>
				<input type="hidden" name="id" value="'.$footer_link[0]['id'].'"/>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                	<input type="submit" value="UPDATE" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>';
		
		}
		
		/*
			method for getting slider content
			Auth: Dipanjan
		*/
		function getSliderContent(){
			//fetching values from database
			$slider_content = $this->manageContent->getValue("slider_content","*");
			//showing the values in ui layer form
			echo '<div class="form-control v-form">
                	<label class="control-label">1st image:</label>
                    <input type="file" class="textbox1" name="photo1"/>
				</div>	
				<div class="form-control v-form">
                	<label class="control-label">1st Slider Heading:</label>
                    <input type="text" placeholder="1st Slider Heading" class="textbox1" name="heading1" value="'.$slider_content[0]['heading'].'"/>
				</div>
				<div class="form-control v-form">
                	<label class="control-label">1st Slider Link:</label>
                    <input type="text" placeholder="1st Slider Link" class="textbox1" name="link1" value="'.$slider_content[0]['link'].'"/>
				</div>	
				<div class="form-control v-form">
                	<label class="control-label">1st Slider Description:</label>
					<textarea class="textbox1 textarea" name="description1">'.$slider_content[0]['description'].'</textarea> 
				</div>
				<div class="form-control v-form">
                	<label class="control-label">2nd image:</label>
                    <input type="file" class="textbox1" name="photo2"/>
				</div>	
				<div class="form-control v-form">
                	<label class="control-label">2nd Slider Heading:</label>
                    <input type="text" placeholder="2nd Slider Heading" class="textbox1" name="heading2" value="'.$slider_content[1]['heading'].'"/>
				</div>	
				<div class="form-control v-form">
                	<label class="control-label">2nd Slider Link:</label>
                    <input type="text" placeholder="2nd Slider Link" class="textbox1" name="link2" value="'.$slider_content[1]['link'].'"/>
				</div>
				<div class="form-control v-form">
                	<label class="control-label">2nd Slider Description:</label>
                    <textarea class="textbox1 textarea" name="description2">'.$slider_content[1]['description'].'</textarea> 
				</div>
				<div class="form-control v-form">
                	<label class="control-label">3rd image:</label>
                    <input type="file" class="textbox1" name="photo3"/>
				</div>	
				<div class="form-control v-form">
                	<label class="control-label">3rd Slider Heading:</label>
                    <input type="text" placeholder="3rd Slider Heading" class="textbox1" name="heading3" value="'.$slider_content[2]['heading'].'"/>
				</div>
				<div class="form-control v-form">
                	<label class="control-label">3rd Slider Link:</label>
                    <input type="text" placeholder="3rd Slider Link" class="textbox1" name="link3" value="'.$slider_content[2]['link'].'"/>
				</div>	
				<div class="form-control v-form">
                	<label class="control-label">3rd Slider Description:</label>
                    <textarea class="textbox1 textarea" name="description3">'.$slider_content[2]['description'].'</textarea> 
				</div>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                	<input type="submit" value="UPDATE" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>';
		
		}
		
		/*
			method for getting invalid member content
			Auth: Dipanjan
		*/
		function getInvalidMemberContent(){
			//fetching values from database
			$slider_content = $this->manageContent->getValueWhere("invalid_member_content","*","id",1);
			//showing the values in ui layer form
			echo '<h5>For Email Verificaation</h5>	
				<div class="form-control v-form">
                	<label class="control-label">Description</label><br><br>
                    <textarea type="text" id="editor1" placeholder="Description" class="textbox1 textarea" name="description1">'.$slider_content[0]['description'].'</textarea>
                </div>';
			//fetching values from database
			$slider_content = $this->manageContent->getValueWhere("invalid_member_content","*","id",2);
			//showing the values in ui layer form
			echo '<h5>For Membership Product</h5>	
				<div class="form-control v-form">
                	<label class="control-label">Description</label><br><br>
                    <textarea type="text" id="editor2" placeholder="Description" class="textbox1 textarea" name="description2">'.$slider_content[0]['description'].'</textarea>
                </div>
				<div class="form-control v-form">
                	<div class="function_result"></div>
                	<input type="submit" value="UPDATE" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>';
		
		}
		
		/*
			method for getting slider content
			Auth: Dipanjan
		*/
		function getAnFooterLink($footer_id){
			//fetching values from database
			$footer_link = $this->manageContent->getValueWhere("footer_content","*","id",$footer_id);
			//showing the values in ui layer form
			echo '<div class="form-control v-form">
                	<label class="control-label">Name:</label>
                    <input type="text" placeholder="Footer Link Name" class="textbox1" name="name" value="'.$footer_link[0]['name'].'"/>
                </div>	
				<div class="form-control v-form">
                	<label class="control-label">Link:</label>
                    <input type="text" placeholder="Footer Link" class="textbox1" name="link" value="'.$footer_link[0]['link'].'"/>
                </div>
                <div class="form-control v-form">
                	<div class="function_result"></div>
					<input type="hidden" name="id" value="'.$footer_link[0]['id'].'"/>
                	<input type="submit" value="UPDATE" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>';
		
		}
		
		
		/*
			getting membership product list from database table
			Auth: Dipanjan
		*/
		function getMembershipProductList(){
			//fetching values from database
			$products = $this->manageContent->getValue("membership_product","*");
			//showing the values in form
			foreach($products as $product)
			{
				echo '<tbody>
                        <tr>
							<td class="span1 model_thumb"><img src="../'.$product['image'].'"/></td>
							<td>'.$product['product_name'].'</td>
							<td> €'.$product['price'].'</td>
							<td> '.$product['discount'].'</td>
							<td>'.$product['stock'].'</td>
                            <td><a href="editMembershipProduct.php?product_id='.$product['product_id'].'"><button class="btn btn-warning btn-mini" type="button">
								<span class="icon-pencil"></span>&nbsp;&nbsp;EDIT</button></a>
							</td>
                            <td><button class=" btn btn-danger btn-mini" type="button">
								<span class=" icon-trash"></span>&nbsp;&nbsp;DELETE</button>
							</td>
                        </tr>
                    </tbody>';	
			}
		}
		
		/*
			getting footer list in table
			Auth: Dipanjan
		*/
		function getFooterLinks(){
			//fetching values from database
			$footer_links = $this->manageContent->getValue("footer_content","*");
			//showing the values in form
			foreach($footer_links as $footer_link)
			{
				if($footer_link['name'] != 'bottom_text')
				{
					//getting the column name
					if($footer_link['1st_column'] == 1)
					{
						$column_name = '1st';
					}
					else if($footer_link['2nd_column'] == 1)
					{
						$column_name = '2nd';
					}
					else if($footer_link['3rd_column'] == 1)
					{
						$column_name = '3rd';
					}
					echo '<tbody>
							<tr>
								<td>'.$footer_link['name'].'</td>
								<td>'.$footer_link['link'].'</td>
								<td>'.$column_name.'</td>
								<td><a href="editFooterLinks.php?id='.$footer_link['id'].'"><button class="btn btn-warning btn-mini" type="button">
									<span class="icon-pencil"></span>&nbsp;&nbsp;EDIT</button></a>
								</td>';
								if($footer_link['status'] == 1)
								{
									echo '<td><a href="v-includes/functions/function.actionFooterLinks.php?id='.$footer_link['id'].'&action=0"><button class="btn btn-danger btn-mini" type="button">
										<span class="icon-pencil"></span>&nbsp;&nbsp;DISABLE</button></a>
									</td>';
								}
								else
								{
									echo '<td><a href="v-includes/functions/function.actionFooterLinks.php?id='.$footer_link['id'].'&action=1"><button class="btn btn-success btn-mini" type="button">
										<span class="icon-pencil"></span>&nbsp;&nbsp;ENABLE</button></a>
									</td>';
								}
								
							echo  '<td><a href="v-includes/functions/function.deleteFooterLinks.php?id='.$footer_link['id'].'"><button class=" btn btn-danger btn-mini" type="button">
									<span class=" icon-trash"></span>&nbsp;&nbsp;DELETE</button></a>
								</td>
							</tr>
						</tbody>';
				}
					
			}
		}
		
		/*
			method for getting membership product details
			Auth: Dipanjan
		*/
		function getMembershipProductDetails($product_id){
			//fetching values from database
			$products = $this->manageContent->getValueWhere("membership_product","*","product_id",$product_id);
			//showing the values in ui layer form
			echo '<div class="form-control v-form">
                	<label class="control-label">Product Name:</label>
                    <input type="text" placeholder="Product Name" class="textbox1" name="product_name" value="'.$products[0]['product_name'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Description</label><br><br>
                    <textarea type="text" id="editor1" placeholder="Description" class="textbox1 textarea" name="description">'.$products[0]['product_description'].'</textarea>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Price:</label>
                    <input type="text" placeholder="Price for Members" class="textbox1" name="price" value="'.$products[0]['price'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Discount:</label>
                    <input type="text" placeholder="Discount Rate" class="textbox1" name="discount" value="'.$products[0]['discount'].'"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Stock of Product:</label>
                    <input type="text" placeholder="Stock of Product" class="textbox1" name="stock" value="'.$products[0]['stock'].'"/>
                </div>
				<input type="hidden" name="product_id" value="'.$products[0]['product_id'].'"/>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                	<input type="submit" value="UPDATE" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>';
		
		}
		
		/*
			getting members list from database table
			Auth: Dipanjan
		*/
		function getMembersList($column_name,$search_key){
			//checking for empty input parameter
			if(!empty($search_key))
			{
				//getting values from database
				$members = $this->manageContent->getValue_likely_descending("member_table","*",$column_name,$search_key);
				if(!empty($members[0]))
				{
					//showing them in table
					foreach($members as $member){
						//checking for membership validiation
						if($member['membership_validiation'] == 1 && $member['membership_activation'] == 1)
						{
							$membership_validiation = 'Valid';
							$addMoneyButton = '<a href="v-includes/functions/function.addMoneyEwallet.php?member_id='.$member['membership_id'].'"><button class="btn btn-success"> <span class="icon-pencil"></span>&nbsp;&nbsp;Add Money</button></a>';
						}
						else
						{
							$membership_validiation = 'Invalid';
							$addMoneyButton = '<a href="v-includes/functions/function.addMoneyEwallet.php?member_id='.$member['membership_id'].'"><button class="btn btn-success"> <span class="icon-pencil"></span>&nbsp;&nbsp;Add Money</button></a>';
						}
						echo '<tr>
								<td>'.$member['membership_id'].'</td>
								<td>'.$member['name'].'</td>
								<td>'.$member['email_id'].'</td>
								<td>'.$membership_validiation.'</td>
								<td><a href="editMembers.php?m_id='.$member['membership_id'].'"><button class="btn btn-warning" type="button">
									<span class="icon-pencil"></span>&nbsp;&nbsp;Personal Details</button></a>
								</td>
								<td>
									<a href="memberOrderHistory.php?m_id='.$member['membership_id'].'"><button class="btn btn-primary"><span class="icon-pencil"></span>&nbsp;&nbsp;Order History</button></a>
								</td>
								<td>
									<a href="memberWithdrawHistory.php?m_id='.$member['membership_id'].'"><button class="btn btn-inverse"><span class="icon-pencil"></span>&nbsp;&nbsp;Withdraw History</button></a>
								</td>
								<td>
									<a href="memberEwalletDetails.php?m_id='.$member['membership_id'].'"><button class="btn btn-danger"> <span class="icon-pencil"></span>&nbsp;&nbsp;Ewallet Details</button></a>
								</td>
								<td>
									<a href="treeStructure.php?member_id='.$member['membership_id'].'"><button class="btn btn-warning"> <span class="icon-pencil"></span>&nbsp;&nbsp;MLM Structure</button></a>
								</td>
								<td>'.$addMoneyButton.'</td>
							</tr>';
							
					}
				}
				else
				{
					echo "NO MEMBER FOUND";
				}
				
			}
			else
			{
				$members = $this->manageContent->getValue_descending("member_table","*");
				//showing the values in form
				if(!empty($members))
				{
					foreach($members as $member)
					{
						//checking for membership validiation
						if($member['membership_validiation'] == 1 && $member['membership_activation'] == 1)
						{
							$membership_validiation = 'Valid';
							$addMoneyButton = '<a href="v-includes/functions/function.addMoneyEwallet.php?member_id='.$member['membership_id'].'"><button class="btn btn-success"> <span class="icon-pencil"></span>&nbsp;&nbsp;Add Money</button></a>';
						}
						else
						{
							$membership_validiation = 'Invalid';
							$addMoneyButton = '<a href="v-includes/functions/function.addMoneyEwallet.php?member_id='.$member['membership_id'].'"><button class="btn btn-success"> <span class="icon-pencil"></span>&nbsp;&nbsp;Add Money</button></a>';
						}
						echo '<tbody>
								<tr>
									<td>'.$member['membership_id'].'</td>
									<td>'.$member['name'].'</td>
									<td>'.$member['email_id'].'</td>
									<td>'.$membership_validiation.'</td>
									<td><a href="editMembers.php?m_id='.$member['membership_id'].'"><button class="btn btn-warning" type="button">
										<span class="icon-pencil"></span>&nbsp;&nbsp;Personal Details</button></a>
									</td>
									<td>
										<a href="memberOrderHistory.php?m_id='.$member['membership_id'].'"><button class="btn btn-primary"><span class="icon-pencil"></span>&nbsp;&nbsp;Order History</button></a>
									</td>
									<td>
										<a href="memberWithdrawHistory.php?m_id='.$member['membership_id'].'"><button class="btn btn-inverse"><span class="icon-pencil"></span>&nbsp;&nbsp;Withdraw History</button></a>
									</td>
									<td>
										<a href="memberEwalletDetails.php?m_id='.$member['membership_id'].'"><button class="btn btn-danger"> <span class="icon-pencil"></span>&nbsp;&nbsp;Ewallet Details</button></a>
									</td>
									<td>
										<a href="treeStructure.php?member_id='.$member['membership_id'].'"><button class="btn btn-warning"> <span class="icon-pencil"></span>&nbsp;&nbsp;MLM Structure</button></a>
									</td>
									<td>'.$addMoneyButton.'</td>
								</tr>
							</tbody>';	
					}
				}
					
			}
		}
		
		
		/*
			method for getting member details
			Auth: Dipanjan
		*/
		function getMembersDetails($member_id){
			//fetching values from database
			$members = $this->manageContent->getValueWhere("member_table","*","membership_id",$member_id);
			//fetching account details of member
			$member_ac_details = $this->manageContent->getValueWhere("member_account_details","*","membership_id",$member_id);
			//showing the values in ui layer form
			echo '<div class="form-control v-form">
                	<label class="control-label">Membership Id:</label>
                    <input type="text" placeholder="Membership Id" class="textbox1" name="member_id" value="'.$members[0]['membership_id'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Name:</label>
                    <input type="text" placeholder="Name" class="textbox1" name="name" value="'.$members[0]['name'].'"/>
                </div> 
				<div class="form-control v-form">
                	<label class="control-label">Address:</label>
                    <input type="text" placeholder="Address" class="textbox1" name="address" value="'.$members[0]['address'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">City:</label>
                    <input type="text" placeholder="City" class="textbox1" name="city" value="'.$members[0]['city'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Postal Code:</label>
                    <input type="text" placeholder="Postal_code" class="textbox1" name="postal_code" value="'.$members[0]['postal_code'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">State:</label>
                    <input type="text" placeholder="State" class="textbox1" name="state" value="'.$members[0]['state'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Country:</label>
                    <input type="text" placeholder="Country" class="textbox1" name="country" value="'.$members[0]['country'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Email Id:</label>
                    <input type="text" placeholder="Email Id" class="textbox1" name="email_id" value="'.$members[0]['email_id'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Start Date of Membership:</label>
                    <input type="text" placeholder="Contact No" class="textbox1" name="contact_no" value="'.$this->changeDateFormat($members[0]['date']).'"/>
				</div>	
				<div class="form-control v-form">
                	<label class="control-label">End Date of Membership:</label>
                    <input type="text" placeholder="Email Id" class="textbox1" name="email_id" value="'.$this->changeDateFormat($members[0]['expiration_date']).'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Contact No:</label>
                    <input type="text" placeholder="Contact No" class="textbox1" name="contact_no" value="'.$members[0]['contact_no'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Name of A/C Holder:</label>
                    <input type="text" placeholder="Account Holder" class="textbox1" name="ac_name" value="'.$member_ac_details[0]['ac_name'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">A/C No:</label>
                    <input type="text" placeholder="Account No" class="textbox1" name="ac_no" value="'.$member_ac_details[0]['ac_no'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Bank:</label>
                    <input type="text" placeholder="Bank Name" class="textbox1" name="bank" value="'.$member_ac_details[0]['bank'].'"/>
                </div>
				<div class="form-control v-form">
                	<label class="control-label">Branch Name:</label>
                    <input type="text" placeholder="Branch Name" class="textbox1" name="branch" value="'.$member_ac_details[0]['branch'].'"/>
                </div>';
				if($members[0]['membership_validiation'] == 1 && $members[0]['membership_activation'] ==1)
				{
					$validiate = 'Valid';
				}
				else
				{
					$validiate ='Invalid';
				}
				echo '<div class="form-control v-form">
                	<label class="control-label">Membership Validiation:</label>
                    <input type="text" placeholder="Membership Validiation" class="textbox1" name="membership_validiation" value="'.$validiate.'"/>
                </div>';
		
		}
		
		/*
			getting mlm details from database table
			Auth: Dipanjan
		*/
		function getMlmDetails(){
			//fetching values from database
			$mlm_details = $this->manageContent->getValue("mlm_info","*");
			if(!empty($mlm_details))
			{
				//showing the values in form
				foreach($mlm_details as $mlm)
				{
					if(!empty($mlm['parent_id']))
					{
						$parent = $mlm['parent_id'];
					}
					else
					{
						$parent = 'No Parent';
					}
					if(!empty($mlm['child_id']))
					{
						$child = $mlm['child_id'];
					}
					else
					{
						$child = 'No Child';
					}
					echo '<tbody>
							<tr>
								<td>'.$mlm['id'].'</td>
								<td>'.$mlm['membership_id'].'</td>
								<td>'.$parent.'</td>
								<td>'.$child.'</td>
								<td>'.$mlm['date'].'</td>
								<td><a href="treeStructure.php?member_id='.$mlm['membership_id'].'"><button class="btn btn-warning btn-mini" type="button">
									<span class="icon-pencil"></span>&nbsp;&nbsp;STRUCTURE</button></a>
								</td>
							</tr>
						</tbody>';	
				}
			}
		}
		
		/*
			getting mlm details from database table
			Auth: Dipanjan
		*/
		function getWithdrawalList($status){
			//fetching values from database
			$withdrawals = $this->manageContent->getValueWhere_descending("withdraw_log","*","status",$status);
			//checking for empty result or not
			if(!empty($withdrawals[0]))
			{
				//initialize a variable to count serial number
				$sl_no = 1;
				//showing the values in table
				foreach($withdrawals as $withdrawal)
				{
					//getting the member details from member table
					$member = $this->manageContent->getValueWhere("member_table","*","membership_id",$withdrawal['membership_id']);
					//checking for frozen money
					if($withdrawal['frozen_money'] == 1)
					{
						$frozen_money = 'Yes';
					}
					else
					{
						$frozen_money = 'No';
					}
					echo '<tbody>
							<tr>
								<td>'.$sl_no.'</td>
								<td><a href="listMembers.php?membership_id='.$withdrawal['membership_id'].'">'.$withdrawal['membership_id'].'</a></td>
								<td>'.$member[0]['name'].'</td>
								<td>'.$withdrawal['withdraw_order_id'].'</td>
								<td>'.$frozen_money.'</td>
								<td>'.$this->changeDateFormat($withdrawal['date']).'</td>
								<td> €'.$withdrawal['withdraw_amount'].'</td>';
								//checking the status value
								if($status == 0)
								{
									//cheking for member purchases 11% of withdrawal frozen money
									$approval_result = $this->getApprovalFrozen($withdrawal['membership_id'],$withdrawal['withdraw_amount'],$withdrawal['date']);
									if($frozen_money == 'Yes' && $approval_result == 'true')
									{
										echo '<td><a href="v-includes/functions/function.withdrawRequest.php?w_id='.$withdrawal['withdraw_order_id'].'">
										<button class="btn btn-success" type="button">
												<span class="icon-pencil"></span>&nbsp;&nbsp;CONFIRM FROZEN MONEY</button>
											</a></td>';
									}
									else if($frozen_money == 'Yes' && $approval_result == 'false')
									{
										echo '<td>Purchasing Pending</td>';
									}
									else if($frozen_money == 'No')
									{
										echo '<td><a href="v-includes/functions/function.withdrawRequest.php?w_id='.$withdrawal['withdraw_order_id'].'">
										<button class="btn btn-success" type="button">
												<span class="icon-pencil"></span>&nbsp;&nbsp;CONFIRM</button>
											</a></td>';
									}
									
								}
								
						 echo '</tr>
						</tbody>';	
					//increament serial no variable
					$sl_no++;
				}
			}
			else
			{
				echo '<tbody>
						<tr>
							<td>N/A</td>
							<td>N/A</td>
							<td>N/A</td>
							<td>N/A</td>
							<td>N/A</td>
							<td>N/A</td>
							<td>N/A</td>
							<td>N/A</td>
						</tr>
					</tbody>';					
			}	
		}
		
		/*
			getting approval for frozen money withdrawals from database table
			Auth: Dipanjan
		*/
		function getApprovalFrozen($membership_id,$frozen_money,$withdrawal_date){
			//fetching values from database
			$money_details = $this->manageContent->getValue_twoCoditions("money_transfer_log","*","membership_id",$membership_id,"debit","");
			//calculate 11% of frozen money
			$required_money = (($frozen_money * 11)/ 100);
			//checking every element of database value
			foreach($money_details as $money_detail){
				//checking for credit date is greater then withdrawal date or not
				$date_result = $this->frozenDate($money_detail['date'],$withdrawal_date);
				if($money_detail['credit'] >= $required_money && $date_result == 1)
				{
					return 'true';
					break;
				}
			}
			return 'false';
		}
		
		/*
		 method for checking the comparison between two dates
		 Auth: Dipanjan
		*/
		function frozenDate($credit_date,$withdrawal_date){
			//exploding the date to seperate year, month, date
			$date1 = explode("-",$credit_date);
			//exploding the date to seperate year, month, date
			$date2 = explode("-",$withdrawal_date);
			//checking for date expires or not
			if($date1[0] > $date2[0])
			{
				return 1;
			}
			else if($date1[0] = $date2[0])
			{
				if($date1[1] > $date2[1])
				{
					return 1;
				}
				else if($date1[1] = $date2[1])
				{
					if($date1[2] >= $date2[2])
					{
						return 1;
					}
					else
					{
						return 0;
					}
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
		}
		
		/*
			getting payment request from database table
			Auth: Dipanjan
		*/
		function getDuePayments($input_field){
			//getting values from purchase info
			$payments = $this->manageContent->getValueWhere_descending("purchase_log","*","payment_method","account");
			//checking for empty value
			if(!empty($payments))
			{
				foreach($payments as $payment){
					if(!empty($payment['product_id']) && !empty($payment['membership_id']))
					{
						//getting purchase details
						$purchase = $this->manageContent->getValueWhere("purchase_info","*","order_id",$payment['order_id']);
						//checking for membership_id
						if($payment['membership_id'] == 'guest')
						{
							$member_name = 'guest';
						}
						else
						{
							$member = $this->manageContent->getValueWhere("member_table","*","membership_id",$payment['membership_id']);
							$member_name = $member[0]['name'];
						}
						if($purchase[0]['payment_status'] == 0 && $purchase[0]['payment_request'] == $input_field)
						{
							//showing them in table
							echo '<tbody>
									<tr>
										<td><a href="orderDetails.php?o_id='.$payment['order_id'].'">'.$payment['order_id'].'</a></td>
										<td>'.$member_name.'</td>
										<td>'.$this->changeDateFormat($payment['date']).'</td>
										<td> €'.$payment['price'].'</td>';
										if($input_field == NULL)
										{
											echo '<td>
											<a href="v-includes/functions/function.paymentConfirm.php?o_id='.$payment['order_id'].'">
												<button class="btn btn-success" type="button">
													<span class="icon-pencil"></span>&nbsp;&nbsp;CONFIRM</button>
												</a></td>
												<td>
											<a href="v-includes/functions/function.deleteOrder.php?o_id='.$payment['order_id'].'">
												<button class="btn btn-danger" type="button">
													<span class="icon-pencil"></span>&nbsp;&nbsp;DELETE</button>
												</a></td>';
										}
										else if($input_field == 'Progressing')
										{
											echo '<td>
											<a href="v-includes/functions/function.finalConfirmationPayment.php?o_id='.$payment['order_id'].'">
												<button class="btn btn-danger" type="button">
													<span class="icon-pencil"></span>&nbsp;&nbsp;FINAL CONFIRM</button>
												</a></td>
											<td><a href="v-includes/functions/function.undoPaymentConfirmation.php?o_id='.$payment['order_id'].'">
												<button class="btn btn-warning" type="button">
													<span class="icon-pencil"></span>&nbsp;&nbsp;UNDO</button>
												</a></td>';
										}
										else if($input_field == 'Undo')
										{
											echo '';
										}
										
							echo	'</tr>
								</tbody>';
						}
						else
						{
							echo '';
						}
					}
				}
			}
			
		}
		
		/*
			getting add money details
			Auth: Dipanjan
		*/
		function getAddMoneyDetails(){
			//getting values from add money info
			$moneyDetails = $this->manageContent->getValueWhere_descending("addmoney_info","*","status",0);
			//checking for empty value
			if(!empty($moneyDetails))
			{
				foreach($moneyDetails as $moneyDetail){
					//getting member details
					$member_details = $this->manageContent->getValueWhere("member_table","*","membership_id",$moneyDetail['membership_id']);
					
					echo '<tbody>
							<tr>
								<td>'.$moneyDetail['money_id'].'</td>
								<td>'.$moneyDetail['membership_id'].'</td>
								<td>'.$member_details[0]['name'].'</td>
								<td>'.$moneyDetail['date'].'</td>
								<td>
									<form action="v-includes/functions/function.confirmAddMoney.php" method="post" class="form-inline">
										<input type="text" name="amount" style="width:50%;">
										<input type="hidden" name="id" value="'.$moneyDetail['id'].'">
										<input type="submit" class="btn btn-success" value="Confirm">
									</form>
								</td>
								<td>
								<a href="v-includes/functions/function.deleteAddMoney.php?id='.$moneyDetail['id'].'">
									<button class="btn btn-danger" type="button">
										<span class="icon-pencil"></span>&nbsp;&nbsp;DELETE</button>
									</a></td>
							</tr>
						</tbody>';
				}
			}
		}
		
		/*
			getting successfull add money details
			Auth: Dipanjan
		*/
		function getSuccessfullAddMoneyDetails(){
			//getting values from add money info
			$moneyDetails = $this->manageContent->getValueWhere_descending("addmoney_info","*","status",1);
			//checking for empty value
			if(!empty($moneyDetails))
			{
				foreach($moneyDetails as $moneyDetail){
					//getting member details
					$member_details = $this->manageContent->getValueWhere("member_table","*","membership_id",$moneyDetail['membership_id']);
					
					echo '<tbody>
							<tr>
								<td>'.$moneyDetail['money_id'].'</td>
								<td>'.$moneyDetail['membership_id'].'</td>
								<td>'.$member_details[0]['name'].'</td>
								<td>'.$moneyDetail['date'].'</td>
								<td>€ '.$moneyDetail['amount'].'</td>
							</tr>
						</tbody>';
				}
			}
		}
		
		/*
			getting payment request from database table for myaccount
			Auth: Dipanjan
		*/
		function getDuePaymentsMyAccount($input_field){
			//getting values from purchase info
			$payments = $this->manageContent->getValueWhere_descending("purchase_log","*","payment_method","myaccount");
			//checking for empty value
			if(!empty($payments))
			{
				foreach($payments as $payment){
					if(!empty($payment['product_id']) && !empty($payment['membership_id']))
					{
						//getting purchase details
						$purchase = $this->manageContent->getValueWhere("purchase_info","*","order_id",$payment['order_id']);
						//checking for membership_id
						if($payment['membership_id'] == 'guest')
						{
							$member_name = 'guest';
						}
						else
						{
							$member = $this->manageContent->getValueWhere("member_table","*","membership_id",$payment['membership_id']);
							$member_name = $member[0]['name'];
						}
						if($purchase[0]['payment_status'] == 0 && $purchase[0]['payment_request'] == $input_field)
						{
							//showing them in table
							echo '<tbody>
									<tr>
										<td><a href="orderDetails.php?o_id='.$payment['order_id'].'">'.$payment['order_id'].'</a></td>
										<td>'.$member_name.'</td>
										<td>'.$this->changeDateFormat($payment['date']).'</td>
										<td> €'.$payment['price'].'</td>';
										if($input_field == NULL)
										{
											echo '<td>
											<a href="v-includes/functions/function.paymentConfirmByAccount.php?o_id='.$payment['order_id'].'">
												<button class="btn btn-success" type="button">
													<span class="icon-pencil"></span>&nbsp;&nbsp;CONFIRM</button>
												</a></td>';
										}
										else if($input_field == 'Progressing')
										{
											echo '<td>
											<a href="v-includes/functions/function.finalConfirmationPaymentByAccount.php?o_id='.$payment['order_id'].'">
												<button class="btn btn-danger" type="button">
													<span class="icon-pencil"></span>&nbsp;&nbsp;FINAL CONFIRM</button>
												</a></td>
											<td><a href="v-includes/functions/function.undoPaymentConfirmationByAccount.php?o_id='.$payment['order_id'].'">
												<button class="btn btn-warning" type="button">
													<span class="icon-pencil"></span>&nbsp;&nbsp;UNDO</button>
												</a></td>';
										}
										else if($input_field == 'Undo')
										{
											echo '';
										}
										
							echo	'</tr>
								</tbody>';
						}
						else
						{
							echo '';
						}
					}
				}
			}
			
		}
		
		/*
			getting payment request from database table for paypal
			Auth: Dipanjan
		*/
		function getDuePaymentsPaypal($input_field){
			//getting values from purchase info
			$payments = $this->manageContent->getValueWhere_descending("purchase_log","*","payment_method","paypal");
			//checking for empty value
			if(!empty($payments))
			{
				foreach($payments as $payment){
					if(!empty($payment['product_id']) && !empty($payment['membership_id']))
					{
						//getting purchase details
						$purchase = $this->manageContent->getValueWhere("purchase_info","*","order_id",$payment['order_id']);
						//checking for membership_id
						if($payment['membership_id'] == 'guest')
						{
							$member_name = 'guest';
						}
						else
						{
							$member = $this->manageContent->getValueWhere("member_table","*","membership_id",$payment['membership_id']);
							$member_name = $member[0]['name'];
						}
						if($purchase[0]['payment_status'] == 0 && $purchase[0]['payment_request'] == $input_field)
						{
							//showing them in table
							echo '<tbody>
									<tr>
										<td><a href="orderDetails.php?o_id='.$payment['order_id'].'">'.$payment['order_id'].'</a></td>
										<td>'.$member_name.'</td>
										<td>'.$this->changeDateFormat($payment['date']).'</td>
										<td> €'.$payment['price'].'</td>';
										if($input_field == NULL)
										{
											echo '<td>
											<a href="#">
												<button class="btn btn-success" type="button">
													<span class="icon-pencil"></span>&nbsp;&nbsp;CONFIRM</button>
												</a></td>';
										}
										else if($input_field == 'Progressing')
										{
											echo '<td>
											<a href="v-includes/functions/function.finalConfirmationPaymentByPaypal.php?o_id='.$payment['order_id'].'">
												<button class="btn btn-danger" type="button">
													<span class="icon-pencil"></span>&nbsp;&nbsp;FINAL CONFIRM</button>
												</a></td>
											<td><a href="v-includes/functions/function.undoPaymentConfirmationByPaypal.php?o_id='.$payment['order_id'].'">
												<button class="btn btn-warning" type="button">
													<span class="icon-pencil"></span>&nbsp;&nbsp;UNDO</button>
												</a></td>';
										}
										else if($input_field == 'Undo')
										{
											echo '';
										}
										
							echo	'</tr>
								</tbody>';
						}
						else
						{
							echo '';
						}
					}
				}
			}
			
		}
		
		/*
			getting parent element of given member from database table
			Auth: Dipanjan
		*/
		function getParentElement($membership_id){
			//fetching values from database
			$parent_id = $this->manageContent->getValueWhere("mlm_info","parent_id","membership_id",$membership_id);
			//checking for parent element
			if($parent_id[0]['parent_id'] != "")
			{
				//getting parent membership id
				$parent_membership_id = $this->manageContent->getValueWhere("mlm_info","membership_id","id",$parent_id[0]['parent_id']);
				echo '<a href="treeStructure.php?member_id='.$parent_membership_id[0]['membership_id'].'"><button class="btn btn-inverse btn-block">'.$parent_membership_id[0]['membership_id'].'</button></a>';
		
			}
			else
			{
				echo '<div class="no_found_text"> No Parent Element </div>';
			}
		}
		
		/*
			getting child elements of given member from database table
			Auth: Dipanjan
		*/
		function getChildElements($membership_id){
			//fetching values from database
			$child_id = $this->manageContent->getValueWhere("mlm_info","child_id","membership_id",$membership_id);
			//checking for child element
			if($child_id[0]['child_id'] != "")
			{
				//separating the values and storing in an array
				$id = explode(",",$child_id[0]['child_id']);
				foreach($id as $child)
				{
					//getting child membership id
					$child_membership_id = $this->manageContent->getValueWhere("mlm_info","membership_id","id",$child);
					echo '<div class="child_id"><a href="treeStructure.php?member_id='.$child_membership_id[0]['membership_id'].'"><button class="btn btn-primary btn-block">'.$child_membership_id[0]['membership_id'].'</button></a></div>';
				}
			}
			else
			{
				echo '<div class="no_found_text"> No Child Element </div>';
			}
		}
		
		/*
			getting category list from database table
			Auth: Dipanjan
		*/
		function getCategoryListSelectBox()
		{
			$categorys = $this->manageContent->getValue("product_category","*");
			foreach($categorys as $category)
			{
				echo '<option value="'.$category['category'].'">'.$category['category'].'</option>';
			}
		}
		
		/*
			getting coupon category list from database table
			Auth: Dipanjan
		*/
		function getCouponCategoryListSelectBox()
		{
			$categorys = $this->manageContent->getValue("coupon_category","*");
			foreach($categorys as $category)
			{
				echo '<option value="'.$category['category'].'">'.$category['category'].'</option>';
			}
		}
		
		/*
		- getting category list from database table
		- Auth Dipanjan
		*/
		function getCategoryList()
		{
			$categorys = $this->manageContent->getValue("product_category","*");
			foreach($categorys as $category)
			{
				if($category['status'] == 1)
				{
					$status = 'Yes';
				}
				else
				{
					$status = 'No';
				}
				echo '<tr>
					 <td>'.$category['category'].'</td>
					 <td>'.$this->changeDateFormat($category['date']).'</td>
					 <td>'.$status.'</td>
					 <td><a href="editCategory.php?c_id='.$category['id'].'">
					 <button class="btn btn-warning" type="button">
							<span class="icon-pencil"></span>&nbsp;&nbsp;EDIT</button></a>
					</td>
					<td><a href="v-includes/functions/function.deleteCategory.php?c_id='.$category['id'].'">
					<button class=" btn btn-danger" type="button">
						<span class=" icon-trash"></span>&nbsp;&nbsp;DELETE</button></a>
					</td></tr/>';
				
			}
		}
		
		/*
		- getting coupon category list from database table
		- Auth Dipanjan
		*/
		function getCouponCategoryList()
		{
			$coupons = $this->manageContent->getValue("coupon_category","*");
			foreach($coupons as $coupon)
			{
				if($coupon['status'] == 1)
				{
					$status = 'Yes';
				}
				else
				{
					$status = 'No';
				}
				echo '<tr>
					 <td>'.$coupon['category'].'</td>
					 <td>'.$this->changeDateFormat($coupon['date']).'</td>
					 <td>'.$status.'</td>
					 <td><a href="editCouponCategory.php?c_id='.$coupon['id'].'">
					 <button class="btn btn-warning" type="button">
							<span class="icon-pencil"></span>&nbsp;&nbsp;EDIT</button></a>
					</td>
					<td><a href="v-includes/functions/function.deleteCouponCategory.php?c_id='.$coupon['id'].'">
					<button class=" btn btn-danger" type="button">
						<span class=" icon-trash"></span>&nbsp;&nbsp;DELETE</button></a>
					</td></tr/>';
				
			}
		}
		
		/*
		- getting sub category list from database table 
		- Auth Dipanjan
		*/
		function getSubCategoryList()
		{
			$categorys = $this->manageContent->getValue("product_sub_category","*");
			foreach($categorys as $category)
			{
				if($category['status'] == 1)
				{
					$status = 'Yes';
				}
				else
				{
					$status = 'No';
				}
				echo '<tr>
					 <td>'.$category['category'].'</td>
					 <td>'.$category['sub_category'].'</td>
					 <td>'.$this->changeDateFormat($category['date']).'</td>
					 <td>'.$status.'</td>
					 <td><button class="btn btn-warning" type="button">
							<span class="icon-pencil"></span>&nbsp;&nbsp;EDIT</button>
					</td>
					<td><button class=" btn btn-danger" type="button">
						<span class=" icon-trash"></span>&nbsp;&nbsp;DELETE</button>
					</td></tr/>';
				
			}
		}
		
		/*
		- getting invoice details
		- Auth Dipanjan
		*/
		function getInvoiceDetails($from_date,$to_date){
			//getting values from database
			$all_invoices = $this->manageContent->getValueBetween("purchase_log","*","invoice_date",$from_date,$to_date);
			//initialize some parameters
			$totalPrice = 0;
			$totalBasePrice = 0;
			$totalTax22 = 0;
			$totalTax9 = 0;
			//print_r($all_invoices);
			if(!empty($all_invoices[0]))
			{
				foreach($all_invoices as $all_invoice)
				{
					if(!empty($all_invoice['invoice_no']))
					{
						//print_r($all_invoice);
						//checking for member or guest
						if($all_invoice['membership_id'] == 'guest')
						{
							$email_id = $all_invoice['email_id'];
							$price = 'price_guest';
							$tax_id = '';
						}
						else
						{
							$member = $this->manageContent->getValueWhere("member_table","*","membership_id",$all_invoice['membership_id']);
							$member_ac = $this->manageContent->getValueWhere("member_account_details","*","membership_id",$all_invoice['membership_id']);
							$tax_id = $member_ac[0]['ifsc_code'];
							$email_id = $member[0]['email_id'];
							$price = 'price_members';
						}
						//calculating base price and tax values for each product and coupon
						$all_products = $this->manageContent->getValueWhere("purchase_info","*","order_id",$all_invoice['order_id']);
						//print_r($all_products);
						//initialize parameter
						$quantity = "";
						$total_price_without_tax = 0;
						$total_price_with_tax = 0;
						$tax22 = 0;
						$tax_9 = 0;
						foreach($all_products as $all_product){
							$val = $all_product['product_id'];
							if(substr($val,0,1) == 'M')
							{
								$product = $this->manageContent->getValueWhere("membership_product","*","product_id",$val);
								$tax = 0;
								$product_price = $product[0][$price];
								
							}
							else if(substr($val,0,1) == 'C')
							{
								$product = $this->manageContent->getValueWhere("coupon_table","*","coupon_id",$val);
								$tax = $product[0]['tax'];
								$product_price = $product[0][$price];
							}
							else
							{
								$product = $this->manageContent->getValueWhere("product_table","*","product_id",$val);
								$tax = $product[0]['tax'];
								$product_price = $product[0][$price];
							}
							//getting price without tax
							$price_without_tax = ($all_product['quantity'])*($product_price/(1+($tax/100)));
							$price_with_tax = ($all_product['quantity'])*($product_price);
							$total_price_without_tax = $total_price_without_tax + $price_without_tax;
							$total_price_with_tax = $total_price_with_tax + $price_with_tax;
							//for 22% or 9.5% tax
							if($tax == '22%' || $tax == 22)
							{
								$tax22 = $tax22 + ($total_price_with_tax - $total_price_without_tax);
							}
							else if($tax == '9.5%' || $tax == 9.5)
							{
								$tax_9 = $tax_9 + ($total_price_with_tax - $total_price_without_tax);
							}
						}
						//calculating total amount of different categories
						$totalPrice = $totalPrice + $all_invoice['price'];
						$totalBasePrice = $totalBasePrice + $total_price_without_tax;
						$totalTax22 = $totalTax22 + $tax22;
						$totalTax9 = $totalTax9 + $tax_9;
						//showing details in table
						echo '<tr>
								<td>'.$all_invoice['invoice_date'].'</td>
								<td>'.$all_invoice['invoice_no'].'</td>
								<td><a href="orderDetails.php?o_id='.$all_invoice['order_id'].'">'.$all_invoice['order_id'].'</a></td>
								<td>'.$tax_id.'</td>
								<td> €'.$all_invoice['price'].'</td>
								<td> €'.round($total_price_without_tax,2).'</td>
								<td> €'.round($tax22,2).'</td>
								<td> €'.round($tax_9,2).'</td>
							</tr>';
					}
				}
				//showing the total amounts
				echo '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td style="color:#ff0000"><b>TOTAL:</b></td>
						<td> €'.$totalPrice.'</td>
						<td> €'.round($totalBasePrice,2).'</td>
						<td> €'.round($totalTax22,2).'</td>
						<td> €'.round($totalTax9,2).'</td>
					</tr>'; 
			}
			else
			{
				echo "NO INVOICE FOUND";
			}
		}
		
		
		/*
		- getting member list of selected keyword
		- Auth Dipanjan
		*/
		function getSelectedMembers($column_name,$search_key){
			//getting values from database
			$members = $this->manageContent->getValue_likely_descending("member_table","*",$column_name,$search_key);
			if(!empty($members[0]))
			{
				//showing them in table
				foreach($members as $member){
					//checking for membership validiation
					if($member['membership_validiation'] == 1 && $member['membership_activation'] == 1)
					{
						$membership_validiation = 'Valid';
					}
					else
					{
						$membership_validiation = 'Invalid';
					}
					echo '<tr>
							<td>'.$member['membership_id'].'</td>
							<td>'.$member['name'].'</td>
							<td>'.$member['email_id'].'</td>
							<td>'.$this->changeDateFormat($member['expiration_date']).'</td>
							<td>'.$membership_validiation.'</td>';
							if($member['membership_activation'] == 1)
							{
								echo '<td><a href="v-includes/functions/function.terminateMember.php?m_id='.$member['membership_id'].'&validiation=0">
								<button class="btn btn-danger" type="button">
									<span class="icon-pencil"></span>&nbsp;&nbsp;TERMINATE
								</button>
								</a></td>';
							}
							else
							{
								echo '<td><a href="v-includes/functions/function.terminateMember.php?m_id='.$member['membership_id'].'&validiation=1">
								<button class="btn btn-success" type="button">
									<span class="icon-pencil"></span>&nbsp;&nbsp;UPGRADE
								</button>
								</a></td>';
							}
							
							
					echo '</tr>';
				}
			}
			else
			{
				echo "NO MEMBER FOUND";
			}
		}
		
		/*
		- getting member statistics
		- Auth Dipanjan
		*/
		function getMemberStatistics(){
			//getting member list]
			$members = $this->manageContent->getValue("member_table","*");
			if(!empty($members))
			{
				//initialize parameters
				$total_member = 0;
				$total_valid_member = 0;
				$total_invalid_member = 0;
				foreach($members as $member)
				{
					$total_member = $total_member + 1;
					//checking for validiation
					if($member['membership_validiation'] == 1 && $member['membership_activation'] == 1)
					{
						$total_valid_member = $total_valid_member + 1;
					}
					else
					{
						$total_invalid_member = $total_invalid_member + 1;
					}
				}
				//showing the values in page
				echo '<div class="row-fluid">
						<p class="trust_balence_outline"><span class="system_heading">Total Number Of Member:</span>
						<span class="system_credit">'.$total_member.'</span></p>
					</div>
					<div class="row-fluid">
						<p class="trust_balence_outline"><span class="system_heading">Total Number Of Valid Member:</span>
						<span class="system_debit">'.$total_valid_member.'</span></p>
					</div>
					<div class="row-fluid">
						<p class="trust_balence_outline"><span class="system_heading">Total Number Of Invalid Member:</span>
						<span class="system_balence">'.$total_invalid_member.'</span></p>
					</div>';
			}
			else
			{
				echo 'There Are No Memeber In The System';
			}
		}
		
		
		/*
		- getting system balence
		- Auth Dipanjan
		*/
		function getSystemBalence(){
			//getting money transfer details from database
			$balences = $this->manageContent->getValue("money_transfer_log","*");
			if(!empty($balences))
			{
				//initialize the variables
				$credit = 0;
				$debit = 0;
				foreach($balences as $balence){
					//calculating the total credit
					$credit = $credit + $balence['credit'];
					//calculating the total debit
					$debit = $debit + $balence['debit'];
				}
				//calculating the system balence
				$system_balence = $this->manageContent->getLastValue("money_transfer_log","system_balence","id");
				//showing the values in page
				echo '<div class="row-fluid">
						<p class="trust_balence_outline"><span class="system_heading">System Credit Balance:</span>
						<span class="system_credit"> € '.$credit.'</span></p>
					</div>
					<div class="row-fluid">
						<p class="trust_balence_outline"><span class="system_heading">System Debit Balance:</span>
						<span class="system_debit"> € '.$debit.'</span></p>
					</div>
					<div class="row-fluid">
						<p class="trust_balence_outline"><span class="system_heading">Total System Balance:</span>
						<span class="system_balence"> € '.$system_balence[0]['system_balence'].'</span></p>
					</div>';
			}
			else
			{
				//showing the values in page
				echo '<div class="row-fluid">
						<p class="trust_balence_outline"><span class="system_heading">System Credit Balance:</span>
						<span class="system_credit"> € 0</span></p>
					</div>
					<div class="row-fluid">
						<p class="trust_balence_outline"><span class="system_heading">System Debit Balance:</span>
						<span class="system_debit"> € 0</span></p>
					</div>
					<div class="row-fluid">
						<p class="trust_balence_outline"><span class="system_heading">Total System Balance:</span>
						<span class="system_balence"> € 0</span></p>
					</div>';
			}
				
		}
		
		/*
		- getting trust account Details
		- Auth Dipanjan
		*/
		function getTrustBalance(){
			$account_no = "admin007";
			//getting money transfer details from database
			$transaction = $this->manageContent->getValueWhere_descending("money_transfer_log","*","membership_id",$account_no);
			if(!empty($transaction))
			{
				//initialize the variables
				$sl_no = 1;
				$total_amount = 0;
				foreach($transaction as $transactions){
					//checking for only debited amount
					if(!empty($transactions['debit']))
					{	
						//checking for membership product or not
						if(substr($transactions['product_id'],0,2) == 'M_')
						{
							//fetching the name of product from product table
							$product_details = $this->manageContent->getValueWhere("membership_product","*","product_id",$transactions['product_id']);
							$product_name = $product_details[0]['product_name'];
						}
						else if(substr($transactions['product_id'],0,1) == 'C')
						{
							$coupon_details = $this->manageContent->getValueWhere("coupon_table","*","coupon_id",$transactions['product_id']);
							$product_name = $coupon_details[0]['coupon_name'];
						}
						else
						{
							//fetching the name of product from product table
							$product_details = $this->manageContent->getValueWhere("product_table","*","product_id",$transactions['product_id']);
							$product_name = $product_details[0]['product_name'];
						}
						
						//showing the details of money debited in detail
						echo '<tr>
								<td>'.$sl_no.'</td>
								<td>'.$product_name.'</td>
								<td>'.$transactions['product_quantity'].'</td>
								<td>'.$this->changeDateFormat($transactions['date']).'</td>
								<td> € '.$transactions['debit'].'</td>
							</tr>';
							
							// total amount calculation
							$total_amount = $total_amount + $transactions['debit'];
							//increment of serial_no variable
							$sl_no++;
					}
				}
				return $total_amount;
			}
			else
			{
				return 0;
			}
			
		}
		
		/*
		- getting potential amount
		- Auth Dipanjan
		*/
		function getPotentialAmount(){
			$account_no = "potentialMoney";
			//getting money transfer details from database
			$transaction = $this->manageContent->getValueWhere_descending("money_transfer_log","*","membership_id",$account_no);
			if(!empty($transaction))
			{
				//initialize the variables
				$sl_no = 1;
				$total_amount = 0;
				foreach($transaction as $transactions){
					//checking for only debited amount
					if(!empty($transactions['debit']))
					{	
						//checking for membership product or not
						if(substr($transactions['product_id'],0,2) == 'M_')
						{
							//fetching the name of product from product table
							$product_details = $this->manageContent->getValueWhere("membership_product","*","product_id",$transactions['product_id']);
							$product_name = $product_details[0]['product_name'];
						}
						else if(substr($transactions['product_id'],0,1) == 'C')
						{
							$coupon_details = $this->manageContent->getValueWhere("coupon_table","*","coupon_id",$transactions['product_id']);
							$product_name = $coupon_details[0]['coupon_name'];
						}
						else
						{
							//fetching the name of product from product table
							$product_details = $this->manageContent->getValueWhere("product_table","*","product_id",$transactions['product_id']);
							$product_name = $product_details[0]['product_name'];
						}
						//getting member details
						$memberDetails = $this->manageContent->getValueWhere("member_table","*","membership_id",$transactions['notes']);
						
						//showing the details of money debited in detail
						echo '<tr>
								<td>'.$sl_no.'</td>
								<td>'.$memberDetails[0]['name'].'</td>
								<td>'.$product_name.'</td>
								<td>'.$transactions['product_quantity'].'</td>
								<td>'.$this->changeDateFormat($transactions['date']).'</td>
								<td> € '.$transactions['debit'].'</td>
							</tr>';
							
							// total amount calculation
							$total_amount = $total_amount + $transactions['debit'];
							//increment of serial_no variable
							$sl_no++;
					}
				}
				return $total_amount;
			}
			else
			{
				return 0;
			}
			
		}
		
		/*
		- getting credit details of the system
		- Auth Dipanjan
		*/
		function creditDetails(){
			//getting money transfer details from database
			$transaction = $this->manageContent->getValue_descending("money_transfer_log","*");
			//initialize the variables
			$sl_no = 1;
			$credit_amount = 0;
			if(!empty($transaction))
			{
				foreach($transaction as $transactions){
					//checking for only debited amount
					if(!empty($transactions['credit']))
					{	
						//checking for membership product or not
						if(substr($transactions['product_id'],0,2) == 'M_')
						{
							//fetching the name of product from product table
							$product_details = $this->manageContent->getValueWhere("membership_product","*","product_id",$transactions['product_id']);
							$product_name = $product_details[0]['product_name'];
						}
						else if(substr($transactions['product_id'],0,1) == 'C')
						{
							$coupon_details = $this->manageContent->getValueWhere("coupon_table","*","coupon_id",$transactions['product_id']);
							$product_name = $coupon_details[0]['coupon_name'];
						}
						else
						{
							//fetching the name of product from product table
							$product_details = $this->manageContent->getValueWhere("product_table","*","product_id",$transactions['product_id']);
							$product_name = $product_details[0]['product_name'];
						}
						
						//checking that member or guest was bought the product
						if(substr($transactions['membership_id'],0,6) == 'member')
						{
							//getting member details
							$member = $this->manageContent->getValueWhere("member_table","*","membership_id",$transactions['membership_id']);
							$member_name = $member[0]['name'];
						}
						else
						{
							$member_name = 'Guest';
						}
						
						//showing the details of money debited in detail
						echo '<tr>
								<td>'.$sl_no.'</td>
								<td>';
								//checking for member or guest
								if($member_name != 'Guest')
								{
									echo '<a href="listMembers.php?name='.$member_name.'">'.$member_name.'</a>';
								}
								else
								{
									echo $member_name;
								}	
						echo  '</td>
								<td>'.$product_name.'</td>
								<td>'.$transactions['product_quantity'].'</td>
								<td>'.$this->changeDateFormat($transactions['date']).'</td>
								<td> € '.$transactions['credit'].'</td>
							</tr>';
							
							// total amount calculation
							$credit_amount = $credit_amount + $transactions['credit'];
							//increment of serial_no variable
							$sl_no++;
					}
				}
			}
			return $credit_amount;
		}
		
		/*
		- getting debit details of the system
		- Auth Dipanjan
		*/
		function debitDetails(){
			//getting money transfer details from database
			$transaction = $this->manageContent->getValue_descending("money_transfer_log","*");
			if(!empty($transaction))
			{
				//initialize the variables
				$sl_no = 1;
				$debit_amount = 0;
				foreach($transaction as $transactions){
					//checking for only debited amount
					if(!empty($transactions['debit']))
					{	
						//checking for membership product or not
						if(substr($transactions['product_id'],0,2) == 'M_')
						{
							//fetching the name of product from product table
							$product_details = $this->manageContent->getValueWhere("membership_product","*","product_id",$transactions['product_id']);
							$product_name = $product_details[0]['product_name'];
						}
						else if(substr($transactions['product_id'],0,1) == 'C')
						{
							$coupon_details = $this->manageContent->getValueWhere("coupon_table","*","coupon_id",$transactions['product_id']);
							$product_name = $coupon_details[0]['coupon_name'];
						}
						else
						{
							//fetching the name of product from product table
							$product_details = $this->manageContent->getValueWhere("product_table","*","product_id",$transactions['product_id']);
							$product_name = $product_details[0]['product_name'];
						}
						
						//checking that member or guest was bought the product
						if(substr($transactions['membership_id'],0,6) == 'member')
						{
							//getting member details
							$member = $this->manageContent->getValueWhere("member_table","*","membership_id",$transactions['membership_id']);
							$member_name = $member[0]['name'];
						}
						else
						{
							$member_name = 'Trust Account';
						}
						
						//showing the details of money debited in detail
						echo '<tr>
								<td>'.$sl_no.'</td>
								<td>';
								//checking for member or guest
								if($member_name != 'Trust Account')
								{
									echo '<a href="listMembers.php?name='.$member_name.'">'.$member_name.'</a>';
								}
								else
								{
									echo $member_name;
								}	
						echo  '</td>
								<td>'.$product_name.'</td>
								<td>'.$transactions['product_quantity'].'</td>
								<td>'.$this->changeDateFormat($transactions['date']).'</td>
								<td> € '.$transactions['debit'].'</td>
							</tr>';
							
							// total amount calculation
							$debit_amount = $debit_amount + $transactions['debit'];
							//increment of serial_no variable
							$sl_no++;
					}
				}
				return $debit_amount;
			}
			else
			{
				return 0;
			}
			
		}


        /*
         * function to get all the custom pages
         * Auth: Vasu Naman
         */
        
        public function getPageList()
        {
            //taking all page list in an array
            $customPages = $this->manageContent->getValue('mypage','*');
            foreach ($customPages as $key => $customPage) {
                echo '<tr>';
                    echo '<td>'.$customPage['id'].'</td>';
                    echo '<td>'.$customPage['name'].'</td>';
                    echo '<td>'.substr($customPage['content'],0,50).'</td>';
                    echo '<td><a href="editMyPageDetails.php?id='.$customPage['id'].'"><button type="button" class="btn btn-primary">Edit</button></a></td>';
                    if($customPage['status'] == 0){
                        $button = 'Enable';
                        $buttonClass = 'btn-success';
						$changeValue = 1;
                    }
                    else if($customPage['status'] == 1){
                        $button = 'disable';
                        $buttonClass = 'btn-danger';
						$changeValue = 0;
                    }
                    
                    echo '<td><a href="v-includes/functions/function.updateStatusMyPage.php?id='.$customPage['id'].'&&action='.$changeValue.'"><button type="button" class="btn '.$buttonClass.'">'.$button.'</button></a></td>';
                    echo '<td><a href="v-includes/functions/function.deleteMyPage.php?id='.$customPage['id'].'"><button type="button" class="btn btn-danger">Delete</button></a></td>';
                
                echo '<tr>';
            }
            
        }
		
		/*
			method for getting member details
			Auth: Dipanjan
		*/
		function getMypageDetails($id){
			//fetching values from database
			$mypage = $this->manageContent->getValueWhere("mypage","*","id",$id);
			//showing the values in ui layer form
			echo '<div class="form-control v-form">
                    <label class="control-label">Name of your Page</label>
                    <input type="text" id="pageName" placeholder="Please Enter the Name of your page" class="textbox1" name="category" value="'.$mypage[0]['name'].'"/>
                </div>
                
                <div class="form-control v-form">
                    <label class="control-label">Enter the content</label><br><br>
                    <textarea type="text" id="editor1" placeholder="Description" class="textbox1 textarea" name="description">'.$mypage[0]['content'].'</textarea>
                </div>   
                 
                <div class="form-control v-form">
                    <div class="function_result"></div>
					<input type="hidden" name="id" value="'.$mypage[0]['id'].'">
                    <input type="submit" value="UPDATE" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>';
		}
		
		/*
			getting sold product list from database table
			Auth: Dipanjan
		*/
		function soldProductList($from_date,$to_date){
			//fetching values from database
			$purchase_details = $this->manageContent->getValueBetweenDescending("purchase_log","*","date",$from_date,$to_date);
			if(!empty($purchase_details))
			{
				//showing the values in form
				foreach($purchase_details as $purchase_detail)
				{
					//getting the values of purchase info table
					$purchase_info = $this->manageContent->getValue_twoCoditions("purchase_info","*","order_id",$purchase_detail['order_id'],"payment_status",1);
					if($purchase_detail['membership_id'] == 'guest')
					{
						$member_name = 'guest';
					}
					else
					{
						//getting member details from database
						$member = $this->manageContent->getValueWhere("member_table","name","membership_id",$purchase_detail['membership_id']);
						$member_name = $member[0]['name'];
					}
					if($purchase_info[0]['payment_status'] == 1)
					{
						echo '<tbody>
								<tr>
									<td><a href="orderDetails.php?o_id='.$purchase_info[0]['order_id'].'">'.$purchase_info[0]['order_id'].'</a></td>
									<td>'.$member_name.'</td>
									<td>'.$this->anOrderProductList($purchase_info[0]['order_id']).'</td>
									<td>'.$this->anOrderQuantityList($purchase_info[0]['order_id']).'</td>
									<td>'.$this->changeDateFormat($purchase_detail['date']).'</td>
									<td>'.$purchase_detail['payment_method'].'</td>
									<td> €'.$purchase_detail['price'].'</td>
								</tr>
							</tbody>';	
					}
				}
			}
		}
		
		/*
			getting sold products list of an order
			Auth: Dipanjan
		*/
		function anOrderProductList($order_id){
			//fetching values from database
			$products = $this->manageContent->getValueWhere("purchase_info","product_id","order_id",$order_id);
			//initialize a product list string
			$list = "";
			foreach($products as $product){
				//getting product name
				if(substr($product['product_id'],0,1) == 'M')
				{
					$product_name = $this->manageContent->getValueWhere("membership_product","product_name","product_id",$product['product_id']);
					$name = $product_name[0]['product_name'];
				}
				else if(substr($product['product_id'],0,1) == 'C')
				{
					$product_name = $this->manageContent->getValueWhere("coupon_table","coupon_name","coupon_id",$product['product_id']);
					$name = $product_name[0]['coupon_name'];
				}
				else
				{
					$product_name = $this->manageContent->getValueWhere("product_table","product_name","product_id",$product['product_id']);
					$name = $product_name[0]['product_name'];
				}
				$list = $list."<br>".$name;
			}
			//cancelling 1st space from list
			$list = substr($list,4);
			return($list);
		}
		
		/*
			getting sold quantity list of an order
			Auth: Dipanjan
		*/
		function anOrderQuantityList($order_id){
			//fetching values from database
			$products = $this->manageContent->getValueWhere("purchase_info","quantity","order_id",$order_id);
			//initialize a product list string
			$list = "";
			foreach($products as $product){
				$list = $list."<br>".$product['quantity'];
			}
			//cancelling 1st space from list
			$list = substr($list,4);
			return($list);
		}
		
		/*
			getting order details
			Auth: Dipanjan
		*/
		function getOrderDetails($order_id){
			//fetching values from database
			$order_details = $this->manageContent->getValueWhere("purchase_log","*","order_id",$order_id);
			//geting member_name
			if($order_details[0]['membership_id'] == 'guest')
			{
				$member_name = 'guest';
			}
			else
			{
				$member = $this->manageContent->getValueWhere("member_table","name","membership_id",$order_details[0]['membership_id']);
				$member_name = $member[0]['name'];
			}
			//getting product_details
			$product_details = $this->manageContent->getValueWhere("purchase_info","*","order_id",$order_id);
			//getting product list in a order
			$list = "";
			foreach($product_details as $product_detail){
				//getting product_name
				if(substr($product_detail['product_id'],0,1) == 'M')
				{
					$product = $this->manageContent->getValueWhere("membership_product","product_name","product_id",$product_detail['product_id']);
					$product_name = $product[0]['product_name'];
				}
				else if(substr($product_detail['product_id'],0,1) == 'C')
				{
					$product = $this->manageContent->getValueWhere("coupon_table","coupon_name","coupon_id",$product_detail['product_id']);
					$product_name = $product[0]['coupon_name'];
				}
				else
				{
					$product = $this->manageContent->getValueWhere("product_table","product_name","product_id",$product_detail['product_id']);
					$product_name = $product[0]['product_name'];
				}
				$list = $list."<br>".$product_name." = ".$product_detail['quantity']." piece";
			}
			//final output of list
			$list = substr($list,4);
			
			//printing the details
			echo '<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">Order Id:</div>
					<div class="span8 right_text">'.$order_id.'</div>
				</div>
				<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">Name:</div>
					<div class="span8 right_text">'.$member_name.'</div>
				</div>
				<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">Product Name And Quantity:</div>
					<div class="span8 right_text">'.$list.'</div>
				</div>
				<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">Total Amount:</div>
					<div class="span8 right_text"> €'.$order_details[0]['price'].'</div>
				</div>
				<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">IP Address:</div>
					<div class="span8 right_text">'.$order_details[0]['ip_address'].'</div>
				</div>
				<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">Date:</div>
					<div class="span8 right_text">'.$this->changeDateFormat($order_details[0]['date']).'</div>
				</div>
				<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">Shipping Address:</div>
					<div class="span8 right_text">'.$order_details[0]['shipping_address'].'</div>
				</div>
				<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">Shipping Comments:</div>
					<div class="span8 right_text">'.$order_details[0]['shipping_comments'].'</div>
				</div>
				<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">Order Comments:</div>
					<div class="span8 right_text">'.$order_details[0]['order_comments'].'</div>
				</div>
				<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">Payment Method:</div>
					<div class="span8 right_text">'.$order_details[0]['payment_method'].'</div>
				</div>';
				if($product_details[0]['payment_status'] == 1)
				{
					$p_status = 'confirmed';
				}
				else
				{
					$p_status = 'Not confirmed';
				}
			echo   '<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">Payment Status:</div>
					<div class="span8 right_text">'.$p_status.'</div>
				</div>';	
				if($order_details[0]['delivery_status'] == 1)
				{
					$d_status = 'Delivered';
					$btn = "";
				}
				elseif($order_details[0]['delivery_status'] == 0 && $product_details[0]['payment_request'] == 'Undo')
				{
					$d_status = 'Product Returned';
					$btn = "";
				}
				else
				{
					$d_status = 'Not Delivered';
					$btn = '<a href="v-includes/functions/function.deliverProduct.php?o_id='.$order_id.'"><button class="btn btn-inverse btn-large">DELIVER</button></a>';
				}
			echo '<div class="row-fluid text_para">
					<div class="span3 offset1 left_text">Delivery Status:</div>
					<div class="span8 right_text">'.$d_status.'</div>
				</div>';
			echo  '<div class="row-fluid text_para">
					<div class="span3 offset1 left_text"></div>
					<div class="span8 right_text">'.$btn.'</div>
				</div>';
		}
		
		/*
			getting purchase details of product
			Auth: Dipanjan
		*/
		function productPurchaseDetails($column_name,$search_key,$table_name){
			//getting database values
			$product = $this->manageContent->getValue_likely_descending($table_name,"product_id",$column_name,$search_key);
			if(!empty($product[0]['product_id']))
			{
				//initialize some parameter to calculate total number of product sold
				$product_sold = 0;
				$product_processing = 0;
				foreach($product as $product_id){
					//getting purchase details of this product id
					$purchases = $this->manageContent->getValueWhere("purchase_info","*","product_id",$product_id['product_id']);
					if(!empty($purchases))
					{
						foreach($purchases as $purchase){
							//getting product_name
							$p_name = $this->manageContent->getValueWhere($table_name,"*","product_id",$product_id['product_id']);
							//getting values from purchase log
							$purchase_info = $this->manageContent->getValueWhere("purchase_log","*","order_id",$purchase['order_id']);
							//geting member_name
							if($purchase_info[0]['membership_id'] == 'guest')
							{
								$member_name = 'guest';
							}
							else
							{
								$member = $this->manageContent->getValueWhere("member_table","name","membership_id",$purchase_info[0]['membership_id']);
								$member_name = $member[0]['name'];
							}
							//getting payment status value
							if($purchase['payment_status'] == 1)
							{
								$p_status = 'confirmed';
								$product_sold = $product_sold + $purchase['quantity'];
							}
							else if(!empty($purchase))
							{
								$p_status = 'Not confirmed';
								$product_processing = $product_processing + $purchase['quantity'];
							}
							else
							{
								$p_status = 'No Data';
							}
							echo '<tbody>
									<tr>
										<td><a href="orderDetails.php?o_id='.$purchase['order_id'].'">'.$purchase['order_id'].'</a></td>
										<td>'.$member_name.'</td>
										<td>'.$p_name[0]['product_name'].'</td>
										<td>'.$purchase['quantity'].'</td>
										<td>'.$this->changeDateFormat($purchase['date']).'</td>
										<td>'.$purchase['payment_method'].'</td>
										<td>'.$p_status.'</td>
									</tr>
								</tbody>';
						}
					}
					
				}
				//printing the total sold product
				echo '<div class="row-fluid">
						<p class="trust_balence_outline"><span class="trust_balance">No. of Product Sold:</span>
						<span class="trust_amount">'.$product_sold.'</span></p>
					</div>';
				if($product_processing != 0)
				{
					echo '<div class="row-fluid">
							<p class="trust_balence_outline"><span class="trust_balance">No. of Product on Processing:</span>
							<span class="trust_amount">'.$product_processing.'</span></p>
						</div>';
				}
				
			}
			else
			{
				echo 'No Product Found';
			}
		}
		
		/*
			getting order details
			Auth: Dipanjan
		*/
		function productOrderDetails($category){
			//getting database values
			$orders = $this->manageContent->getValue_likely_descending("purchase_log","*","membership_id",$category);
			if(!empty($orders))
			{
				foreach($orders as $order){
					//getting the values of purchase info table
					$purchase_info = $this->manageContent->getValueWhere("purchase_info","*","order_id",$order['order_id']);
					if($purchase_info[0]['payment_status'] == 1)
					{
						$p_status = 'Confirmed';
					}
					else
					{
						$p_status = 'Not Confirmed';
					}
					//getting delivery details
					if($order['delivery_status'] == 1)
					{
						$d_status = 'Delivered';
					}
					elseif($order['delivery_status'] == 0 && $purchase_info[0]['payment_request'] == 'Undo')
					{
						$d_status = 'Product Returned';
					}
					else
					{
						$d_status = 'Not Delivered';
					}
					echo '<tbody>
							<tr>
								<td><a href="orderDetails.php?o_id='.$order['order_id'].'">'.$order['order_id'].'</a></td>
								<td>'.$this->changeDateFormat($order['date']).'</td>
								<td>'.$order['payment_method'].'</td>
								<td>'.$p_status.'</td>
								<td>'.$d_status.'</td>
							</tr>
						</tbody>';
					
				}
			}
		}
		
		/*
			getting members purchase history
			Auth: Dipanjan
		*/
		function getPurchaseHistory($membership_id){
			//fetching values from database
			$purchases = $this->manageContent->getValueWhere("purchase_log","*","membership_id",$membership_id);
			//checking for empty result
			if(!empty($purchases[0]))
			{
				foreach($purchases as $purchase){
					//getting purchase info values
					$purchase_info = $this->manageContent->getValueWhere("purchase_info","*","order_id",$purchase['order_id']);
					//checking for payment status
					if($purchase_info[0]['payment_status'] == 0)
					{
						$payment_status = 'Not Confirmed';
					}
					else
					{
						$payment_status = 'Confirmed';
					}
					//checking for delivary status
					if($purchase['delivery_status'] == 0 && $purchase_info[0]['payment_request'] != 'Undo')
					{
						$delivery_status = 'Not Delivered';
					}
					elseif($purchase['delivery_status'] == 0 && $purchase_info[0]['payment_request'] == 'Undo')
					{
						$delivery_status = 'Product Returned';
					}
					else
					{
						$delivery_status = 'Delivered';
					}
					//showing them in table
					echo '<tr>
							<td>'.$purchase['order_id'].'</td>
							<td>'.$this->anOrderProductList($purchase['order_id']).'</td>
							<td>'.$this->anOrderQuantityList($purchase['order_id']).'</td>
							<td>  €'.$purchase['price'].'</td>
							<td>'.$this->changeDateFormat($purchase['date']).'</td>
							<td>'.$payment_status.'</td>
							<td>'.$delivery_status.'</td>
						</tr>';
				}
				
			}
			else
			{
				echo 'NO ORDER LIST';
			}
		}
		
		/*
			getting withdraw statistics of given date interval
			Auth: Dipanjan
		*/
		function getWithdrawStatistics($from_date,$to_date){
			//getting values from databases
			$withdraws = $this->manageContent->getValueBetweenDescending("withdraw_log","*","date",$from_date,$to_date);
			//checking for empty result
			if(!empty($withdraws[0]))
			{
				foreach($withdraws as $withdraw)
				{
					//checking for frozen money
					if($withdraw['frozen_money'] == 1)
					{
						$frozen_money = 'Yes';
					}
					else
					{
						$frozen_money = 'No';
					}
					//checking for withdraw confirmation
					if($withdraw['status'] == 1)
					{
						$status = 'Confirmed';
					}
					else
					{
						$status = 'Processing';
					}
					//getting member details
					$member = $this->manageContent->getValueWhere("member_table","*","membership_id",$withdraw['membership_id']);
					$member_ac = $this->manageContent->getValueWhere("member_account_details","*","membership_id",$withdraw['membership_id']);
					//showing info in table
					echo '<tr>
							<td>'.$this->changeDateFormat($withdraw['date']).'</td>
							<td><a href="listMembers.php?membership_id='.$withdraw['membership_id'].'">'.$withdraw['membership_id'].'</a></td>
							<td>'.$member[0]['name'].'</td>
							<td>'.$member_ac[0]['ifsc_code'].'</td>
							<td>'.$frozen_money.'</td>
							<td>  €'.$withdraw['withdraw_amount'].'</td>
							<td>'.$status.'</td>
						</tr>';
				}
			}
			else
			{
				echo 'NO WITHDRAW LIST';
			}
		}
		
		/*
			getting members withdraw history
			Auth: Dipanjan
		*/
		function getWithdrawHistory($membership_id){
			//fetching values from database
			$withdraws = $this->manageContent->getValueWhere("withdraw_log","*","membership_id",$membership_id);
			//checking for empty result
			if(!empty($withdraws[0]))
			{
				foreach($withdraws as $withdraw){
					//checking for frozen money
					if($withdraw['frozen_money'] == 1)
					{
						$frozen_money = 'Yes';
					}
					else
					{
						$frozen_money = 'No';
					}
					//checking for withdraw confirmation
					if($withdraw['status'] == 1)
					{
						$confirm = 'Confirmed';
					}
					else
					{
						$confirm = 'Processing';
					}
					//showing them in table
					echo '<tr>
							<td>'.$withdraw['withdraw_order_id'].'</td>
							<td>'.$this->changeDateFormat($withdraw['date']).'</td>
							<td>'.$frozen_money.'</td>
							<td>  €'.$withdraw['withdraw_amount'].'</td>
							<td>'.$confirm.'</td>
						</tr>';
				}
			}
			else
			{
				echo 'NO WITHDRAW LIST';
			}
		}
		
		/*
			getting ewallet details of member from database table
			Auth: Dipanjan
		*/
		function getEwalletValue($membership_id,$frozen_value){
			//getting all transaction of a member
			$transaction = $this->manageContent->
			getValue_twoCoditions("money_transfer_log","*","membership_id",$membership_id,"frozen_money",$frozen_value);
			//initialize a variable for serial no calculation
			$sl_no = 1;
			//initialize a variable for total amount calculation
			$total_amount = 0;
			$withdraw_amount = 0;
			$withdraw_requested_amount = 0;
			$purchase_by_account = 0;
			$net_amount = 0;
			$add_money = 0;
			if(count($transaction[0]) > 0)
			{  
				foreach($transaction as $transactions){
					//checking for only debited amount
					if(!empty($transactions['debit']))
					{	
						if(substr($transactions['product_id'],0,1) == 'C')
						{
							//fetching the name of product from product table
							$coupon_details = $this->manageContent->
							getValueWhere("coupon_table","*","coupon_id",$transactions['product_id']);
							//showing the details of money debited in detail
							echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$coupon_details[0]['coupon_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';
								
								// total amount calculation
								$total_amount = $total_amount + $transactions['debit'];
								//increment of serial_no variable
								$sl_no++;
						}
						else
						{
							//checking for membership product or not
							if(substr($transactions['product_id'],0,2) == 'M_')
							{
								$table_name = 'membership_product';
							}
							else
							{
								$table_name = 'product_table';
							}
							//fetching the name of product from product table
							$product_details = $this->manageContent->
							getValueWhere($table_name,"*","product_id",$transactions['product_id']);
							//showing the details of money debited in detail
							echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$product_details[0]['product_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';
								
								// total amount calculation
								$total_amount = $total_amount + $transactions['debit'];
								//increment of serial_no variable
								$sl_no++;
						}
						
					}
				}
				//getting the withdrawal amount from database
				$withdraws = $this->manageContent->
			getValue_twoCoditions("withdraw_log","*","membership_id",$membership_id,"frozen_money",$frozen_value);
				//getting the amount withdrawal to that member
				if(!empty($withdraws[0]))
				{
					foreach($withdraws as $withdrawal)
					{
						if(substr($withdrawal['withdraw_order_id'],0,8) == 'withdraw')
						{
							//checking for status of money transfer
							if($withdrawal['status'] == 1)
							{
								$withdraw_amount = $withdraw_amount + $withdrawal['withdraw_amount'];
							}
							//checking for requested amount
							else
							{
								$withdraw_requested_amount = $withdraw_requested_amount + $withdrawal['withdraw_amount'];
							}
						}
						else
						{
							$purchase_by_account = $purchase_by_account + $withdrawal['withdraw_amount'];
						}
					}
				}
			}
			else
			{
				echo "";
			}
			if($frozen_value == 0)
			{
				//calculating add money to ewallet
				$add_money_details = $this->manageContent->getValue_twoCoditions("addmoney_info","*","membership_id",$membership_id,"status",1);
				if(!empty($add_money_details))
				{
					foreach($add_money_details as $add_money_detail)
					{
						$add_money = $add_money + $add_money_detail['amount'];
					}
				}
			}
				
			//showing total amount in table
			echo '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="total_amount"> Gross Amount: </td>
					<td>  € '.$total_amount.'</td>
				</tr>';
			
			echo  '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="total_amount"> Withdrew Amount: </td>
					<td>  € '.$withdraw_amount.'</td>
				</tr>';
			
			if(!empty($withdraw_requested_amount))
			{
				echo '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="total_amount"> Amount Requested for Withdrawal: </td>
						<td>  € '.$withdraw_requested_amount.'</td>
					</tr>';
			}
			if(!empty($purchase_by_account))
			{
				echo '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="total_amount"> Product Purchase Amount: </td>
						<td>  € '.$purchase_by_account.'</td>
					</tr>';
			}
			if(!empty($add_money))
			{
				echo '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="total_amount"> Add Money To EWallet: </td>
						<td>  € '.$add_money.'</td>
					</tr>';
			}
			if((($total_amount + $add_money) - 
			($withdraw_requested_amount + $purchase_by_account + $withdraw_amount)) != 0)
			{
				echo '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="total_amount"> Net Amount: </td>
					<td>  € '.(($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount)).'</td>
				</tr>';
				return (($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount));
			}
			else
			{
				echo '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="total_amount"> Net Amount: </td>
					<td>  € '.(int)(($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount)).'</td>
				</tr>';
				return (int)(($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount));
			}
			
		}
		
		/*
		 method for membership extension
		 Auth: Dipanjan
		*/
		function memberExtension(){
			//getting valid member list
			$allMembers = $this->manageContent->getValueWhere("member_table","*","membership_activation",1);
			//getting current date/time
			$getdate = getdate();
			$date = $getdate['year']."-".$getdate['mon']."-".$getdate['mday']; 
			if(!empty($allMembers[0]))
			{
				foreach($allMembers as $allMember)
				{
					//finding date difference of expiry date and today
					$date1 = new DateTime($date);
					$date2 = new DateTime($allMember['expiration_date']);
					$diff = $date2->diff($date1);
					$date_diff = $diff->format("%a");
					
					if($date_diff == 45)
					{
						echo '<tr>
								<td>'.$allMember['membership_id'].'</td>
								<td>'.$allMember['name'].'</td>
								<td>'.$this->changeDateFormat($allMember['date']).'</td>
								<td>'.$this->changeDateFormat($allMember['expiration_date']).'</td>
								<td style="color:red;"> 45 Days </td>
								<td><a href="membership_extend_mail.php?m_id='.$allMember['membership_id'].'"><button class="btn btn-danger" type="button"><span class="icon-pencil"></span>&nbsp;&nbsp;SEND MAIL</button></a></td>
							</tr>';
					}
					
					else if($date_diff == 30)
					{
						echo '<tr>
								<td>'.$allMember['membership_id'].'</td>
								<td>'.$allMember['name'].'</td>
								<td>'.$this->changeDateFormat($allMember['date']).'</td>
								<td>'.$this->changeDateFormat($allMember['expiration_date']).'</td>
								<td style="color:red;"> 30 Days </td>
								<td><a href="membership_extend_mail.php?m_id='.$allMember['membership_id'].'"><button class="btn btn-danger" type="button"><span class="icon-pencil"></span>&nbsp;&nbsp;SEND MAIL</button></a></td>
							</tr>';
					}
					
					else if($date_diff == 21)
					{
						echo '<tr>
								<td>'.$allMember['membership_id'].'</td>
								<td>'.$allMember['name'].'</td>
								<td>'.$this->changeDateFormat($allMember['date']).'</td>
								<td>'.$this->changeDateFormat($allMember['expiration_date']).'</td>
								<td style="color:red;"> 21 Days </td>
								<td><a href="membership_extend_mail.php?m_id='.$allMember['membership_id'].'"><button class="btn btn-danger" type="button"><span class="icon-pencil"></span>&nbsp;&nbsp;SEND MAIL</button></a></td>
							</tr>';
					}
					
					else if($date_diff == 14)
					{
						echo '<tr>
								<td>'.$allMember['membership_id'].'</td>
								<td>'.$allMember['name'].'</td>
								<td>'.$this->changeDateFormat($allMember['date']).'</td>
								<td>'.$this->changeDateFormat($allMember['expiration_date']).'</td>
								<td style="color:red;"> 14 Days </td>
								<td><a href="membership_extend_mail.php?m_id='.$allMember['membership_id'].'"><button class="btn btn-danger" type="button"><span class="icon-pencil"></span>&nbsp;&nbsp;SEND MAIL</button></a></td>
							</tr>';
					}
					
					else if($date_diff == 7)
					{
						echo '<tr>
								<td>'.$allMember['membership_id'].'</td>
								<td>'.$allMember['name'].'</td>
								<td>'.$this->changeDateFormat($allMember['date']).'</td>
								<td>'.$this->changeDateFormat($allMember['expiration_date']).'</td>
								<td style="color:red;"> 7 Days </td>
								<td><a href="membership_extend_mail.php?m_id='.$allMember['membership_id'].'"><button class="btn btn-danger" type="button"><span class="icon-pencil"></span>&nbsp;&nbsp;SEND MAIL</button></a></td>
							</tr>';
					}
					
					else if($date_diff == 3)
					{
						echo '<tr>
								<td>'.$allMember['membership_id'].'</td>
								<td>'.$allMember['name'].'</td>
								<td>'.$this->changeDateFormat($allMember['date']).'</td>
								<td>'.$this->changeDateFormat($allMember['expiration_date']).'</td>
								<td style="color:red;"> 3 Days </td>
								<td><a href="membership_extend_mail.php?m_id='.$allMember['membership_id'].'"><button class="btn btn-danger" type="button"><span class="icon-pencil"></span>&nbsp;&nbsp;SEND MAIL</button></a></td>
							</tr>';
					}
					
					else if($date_diff == 1)
					{
						echo '<tr>
								<td>'.$allMember['membership_id'].'</td>
								<td>'.$allMember['name'].'</td>
								<td>'.$this->changeDateFormat($allMember['date']).'</td>
								<td>'.$this->changeDateFormat($allMember['expiration_date']).'</td>
								<td style="color:red;"> Last Day </td>
								<td><a href="membership_extend_mail.php?m_id='.$allMember['membership_id'].'"><button class="btn btn-danger" type="button"><span class="icon-pencil"></span>&nbsp;&nbsp;SEND MAIL</button></a></td>
							</tr>';
					}	
				}
			}
		}
		
		/*
		 method for getting country list
		 Auth: Dipanjan
		*/
		function getCountryList($country_name){
			//getting value from database
			$country_list = $this->manageContent->getValueWhere("country","*","status",1);
			if(!empty($country_list[0]))
			{
				foreach($country_list as $country)
				{
					if($country['name'] == $country_name)
					{
						echo '<option value="'.$country['name'].'" selected="selected">'.$country['name'].'</option>';
					}
					else
					{
						echo '<option value="'.$country['name'].'">'.$country['name'].'</option>';
					}
				}
			}
		}
		
		/*
		 method for getting state list
		 Auth: Dipanjan
		*/
		function getStateList($state_name){
			//getting value from database
			if(!empty($state_name))
			{
				$zone_list = $this->manageContent->getValue_twoCoditions("zone","*","status",1,"name",$state_name);
			}
			else
			{
				$zone_list = $this->manageContent->getValue_twoCoditions("zone","*","status",1,"country_id",190);
			}
			
			if(!empty($zone_list[0]))
			{
				foreach($zone_list as $zone)
				{
					echo '<option value="'.$zone['name'].'">'.$zone['name'].'</option>';
					
				}
			}
		}
		
		/*
		 method for modifying date format
		 Auth: Dipanjan
		*/
		function changeDateFormat($input_date){
			//separating the day month year
			$date = explode("-",$input_date);
			//return date as dd-mm-yyyy format
			$return_date = $date[2]."-".$date[1]."-".$date[0];
			return $return_date;
		}
		
	}

?>