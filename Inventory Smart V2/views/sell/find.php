<div class="row">
                    <div class="col-lg-12">
                    	 <form method="get" id="search-form" name="search-form">
					   		<h1 class="page-header">ใบเสร็จรับเงิน</h1> 
					   		<fieldset style="width:30%" class="form-custom"> 
					        	<label>หมายเลข: </label>
					        	<div class="input-group">
				                    <input type='text' id="invoicenumber" class="form-control" />
				                    <span class="input-group-btn">
										<button class="btn btn-primary signup" id="submit-invoice-search">ค้นหา</button>	
									</span>
								</div>				               
						    </fieldset>
					    </form>
					</div>
				</div>
				<br>
				<div class="row">
                	<div class="col-lg-12">
					    <div class="panel panel-default">
	                        <div class="panel-heading">
	                            ใบเสร็จ
	                        </div>
	                        <!-- /.panel-heading -->
	                        <div class="panel-body overflow-table">
								<table class="table table-hover " id="sell-display">
									<thead>
										<tr>
											<th>ลำดับ</th>
											<th>หมายเลข</th> 
											<th>วันที่ขายสินค้า</th>
											<th>ชื่อลูกค้า</th>
											<th>จ่ายด้วย</th>
											<th>ระยะเวลาจ่ายเงิน</th>
											<th>ค่าแรง</th>
											<th>ลดราคา</th>
											<!-- <th>Note</th> -->
										</tr>
									</thead>
									<tbody id="tbodyid">

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

		<script type="text/javascript">
	      	$( document ).ready(function() {
	      		 var hosturl = "<?php echo URL.'sell/'; ?>";
	      		searchInvoice("#submit-invoice-search", hosturl);
			});
		</script>