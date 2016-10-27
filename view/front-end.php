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

		<table id="hacker-list" class="wp-list-table widefat striped">
	<!-- 	<tr>
			<td colspan="5">
				<input type="text" class="search" placeholder="filter resutls">
			</td>
		</tr> -->
		<tr>
			<th>SN#</td>
			<th>Function Name</th>
			<th>Priority</th>
			<th>Arguments Accepted</th>
		</tr>
		<?php
			$count = 1;
			$hooked_functions = $wp_filter[$function_name];
			foreach($hooked_functions as $priority => $hooked_function){
				foreach ($hooked_function as $function_name => $function_variables) {
				?>
				<tr class="list">
					<td><?php echo $count; ?></td>
					<td class="name"><?php echo $function_name; ?></td>
					<td><?php echo $priority; ?></td>
					<td><?php echo $function_variables['accepted_args']; ?></td>
				</tr>
				<?php
				$count++;
				}
				
			}
		?>
		</table>
<script type="text/javascript">



jQuery(function($){
	$('#wordpress-filters').select2({
		placeholder: "Select Filter or Hook",
	});

	$.magnificPopup.instance._onFocusIn = function(e) {
			// Do nothing if target element is select2 input
			if( $(e.target).hasClass('select2-search__field') ) {
				return true;
			} 
			// Else call parent method
			$.magnificPopup.proto._onFocusIn.call(this,e);
	};

	$.magnificPopup.open({
	  items: {
	    src: '#test-popup'
	  },
	  type: 'inline'
	});
	
	if( $('#hacker-list').length != undefined && $('#hacker-list').length !='' ){
		var options = { valueNames: [ 'name' ] };
		var hackerList = new List('hacker-list', options);
	}
})
</script>
	<?php endif; ?>
	</div>
</div>
