<?php
class Mail{
		
		/*
		*  The basic message which we will send to the user after signup
		*/
 		private $activationMessage = 'Thanks for joining MojoLife and please click on the link to activate your account ';
		
		/*
         * top domail url for activation.php
         */ 		
        private $link = 'http://www.mojlife.com/';
         
		/*
		*  The mail id of the system
		*/
		private $sysMail = '';
		
		
		/*
		*  Public variable which is used to define where the mail will go
		*/
		private $to= '';

		/*
		*  Message which will be send to the user
		*/
		
		private $subject = 'Thanks for Joining MojoLife';
		


		/*
		*  Public variable which is used to from where this person is getting the mail
		*/
		
		public $from = 'admin@vyrazu.com';
		
		
		
		function getDataForRegistration($to,$membershipId){
			$this->to = $to;
			$whethermailsent = $this->activationLink($this->to,$membershipId);
			return $whethermailsent;
		}
		
		function activationLink($to,$membershipId){
		    
			$this->activationMessage .= $this->link.'activation.php?activated=true&mid='.$membershipId.'&mail='.$to;
			
			$headers = "From: sales@mojlife.com" . "\r\n";

			$retval  = mail($to,$this->subject,$this->activationMessage,$headers);		
			
			//temp codes ends here
			
			if( $retval == 1 )  
			   {
			  return 'mailsent';
			   }
			 else
			  {
				  return "Message could not be sent";
			   }

		}
		
		function mailPassword($to,$password){
		    
			$msg = "Your Password For Mojolife Account is: ".$password;
			
			$subject = "!Important Mail From Mojolife";
			
			$headers = "From: sales@mojlife.com" . "\r\n";

			$retval  = mail($to,$subject,$msg,$headers);		
			
			//temp codes ends here
			
			if( $retval == 1 )  
			   {
			  return 'mailsent';
			   }
			 else
			  {
				  return "Message could not be sent";
			   }

		}
				
		
		/*
		*Function to send a mail to the admin for customer query using contact page
		*/
		
				function querymail($name,$phone,$email,$title,$subject,$message){
					$to = "sales@mojlife.com";
					$sub = $subject;
					$msg = $title."\n".$message."\n Phone number:".$phone;
					$header = "From:".$email."\r\n";
					
					$retval = mail($to,$sub,$msg,$header);
					
					if( $retval == 1 )  
				   {
				  return 'mailsent';
				   }
				 else
				  {
					  return "Message could not be sent";
				   }
				}
				
			/*
				Function to send invoice to the customer with the details
			*/	
			function invoiceOfOrder($to,$order_id,$price,$product_list,$quantity){
				$message = '<p><img src="mojlife.com/img/logo.png"></p>
						<h3 style="color:#0080FF">Potrdilo naročila</h3>
						<p>Hvala za naročilo ponudbe: </p>
						
						<table style="width:100%; border:1px solid;">
							<thead>
								<tr style="background-color:#E9E9E9;">
									<th style="border:1px solid;">Product List</th>
									<th style="border:1px solid;">Quantity</th>
									<th style="border:1px solid;">Total Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="border:1px solid;">'.$product_list.'</td>
									<td style="border:1px solid;">'.$quantity.'</td>
									<td style="border:1px solid;"> € '.$price.'</td>
								</tr>
							</tbody>
						</table>
						
						<p>Izbrali ste način plačila "Plačilo prek plačilnega naloga". Plačilni nalog lahko plačate preko vašega načina e-poslovanja (Klik, Bank@net itd.) ali ga natisnete in plačate na najbližji pošti ali banki. Plačilo lahko opravite takoj in najkasneje naslednji delovni dan do 24. ure.</p>
						<p>Plačila izvedena s plačilnim nalogom (UPN) na delovnik do 15. ure (do takrat obratuje plačilni promet bank), bodo aktivirana en delovni dan po prejetju plačila ali do dva delovna dni od plačila, če je plačilo opravljeno preko Pošte. Po prejemu plačila aktiviramo vaše naročilo, ki ga lahko vidite v vaš račun na spletni strani <a href="www.mojlife.com">www.mojlife.com</a>, ter na vaš e-mail vam pošljemo obvestilo o aktivaciji.</p>
						<p>Plačilni nalog si lahko ogledate spodaj, ali pa če že imate aktiviran račun na <a href="www.mojlife.com">www.mojlife.com </a>(prijavite se s svojim emailom in geslom) v zavihku »login«.</p>
						<p style="font-weight:bold;font-size:18px;">Plačilni nalog UPN</p>
						<p>Izbrali ste plačilo po plačilnem nalogu UPN. Spodaj so podatki, kam je potrebno izvesti plačilo, ki ga morate pravilno izpolniti prek vaše spletne banke ali neposredno na banki ali pošti.</p>
				
				<table style="width:100%; border:1px solid; text-align:center;">
					<caption style="border:1px solid; font-size:20px;">Prejemnik MojLife</caption>
					<tbody>
						<tr>
							<td style="border:1px solid;">Naziv:</td>
							<td style="border:1px solid;">DASE d.o.o.</td>
						</tr>
						<tr>
							<td style="border:1px solid;">Naslov:</td>
							<td style="border:1px solid;">Ulica Hermana Potočnika 41</td>
						</tr>
						<tr>
							<td style="border:1px solid;">Kraj:</td>
							<td style="border:1px solid;">1000 Ljubljana</td>
						</tr>
						<tr>
							<td style="border:1px solid;">Država:</td>
							<td style="border:1px solid;">Slovenija</td>
						</tr>
						<tr>
							<td style="border:1px solid;">IBAN / TRR:</td>
							<td style="border:1px solid;">SI56 10100 00483 99988</td>
						</tr>
						<tr>
							<td style="border:1px solid;">Referenčna številka:</td>
							<td style="border:1px solid;"><b>RF 99 '.substr($order_id,6).'</b></td>
						</tr>
						<tr>
							<td style="border:1px solid;">Cena:</td>
							<td style="border:1px solid;"> € '.$price.'</td>
						</tr>
					</tbody>
				</table>
				
				<p>Za pomoč smo vam na voljo na tel.: + 386 51 358 868 ali <a href="#">order@mojlife.si</a></p>
				<p>Lep pozdrav,</p>
				<p>MOJLIFE</p>';
				
				$sub = 'Invoice From mojlife.com';
				$headers = "From: sales@mojlife.com"."\r\n";
				
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				$retval = mail($to,$sub,$message,$headers);
				if($retval == 1 )  
				{
				 	return 'mailsent';
				}
				else
				{
					return "Message could not be sent";
				}
			}

