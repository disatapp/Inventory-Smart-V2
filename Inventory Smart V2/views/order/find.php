<div class="row">
                    <div class="col-lg-12">
                    	 <form method="get" id="search-form" name="search-form">
					   		<h1 class="page-header">คำสั่งซื้อ</h1> 
					   		<fieldset style="width:30%" class="form-custom"> 
					        	<label>หมายเลข: </label>
					        	<div class="input-group">
				                    <input type='text' id="ordernumber" class="form-control" />
				                    <span class="input-group-btn">
										<button class="btn btn-primary signup" id="submit-order-search">ค้นหา</button>	
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
	                            ใบคำสั่งซื้อ
	                        </div>
	                        <!-- /.panel-heading -->
	                        <div class="panel-body overflow-table">
								<table class="table table-hover overflow-table" id="sell-display">
									<thead>
										<tr>
											<th>ลำดับ</th>
											<th>หมายเลข</th> 
											<th>ชื่อบริษัทผู้จัดส่งสินค้า</th>
											<th>ชื่อสินค้า</th>
											<th>รหัส</th>
											<th>จำนวน</th>
											<th>ราคาซื้อ</th>
											<th>ราคารวม</th>
											<th>วันที่ได้รับ</th>
											<th>วันที่นำเก็บ</th>
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

                var hosturl = "<?php echo URL.'order/'; ?>";
	      		searchOrder("#submit-order-search", hosturl);
			});
		</script>