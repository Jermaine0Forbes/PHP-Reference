<!DOCTYPE html>
<html>

<head>
    <title>Index</title>
    <meta name="name" content="content">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
	<link rel="stylesheet" href="css/style.css"/>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>






</head>

<body class="bg">
<?php require_once("bootstrap.php");
$customer_id = $_GET['customer_id'] ?? '';
$order_id = $_GET['order_id'] ?? '';
 ?>
 <header class="bg-white mb-5 p-3">
  <a href="/jermaine">
   <img style="width:100%; max-width:300px;" src="https://cdn11.bigcommerce.com/s-4hu9rx3z98/images/stencil/original/bcsitelogo_1557934149__12842.original.jpg" alt="logo">
 </a>
 </header>
 <div class="container">
   <div class="row justify-content-center ">
     <div class="parent-container">
       <div class="col-md-7 form-container">
         <h1 class="form-title text-center">Enter your credentials</h1>
         <form class="" action="/ajax/check-id.php" method="post">
           <div class="form-group">
             <label for="customerId">Customer ID</label>
             <input  class="form-inpt" type="text" name="customer_id" value="<?php echo $customer_id; ?>">
           </div>
           <div class="form-group">
             <label for="orderId">Order ID</label>
             <input  class="form-inpt" type="text" name="order_id" value="<?php echo $order_id;?>">
           </div>
           <div class="form-group">
             <input class="btn btn-submit" type="submit" name="" value="submit">
           </div>
         </form>
       </div>
       <div class="loader">Loading...</div>
       <div class="col-md-7 data-container">
         <h2 class="form-title text-center">Download Links</h2>

       </div>
     </div>

   </div>
 </div>
<script type="text/javascript">
(function(){

  let lbl = Array.from(document.getElementsByTagName("label")),
      btn = document.querySelector("input[type='submit']"),
      fCont = $(".form-container"),
      form = document.querySelector("form"),
      data ,
      loader = $('.loader'),
      dCont = $(".data-container"),
      inpt = Array.from(document.querySelectorAll("input.form-inpt"));

  btn.onclick = (e) =>{
    fCont.addClass("animated fadeOutUpBig");
    data = new FormData(form)
    loader.show().addClass("animated fadeInUpBig")
    axios.post("./ajax/check-id.php",data)
    .then((res) => {
      console.log(res)
      let err = res.data.error, list = res.data.list;
      if(err){
        loader.hide()
        fCont.removeClass("fadeOutUpBig").addClass('fadeInUpBig')
        fCont.append(err)
      }else{
        loader.removeClass("fadeInUpBig").addClass("fadeOutUpBig")
        dCont.addClass("animated fadeInUpBig d-block")
        dCont.append(list);
        loader.hide()
      }

    })
    .catch((err) => {
      console.log("Error:")
      console.log(err)
    })




    return false;
  }

  inpt.forEach((e)=>{

    if(e.value !== ""){
      e.parentNode
      .getElementsByTagName("label")[0]
      .style.opacity = 0;
    }

     e.onfocus = (e) =>{
       let lb = e.target.parentNode.getElementsByTagName("label")[0];
      lb.className = "onfocus";
     }
     e.onfocusout = (e) =>{
       let lb = e.target.parentNode.getElementsByTagName("label")[0],
            filled = e.target.value.length > 0 ? true:false ;
      lb.className = "";

       lb.style.opacity = filled?0:1;

     }
  })
})()
</script>
</body>

</html>
