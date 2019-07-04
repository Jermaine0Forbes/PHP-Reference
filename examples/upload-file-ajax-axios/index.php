
<style media="screen">
  progress{
    width:300px;
    margin-top:1em;
    height:1em;
  }
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js">

</script>
<section class="container">
  <form id="myForm" class="form"  enctype="multipart/form-data" method="post">
   <div class="form-group">
     <input class="form-control col-5"  type="file" name="file" value="">
   </div>
   <input class="btn btn-primary" type="submit" name="" value="submit">
  </form>
  <div class="">
    <div class="progress invisible">
    <div class="progress-bar" role="progressbar"  aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
    <p id="status"></p>
  </div>
</section>

<script type="text/javascript">
  (function(){
     let form = document.getElementById("myForm"),
        data = new FormData(),
        options,
        submit =  $("input[type='submit']"),
        inpt = document.querySelector("input[name='file']"),
        progress = document.querySelector(".progress"),
        bar = document.querySelector(".progress-bar"),
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
           return Number(num).toFixed(1);
         }


     form.onsubmit = function(e){

       submit.val("uploading")

        e.preventDefault();

        data.append("file", inpt.files[0])

        let config ={
          onUploadProgress: (e)=>{
            let loaded = setByte(e.loaded,"kb"), total = setByte(e.total,"kb")
            percent = (loaded / total)*100,
            percentValue = percent+"%" ;
            progress.className = "progress mt-5";
            bar.style.width = percentValue ;
            bar.innerHTML = percentValue;
            status.innerHTML = loaded+" of "+total+" kilobytes have been loaded";

          }
        }

        axios.post(url,data,config)
        .then(res => {
          console.log(res)

          submit.val("completed");
          submit.removeClass("btn-primary").addClass("btn-success")
        })
        .catch(err => console.log("error: "+err))




     }//onsubmit
  })()
</script>
