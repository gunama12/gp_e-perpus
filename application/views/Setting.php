<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
			<h3>Setting</h3>
			<?= form_open('Setting/update_setting');?>
			<?= $this->session->flashdata('pesan');?>
			<table>
			  <?php foreach ($setting as $s): ?>
			      <tr><td><?=$s->nama_setting;?></td><td><?=form_input($s->id_setting, $s->nilai_setting)?></td></tr>
			  <?php endforeach; ?>
			</table>
			<?php
			  echo form_submit('submit' , 'Simpan');
			  echo form_close();
			  ?>
		</div>
	</section>
<?php $this->load->view('footer'); ?>

