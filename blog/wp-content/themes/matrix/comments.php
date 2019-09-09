<div id="comments">
    <?php if (have_comments()): ?>
        <h2 class="comments-title"><?php
        printf(_n('One Comment on &ldquo;%2$s&rdquo;', '%1$s Comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'matrix'),
            number_format_i18n(get_comments_number()), get_the_title()); ?></h2><?php
        if (post_password_required(get_the_ID())) {
            ?>
            <p class="nocomments"><?php _e('Please enter password to view or post a comments', 'matrix'); ?></p><?php
            return;
        }
        if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h3 class="screen-reader-text"><?php _e('Comment navigation', 'matrix'); ?></h3>

                <div class="nav-previous">
                    <?php previous_comments_link(__('&larr; Older Comments', 'matrix')); ?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link(__('Newer Comments &rarr;', 'matrix')); ?>
                </div>
            </nav><!-- #comment-nav-above --><?php
        endif; // Check for comment navigation.
        ?>
        <ol class="comments-list">
        <?php wp_list_comments('callback=matrix_comments&style=ol'); ?>

        </ol><?php
    endif;
    if (comments_open()) {
    ?>

    <!-- Start Respond Form -->
    <div id="respond">
        <?php
        $fields = array(
            'author' => '<div class="row">
						 <div class="col-md-4">
						   <label for="author">' . __("Name", 'matrix') . '<span class="required">*</span></label>
						   <input id="author" name="author" type="text" value="" size="30" aria-required="true">
						 </div>',
            'email' => '	 <div class="col-md-4">
						   <label for="email">' . __("Email", 'matrix') . '<span class="required">*</span></label>
						   <input id="email" name="email" type="text" value="" size="30" aria-required="true">
						 </div>',
            'website' => '<div class="col-md-4">
						   <label for="url">' . __("Website", 'matrix') . '</label>
						   <input id="url" name="url" type="text" value="" size="30" aria-required="true">
						 </div>
					   </div>',
        );
        function wc_defaullt_fields($fields)
        {
            return $fields;
        }

        add_filter('comment_form_default_fields', 'wc_defaullt_fields');
        $comments_args = array(
            'fields' => apply_filters('comment_form_default_fields', $fields),
            'label_submit' => __('Submit Message', 'matrix'),
            'title_reply_to' => '<h2 class="respond-title">' . __('Leave a Reply to %s', 'matrix') . '</h2>',
            'title_reply' => ' <h2 class="respond-title">' . __('Leave a reply', 'matrix') . '</h2>',
            'comment_notes_after' => '',
            'comment_field' => '<div class="row">
									 <div class="col-md-12">
									  <label for="comment">' . __('Add Your Comment', 'matrix') . '</label>
									  <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
									</div>
								  ',
            'class_submit' => 'btn btn-primary btn-lg',
        );
        comment_form($comments_args);
        add_filter("comment_id_fields", "my_submit_comment_message");

        ?>
    </div>
</div>
<?php } ?>
<!-- End Respond Form -->

</div>