<h1 class="bd-title"><?php lang('blog_search'); ?></h1>
<?php if (!$search_results) : ?>
    <p><?php echo lang('no_search_result'); ?></p>
<?php endif ?>

<?php if ($search_results) : ?>
    <?php foreach ($search_results as $index => $post) : ?>
        <div class="container-xxl my-md-4 bd-layout">
            <p><?php echo $post['title']; ?><small class="fs-3"> <?php echo lang('on') . " "  . $post['name']; ?></small></p>
            <div class="card" style="width: 18rem;">
                <img data-src="<?php echo $post['post_image']; ?>" class="lazy" alt="<?php echo lang('post_image'); ?>">
                <div class="card-body">
                    <a href="<?php echo base_url() . 'blog/' . $post['slug']; ?>" class="btn btn-primary"><?php echo lang('view'); ?></a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let lazyloadImages;
            if ("IntersectionObserver" in window) {
                console.log("intersection in windows")
                lazyloadImages = document.querySelectorAll('.lazy');
                var imageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            var image = entry.target;
                            image.src = image.dataset.src;
                            image.classList.remove('lazy');
                            imageObserver.unobserve(image);
                        }
                    })
                })
                lazyloadImages.forEach(image => {
                    imageObserver.observe(image);
                })

            } else {
                console.log("intersection NOT in windows")
                let lazyloadThrottleTimeout;
                lazyloadImages = document.querySelectorAll('.lazy');

                function lazyload() {
                    if (lazyloadThrottleTimeout) {
                        clearTimeout(lazyloadThrottleTimeout);
                    } else {
                        lazyloadThrottleTimeout = setTimeout(() => {
                            var scrollTop = window.pageYOffset;
                            lazyloadImages.foreach(image => {
                                if (image.offsetTop < (window.innerHeight + scrollTop)) {
                                    image.src = image.dataset.src;
                                    image.classList.remove('lazy');
                                }
                            });
                            if (lazyloadImages.length == 0) {
                                document.removeEventListener('scroll', lazyload);
                                window.removeEventListener('resize', lazyload);
                                window.removeEventListener('orientationChange', lazyload);
                            }
                        }, 20);
                    }
                }
                document.addEventListener("scroll", lazyload);
                window.addEventListener("resize", lazyload);
                window.addEventListener("orientationChange", lazyload);
            }
        });
    </script>
<?php endif ?>