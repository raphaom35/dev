<?php $matrix_theme_options = matrix_theme_options();
$bgvideo = $matrix_theme_options['callout_external_bg_video']!="" ? $matrix_theme_options['callout_external_bg_video'] : '';
 ?>
<!-- Start Purchase Section -->
<div id="matrix_video" class="section purchase"
     <?php if ($matrix_theme_options['callout_bg_image'] != ""){ ?>style="background:url(<?php echo esc_url($matrix_theme_options['callout_bg_image']); ?>) no-repeat;background-attachment:fixed;"<?php } ?>>
    <div class="container">
				<div id="P1" class="player" 
     data-property="{videoURL:'<?php echo esc_url($matrix_theme_options['callout_external_bg_video']);?>',containment:'#matrix_video',startAt:0,mute:true,autoPlay:true,loop:true,opacity:1,addRaster:true,showControls:false}">
	</div>
        <!-- Start Video Section Content -->
        <div class="section-video-content text-center">

            <!-- Start Animations Text -->         
            <?php if ($matrix_theme_options['anim_texts'] != "") {
                $texts = explode(',', $matrix_theme_options['anim_texts']);
                $count = count($texts);?>
                <h1 class="fittext wite-text uppercase tlt">
                    <span class="texts"><?php
                        for ($i = 0; $i < $count; $i++) {
                            ?>
                            <span><?php echo esc_attr($texts[$i]); ?></span>
                        <?php
                        }?>
                    </span>                   
                    <span id="banner_desc"><?php echo esc_attr($matrix_theme_options['home_callout_description']); ?></span>
                </h1>
                <?php }else{ ?>
                <h1 class="fittext wite-text uppercase ">
                <span id="banner_desc"><?php echo esc_attr($matrix_theme_options['home_callout_description']); ?></span>
                </h1>
                <?php } ?>
                
            <!-- End Animations Text -->
            <?php if ($matrix_theme_options['home_callout_btn_1'] != "" || $matrix_theme_options['home_callout_btn_2'] != "") { ?>
                <!-- Start Buttons -->
                <p class="animated4 call-sec"><?php
                    if ($matrix_theme_options['home_callout_btn_1'] != "") {
                        ?>
                        <a id="banner_btn_1"
                           href="<?php echo esc_url($matrix_theme_options['home_callout_btn1_link']); ?>"
                           class="slider btn btn-primary call_btn1 animated bounceInUp"><i id="banner_icon_1"
                                                                                           class="<?php echo esc_attr($matrix_theme_options['home_callout_btn1_icon']); ?>"></i><span><?php echo esc_attr($matrix_theme_options['home_callout_btn_1']); ?></span></a>
                    <?php }
                    if ($matrix_theme_options['home_callout_btn_2'] != "") { ?>
                        <a id="banner_btn_2" class="animated4 slider btn btn-default btn-min-block call_btn2"
                           href="<?php echo esc_url($matrix_theme_options['home_callout_btn2_link']); ?>"><i
                                id="banner_icon_2"
                                class="<?php echo esc_attr($matrix_theme_options['home_callout_btn2_icon']); ?>"></i><span><?php echo esc_attr($matrix_theme_options['home_callout_btn_2']); ?></span></a>
                    <?php } ?>
                </p>
            <?php } ?>
        </div>
        <!-- End Section Content -->
    </div>
    <!-- .container -->
</div>
<!-- End Purchase Section -->
<script>
$(function(){
    jQuery("#P1").YTPlayer();
});
</script>