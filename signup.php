<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form was submitted
    $uname = $_POST['uname'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['re_pass'];
    $address = $_POST['address'];

    // Validate form data (check for empty fields)
    if (empty($uname) || empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password) || empty($address)) {
        echo "All fields are required.";
    } else {
        $sql = "INSERT INTO user (username, name, email, phone, password, address) VALUES ('$uname', '$name', '$email', '$phone', '$password', '$address')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the same page to avoid form resubmission
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sign Up Form by Colorlib</title>
    
        <!-- Font Icon -->
        <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    
        <!-- Main css -->
        <link rel="stylesheet" href="css/login.css">
<style>
        /* Modal Styles */
.modal {
  display: block;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0, 0, 0);
  background-color: rgba(0, 0, 0, 0.4);
  padding-top: 60px;
}

.modal-content {
  background-color: #fefefe;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  text-align: center;
}

.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
}

#modalOkBtn {
  background-color: #4caf50;
  color: white;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
    </head>
    <body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
    <div class="form-group">
        <label for="uname"><i class="zmdi zmdi-account material-icons-name"></i></label>
        <input type="text" name="uname" id="uname" placeholder="Create a username" required />
    </div>
    <div class="form-group">
        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
        <input type="text" name="name" id="name" placeholder="Your Full Name" required />
    </div>
    <div class="form-group">
        <label for="email"><i class="zmdi zmdi-email"></i></label>
        <input type="email" name="email" id="email" placeholder="Your Email" required />
    </div>
    <div class="form-group">
        <label for="phone"><i class="zmdi zmdi-phone"></i></label>
        <input type="number" name="phone" id="phone" placeholder="Your Phone number" required />
    </div>
    <div class="form-group">
        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
        <input type="password" name="pass" id="pass" placeholder="Password" required />
    </div>
    <div class="form-group">
        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
        <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" required />
</div>
<div class="form-group">
        <label for="email"><i class="zmdi zmdi-email"></i></label>
        <textarea name="address" id="address" placeholder="address" required ></textarea>
    </div>
    <div class="form-group">
        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required />
        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
    </div>
    
    <div class="form-group form-button">
        <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
    </div>
    
</form>

                    </div>
                    <div class="signup-image">
                        <figure><img src="img/signup-image.jpg" alt="sing up image"></figure>
                        <a href="signin.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/login.js"></script>

    <!-- Modal Box -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <p>Registration successful! Click OK to close.</p>
    <button id="modalOkBtn" onclick="closeModal()">OK</button>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var signUpButton = document.getElementById('signup');

// When the user clicks the button, open the modal
signUpButton.onclick = function() {
  modal.style.display = 'block';
}

// Function to close the modal and optionally redirect to signin.php
function closeModal(isOkButton) {
  modal.style.display = 'none';
  if (isOkButton) {
    window.location.href = 'signin.php';
  }
}

// When the user clicks outside the modal, close it
window.onclick = function(event) {
  if (event.target === modal) {
    closeModal(false);
  }
}

// Event listener for the close button (&times;)
document.getElementsByClassName('close')[0].onclick = function() {
  closeModal(false);
};

// Event listener for the OK button
document.getElementById('modalOkBtn').onclick = function() {
  closeModal(true);
};
</script>




</body>
</html>