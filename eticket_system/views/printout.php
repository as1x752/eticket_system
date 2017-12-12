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
		$edit_url = 'eticket_system/create/'.$update_id;
		$qr_url = base_url().$qr_data;
?>

					ID: <?= strtoupper($cus_ticket) ?> <br />
					Name: <?= $cus_name ?> <br />
					Phone: <?= $cus_phone ?> <br /><br />
					Device Info: <br />
					Make: <?= $cus_devmake ?> <br />
					Model: <?= $cus_devmod ?> <br /><br />
					<?= '<img src='.$qr_url.' />' ?>
<?php
	}
?>