<?php $this->load->view('header'); ?>
    <section>
        <div class="container">
			<h3>Form Pengembalian</h3>
			<?=form_open('Pengembalian/lihat_detail');?>
			<?=$this->session->flashdata('pesan');?>
			<table>
			<tr><td>Kode Buku</td><td>
			  <select class="" name="kode_buku" required="">

			      <?php foreach ($pinjam as $p) { ?>
			        <option value="<?=$p->kode_buku;?>"><?=$p->kode_buku;?></option>
			      <?php	} ?>
			  </select>


			    </td></tr>
			</table>
			<?php
			echo form_submit('submit', 'Cek');
			echo form_close();
			 ?>
		</div>
	</section>
<?php $this->load->view('footer'); ?>			 
