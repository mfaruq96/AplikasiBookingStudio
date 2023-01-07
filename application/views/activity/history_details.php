
<!-- Begin Page Content -->
<div class="container-fluid mb-5">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('activity/history'); ?>">History</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $order['invoice']; ?></li>
		</ol>
	</nav>
	<!-- End Breadcrumb -->

	<!-- Message -->
	<div class="row">
		<div class="col-lg-12">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>
	<!-- End Message -->

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Order Details <?= $order['invoice']; ?></h1>
	<!-- End Page Heading -->

	<!-- customer details -->
	<div class="row mb-2">
		<div class="col-lg-7">
			<table class="table text-nowrap" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td>Invoice</td>
						<td>:</td>
						<td>
							<?= $order['invoice']; ?>
						</td>
					</tr>
					<tr>
						<td>Date</td>
						<td>:</td>
						<td>
							<?= date('d F Y, h:i', strtotime($order['updated_at'])); ?>
						</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td>
							<?php if( $order['status'] == 0 ) : ?>
								<span class="badge badge-warning">belum bayar</span>
							<?php endif; ?>
							<?php if( $order['status'] == 1 ) : ?>
								<span class="badge badge-info">sudah bayar</span>
							<?php endif; ?>
							<?php if( $order['status'] == 2 ) : ?>
								<span class="badge badge-primary">sedang diproses</span>
							<?php endif; ?>
							<?php if( $order['status'] == 3 ) : ?>
								<span class="badge badge-success">selesai</span>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td>Remark</td>
						<td>:</td>
						<td>
							<?= $order['remarks']; ?>
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
		</div>
	</div>
	<!-- end customer details -->

	<!-- content -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover text-nowrap text-center" id="dataTable" cellspacing="0" cellpadding="0">
						<thead class="text-center">
								<tr>
									<th width="5%">NO</th>
									<th>DATE</th>
									<th>ROOM</th>
									<th>SCHEDULE</th>
									<th>NOTE</th>
									<th>PRICE</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach( $order_details as $order_detail ) : ?>
								<tr>
									<td>
										<?= $no++; ?>
									</td>
									<td>
										<?= date('d F Y', strtotime($order_detail['date'])); ?>
									</td>
									<td>
										<?= $order_detail['room']; ?>
									</td>
									<td>
										<?= $order_detail['note']; ?>
									</td>
									<td>
										<?= $order_detail['remark']; ?>
									</td>
									<td class="text-right">
										Rp.&ensp;<?= number_format($order_detail['price']); ?>
									</td>
								</tr>
								<?php endforeach; ?>
								<tr>
									<td colspan="5">
										<b>Sub Total</b>
									</td>
									<td class="text-right">
										<b>
											Rp.&ensp;<?= number_format($order['total_price']); ?>
										</b>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end content -->

</div>
<!-- /.container-fluid -->
