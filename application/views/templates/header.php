<html>

<head>
  <title><?php echo lang('site_name'); ?></title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
<script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
</head>

<body class="d-flex flex-column h-100">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-md">
      <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo lang('site_name'); ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>"><?php echo lang('home'); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>about"><?php echo lang('about'); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>blog"><?php echo lang('blog'); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>categories"><?php echo lang('category'); ?></a>
          </li>
          <?php if (!$this->session->userdata('logged_in')) : ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/login"><?php echo lang('login'); ?></a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/register"><?php echo lang('register'); ?></a></li>
          <?php endif; ?>
          <?php if ($this->session->userdata('logged_in')) : ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>blog/create"><?php echo lang('create_post'); ?></a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>categories/create"><?php echo lang('create_cat'); ?></a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/logout"><?php echo lang('logout'); ?></a></li>
          <?php endif; ?>
        </ul>
      </div>
      <form class="d-flex" action="/search/posts" method="get">
        <input class="form-control me-2" type="search" placeholder="<?php echo lang('search'); ?>" aria-label="Search" name="q">
        <button class="btn btn-outline-success" type="submit"><?php echo lang('search'); ?></button>
      </form>
    </div>
  </nav>

  <main class="flex-shrink-0 bd-main-order-1">
    <div class="container">
      <!-- Flash message -->
      <?php if ($this->session->flashdata('user_registered')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_registered') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('post_created')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_created') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('post_updated')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_updated') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('post_deleted')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_deleted') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('user_loggedin')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedin') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('user_loggedout')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedout') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('login_failed')) : ?>
        <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('login_failed') . '</p>'; ?>
      <?php endif; ?>