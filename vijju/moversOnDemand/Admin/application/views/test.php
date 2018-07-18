<?php 
   $this->load->library("braintree_lib");
$clientToken = Braintree_ClientToken::generate();
?>

<html>
  <head>
  </head>
  <body>
    <form method="post" action="<?php echo base_url('Dashboard/pay') ?>">
      <div id="dropin"></div>
      <input data-braintree-name="number" value="4111111111111111">
      <input data-braintree-name="expiration_date" value="10/20">
      <input type="submit" id="submit" value="Pay">
      <div id="paypal-button"></div>
    </form>  

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-2.1.1.js"></script>
  <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
<!--   <script>
   braintree.setup(clientToken, "dropin", {
        container: "payment-form",
        form: jQuery("#checkout") , 
        paypal: {
                 container: "payment-form",
                 singleUse: false,
               },
        dataCollector: {
                        paypal: true  
                       },
        paymentMethodNonceReceived: function (event, nonce) {
                 // do something
           }
    });
  </script> -->

  </body>
</html>                 

