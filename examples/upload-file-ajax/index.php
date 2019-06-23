
<style media="screen">
  progress{
    width:300px;
    margin-top:1em;
    height:1em;
  }
</style>

<section class="container">
  <form id="myForm" class="form"  enctype="multipart/form-data" method="post">
   <div class="form-group">
     <input class="form-control col-5"  type="file" name="file" value="">
   </div>
   <input class="btn btn-primary" type="submit" name="" value="submit">
  </form>
  <div class="">
    <progress  value="0" max="100">0%</progress>
    <p id="status"></p>
  </div>
</section>

<script type="text/javascript">
  (function(){
     let form = document.getElementById("myForm"),
        data = new FormData(),
        options,
        inpt = document.querySelector("input[name='file']"),
        progress = document.querySelector("progress"),
        status = document.querySelector("p#status"),
         url = "ajax/upload-progress.php";

         function setByte(num, size){
           switch(size){
             case "kb":
              num = num / 1000;
             break;
             case "mb":
             num = (num / 1000)/10;
             break;
             case "gb":
             num = (num / 1000)/100;
             break;
           }
           return num;
         }


     form.onsubmit = function(e){

       $("input[type='submit']").val("uploading")

        e.preventDefault();

        data.append("file", inpt.files[0])


      $.ajax({
        xhr:() => {
          const xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener("progress", (e) =>{
            let loading , total, percent;
            if (e.lengthComputable){
              loading = e.loaded;
              total = e.total;
              percent = (loading / total)*100;
              status.innerHTML = setByte(loading,"kb")+" of "+setByte(total,"kb")+" kilobytes have been loaded"
              progress.value= percent;
            }//lengthComputable
          }, false)//progress event

          xhr.addEventListener("progress", (e) =>{
            let loading , total, percent;
            if (e.lengthComputable){
              loading = e.loaded;
              total = e.total;
              percent = (loading / total)*100;
              status.innerHTML = loading+" of "+total+" bytes have been loaded"
                progress.value= percent;
            }//lengthComputable
          }, false)//progress event

          return xhr;
        },
        type:"POST",
        url: url,
        contentType:false,
        processData:false,
        data:data
      }).done((res) =>{
        console.log(res+" it is done")
      })


     }//onsubmit
  })()
</script>
