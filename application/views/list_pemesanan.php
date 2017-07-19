<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
			<h3>Daftar Pemesanan</h3>
			<?=$this->session->flashdata('pesan');?>
	 		<table border="1px">
	   			<tr>
	   				<td>ID Anggota</td>
	   				<td>Id Buku</td>
	   				<td>Judul Buku</td>
	   				<td>Tanggal Pemesanan</td>
	   				<td>Status</td>
	   			</tr>
	   			<?php foreach ($list as $l): ?>
	         	<tr>
	         		<td><?=$l->id_anggota;?></td>
	         		<td><?=$l->id_buku;?></td>
	         		<td><?=$l->judul_buku;?></td>
	         		<td><?=$this->tanggal->set_tanggal_indonesia($l->tanggal_pesan);?></td>
	         		<td>
	         			<?php if($this->ion_auth->is_admin()){
	         				if($l->status == 0){
                            	echo anchor('pemesanan/arsipkan/'.$l->id_pemesanan, 'Arsipkan');
                            }else{
                            	echo "<span class='label label-success'>Telah Diarsip</span>";
                            }
                        }else{
                        	if($l->status == 1){
                        		echo "<span class='label label-success'>Telah Diarsip</span>";
                        	}else{
                        		echo "<span class='label label-info'>Pending</span>";
                        	}
                        }
                        ?>
	         		</td>
	         	</tr>
	   			<?php endforeach; ?>
	 		</table>
		</div>
	</section>
<?php $this->load->view('footer'); ?>	
