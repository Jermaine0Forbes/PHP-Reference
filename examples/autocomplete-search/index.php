<?php



 ?>


 <main>
     <section class="container">

       <h2>Autocomplete</h2>

       <form class="" action="" method="post">
	        <input type="search" name="search" value="">
       </form>

       <div id="result" style='max-width:960px;'>

       </div>

       <div id="user">

       </div>


     </section>
</main>


<script type="text/javascript">
  (function(){


    var inpt = document.querySelector("input[name='search']"),
        url = "views/ajax.php",
        result = document.getElementById("result"),
        user = document.getElementById("user"),
        data = "";

        function show(val,target = result){
          target.innerHTML = val;
        }
        // function show(val,target = "result"){
        //   document.getElementById(target).innerHTML = val;
        // }

        function empty(val){
          if( val == "" || val == undefined)
            return true;

          return false;
        }

    inpt.onkeyup = function(e){
      // console.log(e)
      data = { location : inpt.value};

      if( inpt.value != "" && e.keyCode != 8){
        fetch(url ,{ method:"POST", headers:{"Content-Type":"application/json"}, body : JSON.stringify(data)})
        .then(res => res.json())
        .then (res => {
          // console.log(res)
          let html = ` <p class='text-right'><strong> ${res.number} records have been found </strong></p> ${res.table}`;
           show(html)
           // show(res)
        })
        .catch(err => {
          console.log(err)
          show(err)
        })
      }else{
        console.log("end")
        show("")
      }

    }// onkeyup


    result.onclick = (e) =>{
      // console.log(e.srcElement)
      // console.log(e.target.parentNode)
      console.log(e)
      let target, id, url, data;

    if( e.srcElement.tagName == "TD"){

      target = e.target.parentNode;
      id = target.id;
      data = {id:id};
      url = "ajax/get-user.php";
      target.style.backgroundColor="teal";

      console.log(id)

      fetch(url,{method:"POST", headers:{"Content-Type":"application/json"}, body : JSON.stringify(data)})
      .then(res => res.text())
      .then(res => {
        console.log(res)
        show(res,user)
      })
      .catch(err =>{
        console.log(err)
      })
    }//if statement

    }//onclick


  })()
</script>
