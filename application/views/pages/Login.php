<?php  ?>

<div>
<div class='container'>

    <h2>Login</h2><br>  
    
    <?php if($this->session->flashdata('loginMessage')){
        echo "<h2>".$this->session->flashdata('loginMessage')."</h2>";
    }
    ?>

    <?php echo validation_errors(); ?>
    <?php echo form_open('Login/userLogin'); ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email">
        </div><br>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div><br>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Login</button>
        </div>
    </form>
</div>

</div>

