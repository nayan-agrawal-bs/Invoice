<?php

	$invoice = $this->invoice;
	$products = $this->products;
	$details= $this->details;

	

	
?>

<style>

@import url(https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css);
/*<link href="" rel="stylesheet">*/

#global_wrapper{
	background-color: #fcfcfc !important;
	border-top: 1px solid gray;
}

</style>



<div class="container" id='main_content'>
	<div class="container">
		<h3 class="text-lg text-center"><?php echo $this->translate("Invoice") ?></h1>
			<div class="grid grid-cols-4 grid-flow-col gap-4">
				<div class="col-span-3">
					<p><?php echo $this->translate("Customer Name") ?>:
						<?=$invoice['cust_name']?></p>
					<p><?php echo $this->translate("Address") ?>:
						<?=$invoice['cust_address']?></p>
					<p><?php echo $this->translate("Contact No.") ?>:
						<?=$invoice['cust_contact']?></p>
					<p><?php echo $this->translate("Email") ?>:
						<?=$invoice['cust_email']?></p>
				</div>
				<div class="col-span-1">
          
		  			<p>Invoice Number:
		  				<?=$invoice['invoice_number']?></p>
					<p><?php echo $this->translate("Customer Date") ?>: 
						<?=$invoice['creation_date']?></p>

				</div>
			</div>
			<div class="proudcts-table w-10/12">
				<table class="w-10/12 border-2 table-fixed">
					<thead class="border-2">
						<tr>
							<th class="border-2 p-1"><?php echo $this->translate("S No.") ?></th>
							<th class="border-2 p-1"><?php echo $this->translate("Product Name") ?></th>
							<th class="border-2 p-1"><?php echo $this->translate("Price") ?></th>
						</tr>

					</thead>
					<tbody class="border-2">
						<?php foreach($products as $key => $value): ?>
						<tr class="border-2 p-4">
							<td class="border-2 p-1"><?=$key?></td>
							<td class="border-2 p-1"><?=$value['product_name']?></td>
							<td class="border-2 p-1"><?=$value['product_price']?></td>
						</tr>
						<?php endforeach; ?>
						<tr>
							<td></td>
							<td class="border-2 p-1">Discount
							</td>
							<td class="border-2 p-1">
								<?=$invoice['discount']?>
							</td>
						</tr>
							<?php if($invoice['currency']): ?>
							<?php if($invoice['region']): ?>
								<tr>
									<td></td>
									<td class="border-2 p-1"><?php echo $this->translate("IGST %") ?></td>
									<td class="border-2 p-1"><?=$invoice['IGST'];?></td>
								</tr>

							<?php else: ?>
								<tr>
									<td></td>
									<td class="border-2 p-1"><?php echo $this->translate("SGST %") ?></td>
									<td class="border-2 p-1"><?=$invoice['CGST'];?></td>
								</tr>
								<tr>
									<td></td>
									<td class="border-2 p-1"><?php echo $this->translate("CGST %") ?></td>
									<td class="border-2 p-1"><?=$invoice['SGST'];?></td>
								</tr>

							<?php endif; ?>
							<tr>
							<td></td>
							<td class="border-2 p-1"><?php echo $this->translate("Total (INR)") ?></td>
							<td class="border-2 p-1"><?=$invoice['subtotal']?></td>
						</tr>
						<?php else: ?>
						<tr>
							<td></td>
							<td class="border-2 p-1"><?php echo $this->translate("Total (USD)") ?></td>
							<td class="border-2 p-1"><?=$invoice['subtotal']?></td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
			<h2><?php echo $this->translate("Bank Details") ?>:</h2>

			<p><?php echo $this->translate("Account Name") ?>:<?=$details['baccname']?></p>
			<p><?php echo $this->translate("Account N0.") ?>:<?=$details['baccnumber']?></p>
			<p><?php echo $this->translate("Bank") ?><?=$details['bname']?></p>
			<p><?php echo $this->translate("Bank Address") ?>:<?=$details['baddress']?></p>
			<p><?php echo $this->translate("IFSC Code") ?>:<?=$details['ifsc']?></p>

		</div>
	</div>


	<button id='download'><?php echo $this->translate("Download") ?></button>


</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
	<script type="text/javascript">
		var doc = new jsPDF();
		document.getElementById('download').addEventListener('click',function () {
			doc.fromHTML(document.getElementById('main_content').innerHTML, 6, 6, {
				'width': 170,
				
			});
			doc.save('invoice.pdf');
		});
	</script>

