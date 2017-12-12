<h1>Manage Electronic Repair Tickets</h1>
<?php

	if (isset($flash)) 
	{
		echo $flash;
	}
	
	$new_ticket_url = base_url().'eticket_system/create';
?>

<div id="group_box">
	<div id="box_title">
		<div>
			Options
		</div>
	</div>
	<div id="box_options">
		<a class="btn btn-primary" href="<?= $new_ticket_url ?>">Create New Ticket</a>
	</div>
</div>

<div id="group_box">
	<div id="box_title">
		<div>
			Current Tickets
		</div>
	</div>
	<div id="box_options">
		<table class="table table-striped table-bordered">
			<tr>
				<th>Ticket ID</th>
				<th>Customer Name</th>
				<th>Device Make</th>
				<th>Device Model</th>
				<th>Actions</th>
			</tr>

<?php	
	$this->load->module('timedate');

	foreach($query->result() as $row) 
	{
		$update_id = $row->id;
		$cus_name = $row->name;
		$cus_address = $row->address;
		$cus_phone = $row->phone;
		$cus_ticket = $row->ticket_id;
		$cus_devmake = $row->device_make;
		$cus_devmod = $row->device_model;
		$cus_sic = $row->device_sic;
		$date_entered =  $this->timedate->get_nice_date($row->date, 'mini');
		$edit_url = base_url().'eticket_system/create/'.$update_id;
?>


			<tr>
				<td>
					<?= strtoupper($cus_ticket) ?>
				</td>
				<td>
					<?= $cus_name ?>
				</td>
				<td>
					<?= $cus_devmake ?>
				</td>
				<td>
					<?= $cus_devmod ?>
				</td>
				<td>	
					<a type='button' class='btn btn-success' href="<?= $edit_url ?>"><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
				</td>
			</tr>

<?php
	}
?>

		</table>
	</div>
</div>