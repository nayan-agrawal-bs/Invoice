


<div class="layout_middle">
  <div class="generic_layout_container">
    <?php echo $this->form->render($this); ?>
  </div>
</div>



<script type="text/javascript">
let productsArr = <?php echo json_encode($this->products);?>;
let addproducts = <?php echo json_encode($this->addProducts);?>;
let currency =<?php echo json_encode($this->currency);?>;




let apro =document.getElementById('addPro');

for(let product in productsArr){
  //console.log(product);
  for(let addpro in addproducts){
    if(addpro == product){
     delete addproducts[addpro];
    }
  }
}

for(let pro in addproducts){
  const val = addproducts[pro];
  const opt = document.createElement('option');
  opt.value = pro;
  opt.innerHTML = val;
  apro.appendChild(opt);
}
//console.log(addproducts);



if(currency == 1) {
      scriptJquery('#region-wrapper').show();
    } else {
      scriptJquery('#region-wrapper').hide();
    }




let dpro =document.getElementById('pro');

let i =0;
for(let product in productsArr){
  const val = productsArr[product];
  const opt = document.createElement('option');
  opt.value =product;
  opt.innerHTML = val;
  dpro.appendChild(opt);
}

// for (let i = min; i<=productsArr.length; i++){
//     var opt = document.createElement('option');
//     opt.value = productsArr[i][];
//     opt.innerHTML = i;
//     select.appendChild(opt);
// }




</script>

