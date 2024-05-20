<center><h3>My Questions</h3></center><br>
<div >
<?php foreach ($posts as $post) : ?>
    <h5><?php echo $post['title']; ?></h5>
    <?php echo $post['body']; ?><br><br>
    <small class="post-date">Posted on: <?php echo $post['created_at']; ?></small><br><br>

    <?php if (isset($this->session->logged_in)) { ?>
	<?php echo form_open('/posts/delete/'.$post['id']); ?>
    <div class="form-group">  
    <a type="button" class="btn btn-success" href="<?php echo site_url('posts/view/' . $post['id']); ?>">Add Answer</a>
    <a class="btn btn-warning" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['id']; ?>">Edit</a> 
    <button type="submit" class="btn btn-danger">Delete</button><br>
    </div>
    
	
</form>
    <hr>
    <?php } ?>

<br>

<?php endforeach; ?>
</div>