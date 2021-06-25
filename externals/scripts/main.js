


// function checkEmail(value){
   
//    let email= document.getElementById('email');
//     if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(value))
//   {
//     console.log('invalid email');
//   }
   
    
// }


// js functon for products list
function fun(value) {
    // const element = document.getElementById('cate');
    // let category = element.value;
    // console.log(en4.core.baseUrl + 'invoice/create');
    // console.log(category);
    let products;

    en4.core.request.send(new Request({
        url: en4.core.baseUrl + 'invoice/demo',
        method: 'get',
        data: {
            'cate_id': value,
        },
        onSuccess: function (responseText) {
            //getting data from demo action
            const products = JSON.parse(responseText);
            console.log(products);
            let pro = document.getElementById('pro');
            document.getElementById("pro").innerHTML = null;

            for (let product in products) {
                // console.log(product);
                // console.log(products[product])
                var opt = document.createElement('option');
                opt.value = product;
                opt.innerHTML = products[product];
                pro.appendChild(opt);
            }


        },
    }));
}


function isUSD(value) {
    if(value == 1) {
      scriptJquery('#region-wrapper').show();
    } else {
      scriptJquery('#region-wrapper').hide();
      scriptJquery('#region').val();
    }
  }

