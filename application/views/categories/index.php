<h1 class="bd-title">Danh mục sản phẩm</h1>
<div class="container-xxl my-md-4 bd-layout">
    <?php if ($categories && count($categories) > 0) : ?>
        <div class="row">
            <div class="col-2">ID</div>
            <div class="col-5">Name</div>
            <div class="col-5">Created Date</div>
        </div>
        <?php foreach ($categories as $category) : ?>
            <div class="row">
                <div class="col-2"><?php echo $category['id']; ?></div>
                <div class="col-5"><?php echo $category['name']; ?></div>
                <div class="col-5"><?php echo $category['create_date']; ?></div>
            </div>
        <?php endforeach; ?>
    <?php endif ?>
</div>