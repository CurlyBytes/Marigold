<?php echo validation_errors(); ?>

<?php echo form_open('locationtype/modify/'. $locationtype->LocationTypeId); ?>
<input type="hidden" name="locationtypeid" value="<?php echo $locationtype->LocationTypeId; ?>">
	<div class="row">
		<div class="col-md-4 col-md-offset-4"> 
			<h1 class="text-center">Location Type</h1>
			<div class="form-group">
				<label>LocationType</label>
				<input type="text" class="form-control" id="locationtype" name="locationtype" placeholder="locationtype" value="<?php echo $locationtype->LocationType; ?>">
			</div>
			<button type="submit" class="btn btn-primary btn-block">Modify</button>
		</div>
	</div>
<?php echo form_close(); ?>