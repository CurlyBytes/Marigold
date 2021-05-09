<?php echo form_open('locationtype/create'); ?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1 class="text-center">Location Type</h1>
			<div class="form-group">
				<label>LocationType</label>
				<input type="text" class="form-control" id="locationtype" name="locationtype" placeholder="locationtype" value="<?php echo set_value('locationtype'); ?>">
				<?php echo form_error('locationtype'); ?> 
			</div>
			<button type="submit" class="btn btn-primary btn-block">Submit</button>
		</div>
	</div>
<?php echo form_close(); ?>
