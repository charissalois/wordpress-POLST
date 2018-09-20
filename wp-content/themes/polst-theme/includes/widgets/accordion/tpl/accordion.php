<?php
if (!empty($instance['accordion'])) :
    $i = 0;

    wp_enqueue_script( 'datatables', get_stylesheet_directory_uri() . '/assets/js/datatables-min.js', array(), '1.0.0', true );
?>

	<div class="polst-accordion">
		
		<div class="text-center">
			<a class="button blue outline no-print js-accordion-expand" href="#">Expand all</a>	
		</div>

		<table id="faq__table" class="data_table faq__table no-styling"> 
					<thead class="hidden">
						<tr>
							<th class="faq__table-title">Title</th>
						</tr>
					</thead>
		
		<?php
	    foreach( $instance['accordion'] as $item ) : ?>

	    	<tr>
	    		
	    		<td class="accordion-item js-accordion-item">
		        

	            <h3><a href="#" class="js-accordion-title" data-item="<?php echo $i ?>"><?php echo $item['title'] ?></a></h3>

	            <div class="js-accordion-content accordion-content" data-item="<?php echo $i ?>"><?php echo $item['content'] ?></div>

		        
		      </td>
	      </tr>

    <?php $i++; endforeach; ?>

  </table>

	</div>

<?php
endif;
