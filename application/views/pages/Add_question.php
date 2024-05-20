<?php  ?>

<div class='container'>
    <h2>AddQuestion</h2><br>  <?php echo validation_errors('post/create'); ?>

  <div class="form-group">
  <label>Title</label>
  <input type="title" class="form-control" id="title" >
  <div class="form-group">
    <label>Body</label>
  </div>
  <div class="form-group">
    <textarea id="body" class="form-control" name="body" ></textarea>
  </div><br>
  <div class="form-group">
  <button type="submit" class="btn btn-success">Submit</button>
  </div>
  </div>
</form>