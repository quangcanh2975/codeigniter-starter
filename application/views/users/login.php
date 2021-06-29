<?php echo form_open('api/auth/login'); ?>
<div class="row">
  <div class="col-md-4 col-md-offset-">
    <h1 class="text-center"><?php echo $title; ?></h1>
    <div class="form-group">
      <input type="text" name="usr" class="form-control" placeholder="Username" required autofocus />
      <input type="password" name="pwd" class="form-control" placeholder="Password" required />
    </div>
    <button type="submit" class="btn btn-primary btn-block">Login</button>
  </div>
</div>
<?php echo form_close(); ?>
