<?php echo validation_errors(); ?>

<?php echo form_open('api/auth/register'); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1 class="text-center"><?= $title ?></h1>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name" />
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" placeholder="Email" />
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username" />
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" />
        </div>

        <div class="form-group">
            <label for="password2">Confirm password</label>
            <input type="password" class="form-control" name="password2" placeholder="Confirm password" />
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
<?php echo form_close() ?>