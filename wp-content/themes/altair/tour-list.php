<?php
/**
 * Template Name: Tour List
 * The main template file for display tour page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

get_header();

$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

//If not select sidebar then select default one
if(empty($page_sidebar))
{
	$page_sidebar = 'Page Sidebar';
}
?>

<?php
    //Include custom header feature
	get_template_part("/templates/template-header");
?>

<!-- Begin content -->  
<div class="inner">

	<div class="inner_wrapper">
	
	<div id="page_main_content" class="sidebar_content full_width nopadding">
	
	<?php
	    //Include custom tour search feature
		get_template_part("/templates/template-tour-search");
	?>
	
	<div class="sidebar_content">
	
	<?php
	    if(empty($term))
	    {
	?>
	    <?php echo tg_apply_content($post->post_content); ?>
	<?php
	    }
	    elseif(!empty($term))
	    { 
	    	$obj_term = get_term_by('slug', $term, 'tourcats');
	?>
	    <?php echo tg_apply_content($obj_term->description); ?>
	<?php
	    }
	?>
	
	<?php
		$key = 0;
		if (have_posts()) : while (have_posts()) : the_post();
			$key++;
			$image_url = '';
			$tour_ID = get_the_ID();
					
			if(has_post_thumbnail($tour_ID, 'large'))
			{
			    $image_id = get_post_thumbnail_id($tour_ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'full', true);
			    
			    $small_image_url = wp_get_attachment_image_src($image_id, 'blog_f', true);
			}
			
			//Get Tour Meta
			$tour_permalink_url = get_permalink($tour_ID);
			$tour_title = get_the_title();
			$tour_country= get_post_meta($tour_ID, 'tour_country', true);
			$tour_price= get_post_meta($tour_ID, 'tour_price', true);
			$tour_price_discount= get_post_meta($tour_ID, 'tour_price_discount', true);
			$tour_price_currency= get_post_meta($tour_ID, 'tour_price_currency', true);
			$tour_discount_percentage = 0;
			if(!empty($tour_price_discount))
			{
				if($tour_price_discount < $tour_price)
				{
					$tour_discount_percentage = intval((($tour_price-$tour_price_discount)/$tour_price)*100);
				}
			}
			
			//Get number of your days
			$tour_days = 0;
			$tour_start_date= get_post_meta($tour_ID, 'tour_start_date', true);
			$tour_end_date= get_post_meta($tour_ID, 'tour_end_date', true);
				
			if(!empty($tour_start_date) && !empty($tour_end_date))
			{
				$tour_start_date_raw= get_post_meta($tour_ID, 'tour_start_date_raw', true);
				$tour_end_date_raw= get_post_meta($tour_ID, 'tour_end_date_raw', true);
				$tour_days = pp_date_diff($tour_start_date_raw, $tour_end_date_raw);
				if($tour_days > 0)
				{
					$tour_days = intval($tour_days+1).' '.__( 'Days', THEMEDOMAIN );
				}
				else
				{
					$tour_days = intval($tour_days+1).' '.__( 'Day', THEMEDOMAIN );
				}
			}
			
			$tour_price_display = 0;
			if(empty($tour_price_discount))
			{
				if(!empty($tour_price))
				{
					$tour_price_display = $tour_price_currency.number_format($tour_price);
				}
			}
			else
			{
				$tour_price_display = $tour_price_currency.number_format($tour_price_discount);
			}
			
			$last_class = '';
			if(($key)%3==0)
			{
				$last_class = 'last';
			}
	?>
	
	<div class="one post_tour">
	
		<div class="one">
			<?php 
				if(!empty($image_url[0]))
				{
			?>		
				<a href="<?php echo $tour_permalink_url; ?>">
        		    <img src="<?php echo $small_image_url[0]; ?>" alt="" />
        		</a>
			<?php
				}		
			?>
			
			<?php
        		if(!empty($tour_discount_percentage))
        		{
        		?>
        		<div class="tour_sale fullwidth">
        			<div class="tour_sale_text"><?php _e( 'Best Deal', THEMEDOMAIN ); ?></div>
        			<?php echo $tour_discount_percentage.'% '.__( 'Off', THEMEDOMAIN ); ?>
        		</div>
        		<?php
        		}
        	?>
		</div>
		<br class="clear"/>
		<div class="one">
			<div class="thumb_content classic fullwidth list">
	            <div class="thumb_title">
	            	<?php
	            	if(!empty($tour_country))
	            	{
	            	?>
	            	<div class="tour_country">
	            		<?php echo $tour_country; ?>
	            	</div>
	            	<?php
	            	}
	            	?>
			        <h3><?php echo $tour_title; ?></h3>
	            </div>
	            <div class="thumb_meta">
	            	<?php
	            	if(!empty($tour_days))
	            	{
	            	?>
	            	<div class="tour_days">
	            		<?php echo date(THEMEDATEFORMAT, strtotime($tour_start_date)); ?> - <?php echo date(THEMEDATEFORMAT, strtotime($tour_end_date)); ?>
	            	</div>
	            	<?php
	            	}
	            	?>
	            	<?php
	                if($tour_price > 0)
	                {
	                ?>
	            	<div class="tour_price">
	            		<?php echo $tour_price_display; ?>
	            	</div>
	            	<?php
	            	}
	            	?>
	            </div>
	            <?php
	            	$tour_excerpt = get_the_excerpt();
	            	if(!empty($tour_excerpt))
	            	{
	            ?>
	            <br class="clear"/>
	            <div class="tour_excerpt"><?php echo nl2br($tour_excerpt); ?></div>
	            <?php
	            	}
	            ?>
			</div>
			
		</div>
	
	</div>
	<br class="clear"/>
	
	<?php
		endwhile; endif; 
	?>
	
	<?php
	    if($wp_query->max_num_pages > 1)
	    {
	    	if (function_exists("wpapi_pagination")) 
	    	{
	?>
			<br class="clear"/>
	<?php
				if(!is_front_page())
			    {
			    	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			    }
			    else
			    {
				    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
			    }
	
	    	    wpapi_pagination($wp_query->max_num_pages);
	    	}
	    	else
	    	{
	    	?>
	    	    <div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
	    	<?php
	    	}
	    ?>
	    <div class="pagination_detail">
	     	<?php _e( 'Page', THEMEDOMAIN ); ?> <?php echo $paged; ?> <?php _e( 'of', THEMEDOMAIN ); ?> <?php echo $wp_query->max_num_pages; ?>
	     </div>
	     <?php
	     }
	?>
	
	</div>
	
	<div class="sidebar_wrapper">
    		
        <div class="sidebar_top"></div>
    
        <div class="sidebar">
        
        	<div class="content">
        
        		<ul class="sidebar_widget">
        		<?php dynamic_sidebar($page_sidebar); ?>
        		</ul>
        	
        	</div>
    
        </div>
        <br class="clear"/>
    
        <div class="sidebar_bottom"></div>
    </div>

	</div>
</div>
</div>
</div>
<?php get_footer(); ?>