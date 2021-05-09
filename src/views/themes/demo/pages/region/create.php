<?php echo form_open('region/create'); ?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1 class="text-center">Region</h1>
			<div class="form-group">
				<label>Region Name</label>
				<input type="text" class="form-control" id="locationname" name="locationname" placeholder="Region Name" value="<?php echo set_value('locationname'); ?>">
				<?php echo form_error('locationname'); ?> 
			</div>
			<button type="submit" class="btn btn-primary btn-block">Submit</button>
		</div>
	</div>
<?php echo form_close(); ?>
