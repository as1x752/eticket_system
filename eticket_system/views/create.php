<?php
	$form_location = base_url().'eticket_system/create';
	
	if (!isset($update_id)) {
		$update_id = $this->uri->segment(3);
	}
	
	$printout_url = base_url().'eticket_system/get_label/'.$update_id;
?>

<div id="group_box">
	<div id="box_title">
		Create New Ticket
	</div>
	<div id="box_options">

		<?php
		echo validation_errors("<div class='alert alert-danger' role='alert' style='width: 87%;'>", "</div>");
		?>

		<br />

		<div style="width: 35%;">
			<form action="<?= $form_location ?>" method="post">
				<label for="name">Name</label>  
				<input id="name" name="name" type="text" value="<?= $name ?>" placeholder="Name" class="form-control input-md" required=""> 

				<br />

				<label for="textinput">Address</label>  
				<input id="textinput" name="address" type="text" value="<?= $address ?>" placeholder="Address" class="form-control input-md">

				<br />

				<label for="textinput">Phone Number</label>  
				<input id="textinput" name="phone" type="text" value="<?= $phone ?>" placeholder="(123) 456-7890" class="form-control input-md" required="">

				<br />

				<label for="textinput">Device Make</label> 
				<input id="textinput" name="device_make" type="text" value="<?= $device_make ?>" placeholder="Device Make" class="form-control input-md" required="">

				<br />

				<label for="textinput">Device Model</label>  
				<input id="textinput" name="device_model" type="text" value="<?= $device_model ?>" placeholder="Device Model" class="form-control input-md" required="">
				
				<br />
				
				<label for="textinput">Device Symptoms/Issues/Comments</label>  
				<textarea name="device_sic" type="text" value="<?= $device_sic ?>" placeholder="SIC" rows="10" class="form-control input-md" required=""><?= $device_sic ?></textarea>
				
				<br />
				
				<?php
				
					if (isset($update_id)) 
					{
						echo form_hidden('update_id', $update_id);
					}
				
				?>
				
				<button id="singlebutton" name="submit" value="Submit" class="btn btn-primary">Submit</button> <button id="singlebutton" name="submit" value="Cancel" class="btn btn-danger">Cancel</button> <?php if (is_numeric($update_id)) { echo '<a class="btn btn-success" href="'.$printout_url.'">Print Label</a>'; } ?>
			</form>
		</div>
	</div>
</div>