 --> 
<!--   <div class="container"> -->  
    <h2 align="center">Live Poll System in PHP Mysql using Ajax</h2><br />
    <div class="row">
      <div class="col-md-6">
       <form method="post" id="poll_form">
        <h3>Đây chỉ là thử nghiệm mà thôi</h3>
        <br />
        <div class="candidates">
         <img src="voting/image/Heejin-Loona.jpg" height="150" width="150">
         <label><h4><input type="radio" name="poll_option" class="poll_option" value="1" /> Heejin</h4></label>
       </div>
       <div class="candidates">
         <label><h4><input type="radio" name="poll_option" class="poll_option" value="2" /> Jungkook</h4></label>
       </div>
       <div class="candidates">
         <label><h4><input type="radio" name="poll_option" class="poll_option" value="3" /> Rosé</h4></label>
       </div>
       </div>
       <br />
       <input type="submit" name="poll_button" id="poll_button" class="btn btn-primary" />
     </form>
     <br />
   </div>
   <div class="col-md-6">
     <h4>Live Poll Result</h4><br />
     <div id="poll_result" align="right" ></div>
   </div>
 </div>
<!-- </div> -->
<!-- </body>  
</html> -->

<script>  
  $(document).ready(function(){

   fetch_poll_data();

   function fetch_poll_data()
   {
    $.ajax({
     url:"voting/fetch_poll_data.php",
     method:"POST",
     success:function(data)
     {
      $('#poll_result').html(data);
    }
  }) ;
  }

  $('#poll_form').on('submit', function(event){
    event.preventDefault();
    var poll_option = '';
    $('.poll_option').each(function(){
     if($(this).prop("checked"))
     {
      poll_option = $(this).val()
    }
  });
    if(poll_option != '')
    {
     $('#poll_button').attr("disabled", "disabled");
     var form_data = $(this).serialize();
     $.ajax({
      url:"voting/poll.php",
      method:"POST",
      data:form_data,
      success:function(data)
      {
       $('#poll_form')[0].reset();
       $('#poll_button').attr('disabled', false);
       fetch_poll_data();
       alert(data);
       // var x = JSON.parse(data);
       // alert (x.ok);
      }
       
       // console.log(data);
        //alert("Poll Submitted Successfully");
     })
   }
   
   else
   {
     alert("Please Select Option");
   }
 });

});
</script>