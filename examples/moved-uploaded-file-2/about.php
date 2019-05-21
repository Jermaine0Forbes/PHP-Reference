
<section class="container">
  <form id="myForm" class="form" action="index.html" enctype="multipart/form-data" method="post">
    <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="myForm" />
   <div class="form-group">
     <!-- <input class="form-control col-5"  type="text" name="file" value=""> -->
     <input class="form-control col-5"  type="file" name="file" value="">
   </div>
   <input class="btn btn-primary" type="submit" name="" value="submit">
  </form>
</section>

<script type="text/javascript">
  (function(){
     let form = document.getElementById("myForm"),
        data = new FormData(),
        options,
        inpt = document.querySelector("input[name='file']"),
         url = "ajax/upload-progress.php";


     form.onsubmit = function(e){


        e.preventDefault();

        data.append("file", inpt.files[0])
        // data.append("file", inpt.value)

        options =  new Request(url,{
          method:"POST",
          body: data,
          // body: JSON.stringify(data),
          // headers:{
          //   "Content-Type":"application/json"
          // }
        }
      );
        
        fetch(options)
        .then(res => res.text())
        .then(res => {
          console.log(res)
        })

     }
  })()
</script>
