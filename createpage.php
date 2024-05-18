<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./createpage.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap"
    />
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .warning {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>

  </head>
  <body>
    <section class="createaccount">
      <div class="createaccount-child"></div>
      <div class="createaccount-item"></div>
      <div class="rectangle-parent">
        <div class="frame-child"></div>
        <div class="frame-item"></div>
        <div class="frame-inner"></div>
        <h1 class="anika-hrm" id="anikaHRM">
          <span>Anika </span>
          <span class="hrm">HRM</span>
        </h1>
        <img class="image-1-icon" alt="" src="./public/image-1@2x.png" />

        <img class="pngfind-1-icon" alt="" src="./public/pngfind-1@2x.png" />
      </div>
      <div class="logo-1-parent">
        <img class="logo-1-icon" alt="" src="./public/logo-1@2x.png" />

        <h3 class="create-your-account">Create your account</h3>
        <label class="email-id">Email ID</label>
        <label class="username">DisplayName</label>
        <label class="password">Password</label>
        <label class="confirm-password">Confirm Password</label>
        <?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email'])) {
    $prefilledEmail = $_GET['email'];
    ?>
    <form id='frm' method="POST">

        <input class="rectangle-input" style="font-size: 30px;"  name='email' value= "<?php echo $prefilledEmail; ?>" type="email" readonly />

        <input class="frame-child1" style="font-size: 30px;" type="text" name="name" oninput="checkInputLength(this)" required />
        <div id="warning" class="warning" style="margin-top:538px;"></div>

        <input class="frame-child2" style="font-size: 30px;" type="password" name="password" oninput="checkPasswordLength(this)" required />
        <div id="passwordWarning" class="warning" style="margin-top:668px;"></div>

        <input class="frame-child3" style="font-size: 30px;" type="password" name="cpassword" required />
        <input type='hidden' name='user_type' value='admin'>
        <button name="submit" class="rectangle-button"></button>
        <div class="create">Create</div>
        <img class="tablerlogout-icon" alt="" src="./public/tablerlogout.svg" />
        </form>
             
      </div>
    </section>
<?php
} else {
  echo "";
}
?>
    <script>
        function checkPasswordLength(passwordInput) {
            var minLength = 10;
            var password = passwordInput.value;

            if (password.length < minLength) {
                document.getElementById('passwordWarning').innerHTML = 'Warning: Minimum 10 characters required for the password.';
            } else {
                document.getElementById('passwordWarning').innerHTML = '';
            }
        }
    </script>
  <script>
        function checkInputLength(inputElement) {
            var maxLength = 10;
            var inputValue = inputElement.value;

            if (inputValue.length > maxLength) {
                document.getElementById('warning').innerHTML = 'Warning: Maximum 10 characters allowed.';
                inputElement.value = inputValue.substring(0, maxLength);
            } else {
                document.getElementById('warning').innerHTML = '';
            }
        }
    </script>
 <script>
$(document).ready(function() {
    $('#frm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'register.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
              if (response.status === 'success') {
                    Swal.fire({
                  icon: 'success',
                  title: 'Account created successfully!',
                  text: 'You can now log in.',
                }).then((result) => {
                  if (result.isConfirmed || result.isDismissed) {
                    window.location.href = 'loginpage.php'; 
                  }
                });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Failed to submit the form', 'error');
            }
        });
    });
});
</script>

 </body>
</html>
