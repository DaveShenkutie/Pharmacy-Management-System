<?php
	$getPid=$con->query("SELECT id FROM patients WHERE name='{$pName}'");
	$pIdd=$getPid->fetch();
	$pId=$pIdd[0];
	$getDetails=$con->query("SELECT * FROM tempprescri WHERE customer_id='{$c_id}'");
			$file=fopen("recipts/docs/".$c_id.".txt","a+");
				while($itemm=$getDetails->fetch())
				{			
					$id=$con->query("SELECT * FROM services WHERE name='{$itemm['service']}' ");
					$idd=$id->fetch();
					fwrite($file, $itemm['service'].";".$itemm['priority'].";".$itemm['cost']."\n");					
					$count[] = $itemm['cost'];
				}
				$total=array_sum($count);
				fwrite($file, "TOTAL;;".$total."\n");
				 fclose($file);
	$enterInv=$con->query("INSERT INTO invoices(invoiceNo, patient, amount, servedBy, status) VALUES('{$invoice}', '{$pId}', '{$total}', '{$who}', 'PENDING')");
	
	$enterDetails=$con->query("SELECT * FROM tempinv WHERE inv='{$invoice}'");
			
				while($itemmm=$enterDetails->fetch())
				{			
				$servid=$con->query("SELECT * FROM services WHERE name='{$itemmm['service']}' ");
				$idServ=$servid);
				$insDet=$con->query("INSERT INTO invoicedetails(invoice, service) VALUES('{$invoice}', '{$idServ[0]}')");
							
				
				}
				$delet=$con->query("DELETE FROM tempscri WHERE inv='{$invoice}'");	