<!-- Start Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2><?php if(is_home()){ echo 'Home'; } else { the_title(); } ?></h2>
                <?php if (get_post_meta(get_the_ID(), 'post_page_description', true)) { ?>
                    <p><?php echo esc_attr(get_post_meta(get_the_ID(), 'post_page_description', true)); ?></p>
                <?php } ?>
            </div>
            <div class="col-md-6">
                <!-- BreadCrumb -->
                <?php if (function_exists('matrix_breadcrumbs')) matrix_breadcrumbs(); ?>
                <!-- BreadCrumb -->
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->