<?php if($this->session->flashdata('message')){
        echo "<h4>".$this->session->flashdata('message')."</h4>";
    }
    ?>