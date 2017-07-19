<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
			<h3>Edit Anggota : <?=$nama_anggota;?></h3>

			<?= form_open_multipart('anggota/simpan_edit_anggota');?>
			<?= form_hidden('id_anggota' , $id_anggota);?>
			<h4><?= $this->session->flashdata('pesan'); ?></h4>
			<table>
			  <tr><td>Nama</td><td><?=form_input('nama',$nama_anggota);?></td></tr>
			  <tr><td>Jenis Kelamin</td><td><?=form_dropdown('jk', array('laki-laki' => 'laki-laki', 'perempuan' => 'perempuan'), 'laki-laki');?></td></tr>
			  <tr><td>Tanggal Lahir</td><td><?=form_input('tanggal',$tanggal_lahir);?></td></tr>
			  <tr><td>Alamat</td><td><?=form_textarea(array('name' => 'alamat'), $alamat);?></td></tr>
			  
			</table>

			<?php echo form_submit('submit','Update ');  echo anchor('Anggota', 'Kembali');?>
			<?php echo form_close();?>
		</div>
	</section>
<?php $this->load->view('footer'); ?>

