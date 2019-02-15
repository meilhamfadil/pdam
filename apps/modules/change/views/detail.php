<?php
	extract($data);
?>
<div class="col m-b-20">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col">
					<i class="zmdi zmdi-apps zmdi-hc-lg"></i> Detail Pergantian
				</div>
				<div class="col col-sm-5 text-right">
					<button class="btn btn-sm btn-primary" id="closedetail">Kembali</button>
				</div>
			</div>
		</div>
		<table class="table table-stripped">
			<tr>
				<th width="49%">Pelanggan</th><td width="2%">:</td><td width="49%"><?= $nama_pelanggan ?></td>
			</tr>
			<tr>
				<th>Alamat</th><td>:</td><td><?= $alamat ?></td>
			</tr>
			<tr>
				<th>Telepon</th><td>:</td><td><?= $telepon ?></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<th class="text-center">Kondisi Awal</th><td></td><th class="text-center">Kondisi Baru</th>
			</tr>
			<tr>
				<td><?= image($foto_awal) ?></td>
				<td></td>
				<td><?= image($foto_baru) ?></td>
			</tr>
			<tr>
				<td class="text-center">Meter Awal : <?= $angka_awal ?></td><td></td><td class="text-center">Meter Baru : <?= $angka_baru ?></td>
			</tr>
			<tr>
				<td class="text-center">Brand Awal : <?= $brand_watermeter_awal ?></td><td></td><td class="text-center">Meter Baru : <?= $brand_watermeter_baru ?></td>
			</tr>
		</table>
	</div>
</div>