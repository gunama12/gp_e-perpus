<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
			<?php echo form_open('kategori/edit_simpan');?>
			<?php echo form_hidden('id', $kategori['id_kategori']);?>

			<h3>Edit Kategori</h3>
				<tr><td>Kategori</td><td><?= form_input('nama_kategori',$kategori['nama_kategori']);?></td></tr>

			</table>
			<?php echo form_submit('submit','Ubah'); echo anchor('kategori', 'Kembali');?>
			<?php echo form_close();?>
		</div>
	</section>
<?php $this->load->view('footer'); ?>			
