<?php get_header(); ?>

<?php 
	// Override the number of items set in the backend
	query_posts( 'posts_per_page=-1&cat=' . $cat ); 
 	$count = 1;
	$theCount = 1;
?>

<?php
	$category = get_the_category();
	//foreach ($category as $categories): 
	if($category[0]):
		$categoryIs = strtolower($category[0]->slug);
	
	endif;
	//endforeach;
	
	
?>

<div id="content" class="clearfix">
	<div id="global-boxes-container" >
		<div class="breadcrumb-header-grey">
			<?php 
				if(function_exists('bcn_display')):
        			bcn_display();
    			endif;
			?>
		</div>
		<div id="global-box-inner" class="page-bg">
			<div id="our-work-left">
			
				<div id="masonry-container-a" class="grid-triple left no-transition" style="position: relative; overflow-x: hidden; overflow-y: hidden; margin-top:-1px;">
			
				<?php // START THE LOOP ?>
				<?php 
					query_posts("cat=35&posts_per_page=100&paged=".$paged);
					
					// The Loop
					while ( have_posts() ) : the_post(); ?>
				<?php 
				// Work out where to put borders (Depricated)
				///////////////////////////////////////////////////////////////////
				
				/*$postCount =  $wp_query->current_post;
				$totalPosts = $wp_query->post_count;
				$i = $postCount;
				
				// Set variables for odd/even
				if ( $i&1 ):
					$even = "even";
				else:
					$even = "odd";
				endif;
				
				// Set up borders
				if ($postCount <= 1):
				// do borders as normal
				elseif ($postCount == ($totalPosts-2)):
					if ($even == "odd"):	
						$bottom = "bottom";
					endif;
				elseif ($postCount == ($totalPosts-1)):
					if ($even == "odd"):
						$bottom = "bottom";
					endif;
				endif;
				// or don't do the borders!
				if ($count == 2):
					$count=1;
					$rightside ="";
				else:
					// or don't do the right border!
					$count++;
					$rightside = "b-r";
				endif; */
				
				///////////////////////////////////////////////////////////////////
				?>
				<?php 
				foreach((get_the_category()) as $category) { 
					$slug = " ".$category->category_nicename;
				} 
	
				$smallDate = get_the_date('m'); 
				$smallYear = get_the_date('y');
					
					?> 
				
				<div class="isotope-item fader our-work-panel left grey-bg <?php the_category_unlinked(' '); ?>" onclick="window.location = '<?php the_permalink() ?>'" style="cursor:pointer;">
					<div class="our-work-hov">
						<div class="img-bottom">
							<?php the_post_thumbnail( 'allen-thumb-310' ); ?>
						</div>
						<h2 class="very-dark-grey fs-24">
							<?php the_title(); ?>
						</h2>
						<h2 class="fs-14 very-light-grey">
						<?php
							// Work out the page id so we can get the country
							$country = get_field('country', $page->ID);
							if( $country != "None" ):  
								echo $country." / ";
							endif;
						
							$category = get_the_category(11); 
							echo $category[0]->cat_name;
							
							foreach((get_the_category()) as $childcat):
								if (cat_is_ancestor_of(11, $childcat)):
									if ($theCount >= 2):
										echo " / ".$childcat->cat_name;
									else:
										echo $childcat->cat_name;
										$theCount ++;
									endif;
								
								endif;
								
							endforeach;
							$theCount = 1;
							 ?>
						</h2>
					</div>
				</div>
				
				
				<?php endwhile; ?>
				<?php //endif; ?>
				</div>
			</div>
			
			<!-- OUR WORK SELECTION CATEGORIES -->
			
			<div id="our-work-right" class="grey-bg"> 
				<?php get_sidebar('our-work-cats'); ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>

<script>
jQuery(document).ready(function() {

		var $container = $('#masonry-container-a');
		$container.isotope({
			itemSelector : '.isotope-item',
			animationEngine: 'best-available',
			filter: '.<?php echo $categoryIs; ?>',
			
			masonry: { 
				columnWidth: 0
			},
			// filter: '<?php //the_excluded_category(array(11,12,13,14,15,16,17,18)); ?>',
			sortBy : 'month',
    		sortAscending : true,
    			getSortData : {
        			date : function ( $elem ) {
            			return $elem.find('.date-data').text();
        			}
				}
		});
		
	
		//Filter items when filter link is clicked
		$('#filters a').click(function(){
			$('#masonry-container-a').removeClass('no-transition');
			var selector = $(this).attr('data-filter');
			$container.isotope({ 
				filter: selector,
				animationEngine: 'best-available'
			});
			return false;
		});
		
		$('#filters-date a').click(function(){
			$('#masonry-container-a').removeClass('no-transition');
			console.log("date clicked");
			var selector = $(this).attr('data-filter');
			$container.isotope({ 
				filter: selector,
				animationEngine: 'best-available'
			});
			return false;
		});
		
		$('.filters-showall a').click(function(){
			$('#masonry-container-a').removeClass('no-transition');
			var selector = $(this).attr('data-filter');
			$container.isotope({ 
				filter: selector,
				animationEngine: 'best-available'
			});
			return false;
		});
		
		$('.click-date a').click(function(){
			$('#masonry-container-a').removeClass('no-transition');
			var selector = $("this").attr('date-time');
			console.log(selector);
			$container.isotope({ 
				filter: selector,
				animationEngine: 'best-available'
			});
			return false;
		});
		
		//Filter items when category link is clicked
		$('.cat-filter h3 a').click(function(){
			$('#masonry-container-a').removeClass('no-transition');
			var selector = $(this).attr('data-filter');
			$container.isotope({ 
				filter: selector,
				animationEngine: 'best-available'
			});
			return false;
		});
		
		
		$("a[href='#top']").click(function() {
  			$("html, body").animate({ scrollTop: 0 }, "medium");
 		 return false;
		});
		
    
});

</script>




<?php get_footer(); ?>
