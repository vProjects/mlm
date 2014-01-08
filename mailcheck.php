<?php
			$message = '<p><img src="mojlife.com/img/logo.png"></p>
			<h3 style="color:#0080FF">Potrdilo naročila</h3>
			<p>Hvala za naročilo ponudbe: </p>
            <br /><br />
			<table style="width:100%; border:1px solid;">
            	<thead>
                	<tr style="background-color:#E9E9E9;">
                    	<th style="border:1px solid;">Order Id</th>
                    	<th style="border:1px solid;">Product List</th>
                        <th style="border:1px solid;">Quantity</th>
                        <th style="border:1px solid;">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<td style="border:1px solid;">sdfhs<br />sdfkjhsk</td>
                        <td style="border:1px solid;">sdfhs<br />sdfkjhsk</td>
                        <td style="border:1px solid;">sdfhs<br />sdfkjhsk</td>
                        <td style="border:1px solid;">sdfhs<br />sdfkjhsk</td>
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
                        <td style="border:1px solid;">RF 99 52c182693dc35</td>
					</tr>
					<tr>
						<td style="border:1px solid;">Cena:</td>
                        <td style="border:1px solid;">€69</td>
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
			
			$retval = mail('dipanjan.electrical@gmail.com',$sub,$message,$headers);
			if($retval == 1 )  
			{
				echo 'mailsent';
			}
			else
			{
				echo "Message could not be sent";
			}

?>