<?php  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.3.3/backbone-min.js"></script>

</head>

<body>
<div>
<div class='container' >

    <h2>Register</h2> <br>
    
    <?php if($this->session->flashdata('errormessage')){
        echo "<h4>".$this->session->flashdata('errormessage')."</h4>";
    }
    ?>

    <?php echo validation_errors(); ?>
    <?php echo form_open('Register/userRegister'); ?>
 
        <div class="form-group">
            <label for="exampleInputPassword1">First Name</label>
            <input type="text" class="form-control" id="exampleInputFirstName" placeholder="First Name" name="fname">
        </div><br>
        <div class="form-group">
            <label for="exampleInputPassword1">Last Name</label>
            <input type="text" class="form-control" id="exampleInputLastName" placeholder="Last Name" name="lname">
        </div><br>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email">
        </div><br>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div><br>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
        </div><br><br>

        <center> Have already an account ? <a class="nav-link" href="<?php echo base_url(); ?>Login"><b>Login here</b></a></center>
</form>

</div>
</div>

<script type="text/javascript">
    var User = Backbone.Model.extend({
        urlRoot: 'api/register',
        defaults: {
            fname: '',
            lname: '',
            email: '',
            password: ''
        }
    });

    var RegisterView = Backbone.View.extend({
        el: '#register-form',
        events: {
            'submit': 'registerUser'
        },
        registerUser: function(e) {
            e.preventDefault();

            var user = new User({
                fname: this.$('#fname').val(),
                lname: this.$('#lname').val(),
                email: this.$('#email').val(),
                password: this.$('#password').val()
            });

            user.save(null, {
                success: function(model, response) {
                    if(response.status === 'success') {
                        alert(response.message);
                        window.location.href = 'login';
                    } else {
                        $('#error-messages').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function() {
                    $('#error-messages').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                }
            });
        }
    });

    new RegisterView();
</script>

</body>
</html>