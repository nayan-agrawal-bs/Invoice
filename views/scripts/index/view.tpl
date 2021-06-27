<?php

	$invoice = $this->invoice;
	$products = $this->products;


	$cnt = 1;
?>

<style>

@import url(https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css);
/*<link href="" rel="stylesheet">*/

#global_wrapper{
	background-color: #fcfcfc !important;
	border-top: 1px solid gray;
}
</style>



<div class="container ">
	<header>

		<!--show header with image -->

	</header>


	<div class="content">

		<h3 class="text-lg text-center">Invoice</h1>


			<div class="grid grid-cols-4 grid-flow-col gap-4">

				<div class="col-span-3">
					<p>Customer Name:<?=$invoice['cust_name']?></p>
					<p>Address:<?=$invoice['cust_address']?></p>
					<p>Contact No:<?=$invoice['cust_contact']?></p>
					<p>Email:<?=$invoice['cust_email']?></p>
					
				</div>

				<div class="col-span-1">
          <p>Invoice Number:<?=$invoice['invoice_number']?></p>
					<p>Date: <?=$invoice['creation_date']?></p>

				</div>

			</div>


			<div class="proudcts-table w-10/12">
				<table class="w-10/12 border-2 table-fixed">
					<thead class="border-2">
						<tr>
							<th class="border-2 p-1">S NO.</th>
							<th class="border-2 p-1">Product Name</th>
							<th class="border-2 p-1">Amount</th>
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
							
						</tr>
						
						<?php else: ?>
						<tr>
							<td></td>
							
						</tr>
						<tr>
							<td></td>
						
						</tr>

						<?php endif; ?>

						<?php endif; ?>



						<tr>
							<td></td>
							<td class="border-2 p-1">Total</td>
							<td class="border-2 p-1"><?=$invoice['subtotal']?></td>
						</tr>
					</tbody>
				</table>


			</div>



		</div>




	</div>

