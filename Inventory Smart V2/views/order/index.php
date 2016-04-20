				<div class="row">
                    <div class="col-lg-12">
                    	<h1>สั่งซื้อ</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    	<div class="panel panel-default">
                        	<div class="panel-heading">
                            	สินค้าสั่งซื้อ
	                        </div>
                        	<div class="panel-body">
                        		<form action="" method="post" id="order-form" name="order-form">
									<div class="row">
	                                	<div class="col-md-4">
	                                		<div class="form-group">
												<label class="order-id">รหัส:</label><br>
										       	<div class="col-xs-6">
													<select class="form-control" name="prelocalid" id="prelocalid">
														<?php 	$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die();
																$stmt = $db->prepare("SELECT LocalID FROM parts GROUP BY LocalID"); 
																$stmt->execute(); 
																$stmt->bind_result($id); 
																$temp = 'temp';
																while($stmt->fetch()){
																	if(strpos($id, $temp) === false){
																		$temp = substr($id,0,2);
																		echo '<option value="'.$temp.'">'.$temp.'</option>';
																	}
																} 
																$stmt->close();
														?>
													</select>
												</div>
												<div class="col-xs-6">
											        <input class="form-control" type='number' name='localid' id='localid'/>
											    </div>
											<br>
									        <br>
									        	<div id="error-localid" style="display:none"><span>ไม่มีสินค้าดังกล่าว</span></div>
									        </div>
									        <div class="form-group">
										        <label class="order-lname">ชื่อ:</label>
										        <input class="form-control" type="text" name="itemname" id="itemname" disabled/>
									        </div>
									        <div class="form-group">
										        <label class="order-itemid">รหัส:</label>
										        <input class="form-control" type='text' name='itemid' id='itemid' disabled/>
										    </div>
										</div>
										<div class="col-md-4">
										    <div class="form-group">
									        	<label>บริษัทผู้จัดส่ง:</label>
												<select name="order-supname" class="form-control" id="order-supname">
													<?php $db->set_charset("utf8");
															$stmt = $db->prepare("SELECT SupplierID, CompanyName FROM suppliers GROUP BY SupplierID"); 
															$stmt->execute(); 
															$stmt->bind_result($id, $companyname); 
															while($stmt->fetch()){
																echo '<option value="'. $id .'"> ' . $companyname . '</option>\n';
															} 
															$stmt->close();
													?>
												</select>
									        </div>
									        <div class="form-group">
												<label class="order-ppu">ราคาซื้อต่อหน่วย:</label>
									        	<input class="form-control" type='number' name='priceperunit' id='priceperunit' value="0.00"/>
									        </div>
									        <div class="form-group">
										        <label class="order-quan">จำนวน:</label>
										        <input class="form-control" type='number' name='quantity' id='quantity' value="0"/>
										    </div>
										</div>
										<div class="col-md-4">
										    <div class="form-group">
										        <label class="order-totalamount">ราคารวม:</label>
										        <input class="form-control" type='number' name='totalamount' id='totalamount' value="0.00" disabled/>
										    </div>
									        <button class="btn btn-primary signup" id="add-order-post">เพิ่มคำสั่งซื้อ</button>	
										</div>

									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
                	<div class="col-lg-12">
					    <div class="panel panel-default">
	                        <div class="panel-heading">
	                            รายการสินค้า
	                        </div>
	                        <!-- /.panel-heading -->
	                        <div class="panel-body">
								<table class="table table-hover" id="sell-display">
									<thead>
										<tr>
											<th>รหัส</th>
											<th>ชื่อ</th>
											<th>บริษัทผู้จัดส่งสินค้า</th>
											<th>จำนวน</th>
											<th>ราคาต่อหน่วย</th>
											<th>ราคารวม</th>
											<th>ลบ</th>
										</tr>
									</thead>
									<tbody id="tbodyid">
									</tbody>
								</table>
	    					
		    					<div class="row">
			                        <div class="col-lg-4">
			                            <div class="form-group">
											<div class='input-group date' id='datetimepicker'>
											<input type='text' id="orderingdate" class="form-control" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
											<button class="btn btn-primary signup" id="submit-order-post">บันทึก</button>
									</div>
								</div>
							</div>
	    				</div>
	    			</div>
	    		</div>
		      	<script type="text/javascript">
		      	$( document ).ready(function() {
		      		var stack = {};
		      		var hosturl = "<?php echo URL.'order/'; ?>";
				    // getPart('#localid');
					$("#add-order-post").on('click', function(e){
						e.preventDefault();
		      			getPart(hosturl, stack, function(p){ 
						    addOrder(p);
				      	} );
			      	});
			      	submitOrder('#submit-order-post',stack,hosturl);
		      		changeTotalOrder('#quantity');
		      		changeTotalOrder('#priceperunit');

		      		//this needs to be used for dynamic element
		      		textTimer('#localid', hosturl);
		      		deleteOrder(stack);
		      		$("#prelocalid").change(function(){
		      			getPart(hosturl);
		      		});
		        	$('#datetimepicker').datetimepicker({format: "YYYY-MM-DD", locale:"th"});

				});
				</script>