		/*
			Function to send confirmation of order to the customer with the details
		*/	
		function confirmationOfOrderAccount($to,$order_id,$product_list,$quantity,$price){
			$message = '<p><img src="mojlife.com/img/logo.png"></p>
						<h3 style="color:#0080FF">Potrdilo naročila</h3>
						<p>Vaše naročilo smo obravnavali uspešno. </p>
						<p>Hvala za naročilo.</p>
						<p>Vaše naročilo: </p>
						
						<table style="width:100%; border:1px solid;">
							<thead>
								<tr style="background-color:#E9E9E9;">
									<th style="border:1px solid;">Product List</th>
									<th style="border:1px solid;">Quantity</th>
									<th style="border:1px solid;">Total Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="border:1px solid;">'.$product_list.'</td>
									<td style="border:1px solid;">'.$quantity.'</td>
									<td style="border:1px solid;"> € '.$price.'</td>
								</tr>
							</tbody>
						</table>
						
						<p>Za pomoč smo vam na voljo na tel.: + 386 51 358 868 ali <a href="#">order@mojlife.si</a></p>
						<p>Lep pozdrav,</p>
						<p>MOJLIFE</p>';
			
			$sub = 'Confirmation of Order From mojlife.com';
			$headers = "From: sales@mojlife.com"."\r\n";
			
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$retval = mail($to,$sub,$message,$headers);
			if($retval == 1 )  
			{
				return 'mailsent';
			}
			else
			{
				return "Message could not be sent";
			}
		}
		
		/*
			Function to send confirmation of order to the customer with the details
		*/	
		function confirmationOfOrderPaypal($to,$order_id,$product_list,$quantity,$price){
			$message = '<p><img src="mojlife.com/img/logo.png"></p>
						<h3 style="color:#0080FF">Potrdilo naročila</h3>
						<p>Vaše naročilo smo obravnavali uspešno. </p>
						<p>Hvala za naročilo.</p>
						<p>Vaše naročilo: </p>
						
						<table style="width:100%; border:1px solid;">
							<thead>
								<tr style="background-color:#E9E9E9;">
									<th style="border:1px solid;">Product List</th>
									<th style="border:1px solid;">Quantity</th>
									<th style="border:1px solid;">Total Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="border:1px solid;">'.$product_list.'</td>
									<td style="border:1px solid;">'.$quantity.'</td>
									<td style="border:1px solid;"> € '.$price.'</td>
								</tr>
							</tbody>
						</table>
						
						<p>Za pomoč smo vam na voljo na tel.: + 386 51 358 868 ali <a href="#">order@mojlife.si</a></p>
						<p>Lep pozdrav,</p>
						<p>MOJLIFE</p>';
			
			$sub = 'Confirmation of Order From mojlife.com';
			$headers = "From: sales@mojlife.com"."\r\n";
			
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$retval = mail($to,$sub,$message,$headers);
			if($retval == 1 )  
			{
				return 'mailsent';
			}
			else
			{
				return "Message could not be sent";
			}
		}
	
}


?>