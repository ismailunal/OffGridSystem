<?php 

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
 <!-- Bootstrap 4 CSS and custom CSS -->
 
    </head>
<body>
 
<!-- container -->
<main role="main" class="container starter-template">
 
    <div class="row">
        <div class="col">
 
            <!-- where prompt / messages will appear -->
            <div id="response"></div>
 
            <!-- where main content will appear -->
            <div id="content"></div>
        </div>
    </div>
 
</main>
<!-- /container -->
 
<!-- jQuery & Bootstrap 4 JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
// jQuery codes
$(document).ready(function(){
    // show login form
    showLoginPage();

 
// trigger when login form is submitted
$(document).on('submit', '#login_form', function(){
 
 // get form data
 var login_form=$(this);
 var form_data=JSON.stringify(login_form.serializeObject());
// submit form data to api
$.ajax({
    url: "api/login.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result){
 
        // store jwt to cookie
        setCookie("jwt", result.jwt, 1);
 
        $("#loginh").hide();
        $("#login_form").hide();
        $('#response').html("<div class='alert alert-success'>Başarılı Giriş.</div>");

        setTimeout(
  function() 
  {
    window.location.replace("solaradmin.php");
  }, 2000);
       
    },
    error: function(xhr, resp, text){
    // on error, tell the user login has failed & empty the input boxes
   
    $('#response').html("<div class='alert alert-danger'>Login failed. Kullanıcı ismi veya şifre hatalı.</div>");
    login_form.find('input').val('');
}
});

 return false;
});

 
// show login page
function showLoginPage(){
 
 // remove jwt
 setCookie("jwt", "", 1);

 // login page html
 var html = `
     <h2 id='loginh'>Login</h2>
     <form id='login_form'>
         <div class='form-group'>
             <label for='name'>Kullanıcı İsmi</label>
             <input type='text' class='form-control' id='name' name='name' placeholder='Kullanıcı İsmini Girin'>
         </div>
         <div class='form-group'>
             <label for='password'>Şifre</label>
             <input type='password' class='form-control' id='password' name='password' placeholder='Şifre'>
         </div>
         <button type='submit' class='btn btn-primary mt-3'>Giriş Yap</button>
     </form>
     `;

 $('#content').html(html);

}

// function to set cookie
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


 





// show home page
// function showHomePage(){
 
//  // validate jwt to verify access
//  var jwt = getCookie('jwt');
//  $.post("api/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {

//      // if valid, route to solaradmin
// var html = `
//     <div class="card">
//         <div class="card-body">
//             <h5 class="card-title">You are logged in.</h5>
//         </div>
//     </div>
//     `;
// $('#content').html(html);
//  })

//  // show login page on error
// .fail(function(result){
//     showLoginPage();
//     $('#response').html("<div class='alert alert-danger'>Please login to access the home page.</div>");
// });
// }

// get or read cookie
function getCookie(cname){
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' '){
            c = c.substring(1);
        }
 
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
 
// function to make form values to json format
$.fn.serializeObject = function(){
 
 var o = {};
 var a = this.serializeArray();
 $.each(a, function() {
     if (o[this.name] !== undefined) {
         if (!o[this.name].push) {
             o[this.name] = [o[this.name]];
         }
         o[this.name].push(this.value || '');
     } else {
         o[this.name] = this.value || '';
     }
 });
 return o;
};
});
</script>
</body>
</html>