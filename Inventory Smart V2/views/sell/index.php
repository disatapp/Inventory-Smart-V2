
                <div class="row">
                    <div class="col-xs-12">
                    	<h1>ขาย</h1>
                    </div>
                </div>
				<div class="row">
                    <div class="col-xs-4">
                    	<div class="panel panel-default">
                        	<div class="panel-heading">
                            	ลูกค้า:
	                        </div>
                        	<div class="panel-body">
                        		<form action="" method="post" id="cus-form" name="cus-form">
									<div class="row">
	                                	<div class="col-xs-12"> 
	                                		<div class="form-group">       
							            		<label class="name"> ชื่อ:</label>
							                        <select class="form-control" name="cusname" id="cusname">
														
													<?php 	$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die();
															$db->set_charset("utf8");
															$stmt = $db->prepare("SELECT CustomerID, Name, Surname 
																						FROM customers GROUP BY CustomerID"); 
															$stmt->execute(); 
															$stmt->bind_result($cusId,$Name,$Surname);
															echo '<option value="">---เลือกลูกค้า---</option>';
															while($stmt->fetch()){
																echo '<option value="'.$cusId.'">'.$Name.' '.$Surname.'</option>';
															
															} 
															$stmt->close();
														?>
													</select>
											</div>

						                    <div class="form-group">
							                    <label class="taxnum"> หมายเลขผู้เสียภาษี:</label>
						                        <input class="form-control input-sm" type="text" name="taxnum" id="taxnum" disabled/>
						                    </div> 
	                                	</div>
	                                </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	                <div class="col-xs-8">
                    	<div class="panel panel-default">
                        	<div class="panel-heading">
                            	รายละเอียดการขาย:
	                        </div>
                        	<div class="panel-body">
                        		<form action="" method="post" id="sell-addition" name="sell-addition">
									<div class="row">
										<div class="col-xs-6">
											<div class="row">
												<div class="col-xs-6">
													<div class="form-group">
														<label class="sell-wage">ค่าแรง:</label>
														<input class="form-control input-sm" type="number" name="wage" id="wage" value="0.00"/>
													</div>
												</div>
												<div class="col-xs-6">
													<div class="form-group">
														<label class="sell-discount">ลดราคาพิเศษ:</label>
														<input class="form-control input-sm" type="number" name="discount" id="discount" value="0.00"/>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-6">
													<div class="form-group">
														<label class="sell-duration">ระยะเวลาจ่าย:</label>
														<input class="form-control input-sm" type="number" name="duration" id="duration" value="0"/>
													</div>
												</div>
												<div class="col-xs-6">
													<div class="form-group">
														<label class="sell-duration">ราคา VAT:</label>
														<input class="form-control input-sm" type="number" name="VAT" id="VAT" value="0.00"/>
													</div>
												</div>
											</div>
	                                	</div>
	                                	<div class="col-xs-6">
                                			<div class="row">
                                				<div class="col-xs-6">
                                					<label class="sell-type">จ่ายเป็น:</label>
													<div class="radio">
														<label>
														<input type="radio" name="group1" value="cash" checked/> เงินสด</label>
													</div>
													<div class="radio">
														<label>
														<input type="radio" name="group1" value="check"/> เช็ค</label>
													</div>
												</div>
												<div class="col-xs-6">
				                                    <label class="sell-date">พิมพ์วันที่:</label>
				                                    <div class="radio">
				                                        <label>
				                                        <input type="radio" name="printdate" value="1" checked/> พิมพ์</label>
				                                    </div>
				                                    <div class="radio">
				                                        <label>
				                                        <input type="radio" name="printdate" value="0"/> ไม่พิมพ์</label>
				                                    </div>
				                                </div>
											</div>

								     	</div>

	                                </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <br>
                <div class="row">
                    <div class="col-xs-12">
                    	<div class="panel panel-default">
                        	<div class="panel-heading">
                            	สินค้าสั่งขาย
	                        </div>
                        	<div class="panel-body">
                        		<form action="" method="post" id="sell-form" name="sell-form">
									<div class="row">
	                                	<div class="col-xs-4">
	                                		<div class="form-group">
												<label class="sell-id">รหัส:</label><br>
												<div class="row">
										       		<div class="col-xs-6">
													<select class="form-control" name="prelocalid" id="prelocalid">
														<?php $stmt = $db->prepare("SELECT LocalID FROM parts GROUP BY LocalID"); 
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
												        <input class="form-control input-sm" type='number' name='localid' id='localid'/>
												    </div>
									        	<div id="error-localid" style="display:none"><span>ไม่มีสินค้าดังกล่าว</span></div>
									        	</div>
									        </div>
									        <div class="form-group">
										        <label class="sell-lname">ชื่อ:</label>
										        <input class="form-control input-sm" type="text" name="itemname" id="itemname" disabled/>
									        </div>
									    </div>
									    <div class="col-xs-4">
									        <div class="form-group">
										        <label class="sell-itemid">รหัส:</label>
										        <input class="form-control input-sm" type='text' name='itemid' id='itemid' disabled/>
										    </div>
									        <div class="form-group">
												<label class="sell-ppu">ราคาขายต่อหน่วย:</label>
									        	<input class="form-control input-sm" type='number' name='priceperunit' id='priceperunit' value="0.00"/>
									        </div>
									    </div>
									    <div class="col-xs-4">
									        <div class="form-group">
										        <label class="sell-quan">จำนวน:</label>
										        <input class="form-control input-sm" type='number' name='quantity' id='quantity' value="0"/>
										    </div>
										    <div class="form-group">
										        <label class="sell-totalamount">ราคารวม:</label>
										        <input class="form-control input-sm" type='number' name='totalamount' id='totalamount' value="0.00" disabled/>
										    </div>
										    <button class="btn btn-primary signup" id="add-sell-post">เพิ่มคำสั่งขาย</button>	
		            					</div>

									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
                	<div class="col-xs-12">
					    <div class="panel panel-default">
	                        <div class="panel-heading ">
	                            รายการขาย
	                        </div>
	                        <!-- /.panel-heading -->
	                        <div class="panel-body">
								<table class="table table-hover" id="sell-display">
									<thead>
										<tr>
											<th>รหัส</th>
											<th>ชื่อ</th>
											<th>จำนวน</th>
											<th>ราคาขาย</th>
											<th>ราคารวม</th>
											<th>ลบ</th>
										</tr>
									</thead>
									<tbody id="tbodyid">
									</tbody>
								</table>
		    					<div class="row">
			                        <div class="col-xs-4">
			                            <div class="form-group">
											<div class='input-group date' id='datetimepicker'>
											<input class="form-control" type='text' id="sellingdate" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
									<div class="col-xs-4">
											<button class="btn btn-primary signup" id="submit-sell-post">บันทึก</button>
									</div>
								</div>
							</div>
	    				</div>
	    			</div>
	    		</div>
	   	<script type="text/javascript" src="<?php echo URL; ?>/views/order/js/orderItem.js"></script>
	   	<script type="text/javascript">
	      	$( document ).ready(function() {
	      		var stack = {};
	      		var hosturl = "<?php echo URL.'sell/'; ?>";
			    // getPart('#localid');
			    $('#cusname').on('change', function(){
			    	document.getElementById('taxnum').value ='';
			    	getCustomer(hosturl);
			    });

				$("#add-sell-post").on('click', function(e){
					e.preventDefault();
		      		getPart(hosturl, stack, function(p){ 
					    addSell(p);
					 });
		      	});

			    submitSell('#submit-sell-post',stack, hosturl);
	      		changeTotalOrder('#quantity');
	      		changeTotalOrder('#priceperunit');

	      		//this needs to be used for dynamic element
	      		deleteOrder(stack);
	      		textTimer('#localid', hosturl);
	      		$("#prelocalid").change(function(){
	      			getPart(hosturl);
	      		});
	      		$('#datetimepicker').datetimepicker({format: "YYYY-MM-DD", locale:"th"});

			});
		</script>