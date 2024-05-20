<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/5/slate/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/styles.css">
</head>

<body class="p-3 mb-2 bg-primary text-white">

    <nav class="navbar navbar-expand-lg" style="background-color: #1C82AD;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url(); ?>posts">aSkMe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>posts"><b>Questions</b></a>
                    </li>

                    <?php if ($this->session->userdata('logged_in')) { ?>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>posts/user_post"><b>My Questions</b></a>
                        </li>
                    <?php } ?>
                </ul>

                <ul class="navbar-nav ml-auto">
                <?php if (!isset($this->session->fname)) { ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>Login"><b>Login</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>Register"><b>Register</b></a>
                        </li>
                    </ul>                   
                <?php } ?>

                <?php if (isset($this->session->logged_in)) { ?>
                <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                        <a class="nav-link"href="<?php echo base_url('index.php/Login/userLogout'); ?>"><b>Logout</b></a>
                        </li>   
                </ul> 
                <?php } ?> 
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
