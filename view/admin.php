<div class="wrap">
	<h1>See Hooked Actions and Filters</h1>
	<form method="post" action="">
		<table class="form-table">
			<tr>
				<th>Select Filter</th>
				<td>
					<select id="wordpress-filters" name="wordpress-filters">
					<option></option>
					<?php
						global $wp_filter;
						foreach( $wp_filter as $filter_key => $hooked_values ){
					?>
						<option value="<?php echo $filter_key; ?>"><?php echo $filter_key; ?></option>
					<?php
					}
					?>
					</select>
				</td>
				<td>
				<input type="submit" class="button button-primary">
				</td>
			</tr>
		 </table>	
	</form>
	<div id="result">
	<?php
	  
	 if( filter_input(INPUT_POST, 'wordpress-filters') ):
	 	$function_name = filter_input(INPUT_POST, 'wordpress-filters');
	?>
		<table class="wp-list-table widefat striped">
		<tr>
			<th>SN#</td>
			<th>Function Name</th>
			<th>Priority</th>
			<th>Function Details</th>
			<th>Arguments Accepted</th>
		</tr>
		<?php
			$count = 1;
			$hooked_functions = $wp_filter['init'];
			foreach($hooked_functions as $priority => $hooked_function){
				foreach ($hooked_function as $function_name => $function_variables) {
				?>
				<tr>
					<td><?php echo $count; ?></td>
					<td><?php echo $function_name; ?></td>
					<td><?php echo $priority; ?></td>
					<td><?php echo $function_variables['accepted_args']; ?></td>
					<td><input type="button" class="button" value="See Details"></td>
				</tr>
				<?php
				$count++;
				}
				
			}
		?>
		</table>
	<?php endif; ?>
	</div>
</div>
<script type="text/javascript">
	jQuery(function($){
		$('#wordpress-filters').select2({
			 placeholder: "Select Filter or Hook",
  		});
		$('#wordpress-filters').on('change', function(){
			console.log( $(this).val() );
		});
	})
</script>