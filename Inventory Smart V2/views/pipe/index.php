<div class="row">
                    <div class="col-md-12">
                    	<h1>ท่อเตาบ่ม</h1>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-4">
                    	<div class="panel panel-default">
                        	<div class="panel-heading">
                            	แผ่นเหล็กที่ใช้
	                        </div>
                        	<div class="panel-body">
                        		<form action="" method="post" id="pipe-form" name="pipe-form">
                        			<div class="form-group">
									    <label class="pipe-lname">จำนวน:</label>
										<input class="form-control" type='number' name='squantity' id='squantity'/>
									</div>
									<div class="form-group">
									    <label class="pipe-left" id="pipe-in-stock">จำนวนแผ่นเหล็กคงเหลือ: <?php echo $this->sheetcount ?></label>
									</div>
                        		</form>
                        	</div>
                        </div>
                    </div>
                    <div class="col-md-8">
                    	<div class="panel panel-default">
                        	<div class="panel-heading">
                            	ท่อเตาบ่ม
	                        </div>
                        	<div class="panel-body">
                        		<form action="" method="post" id="order-form" name="order-form">
									<div class="row">
	                                	<div class="col-xs-6">
	                                		<div class="form-group">
												<label class="pipe-id">รหัส:</label><br>
										       	<div class="col-xs-6">
													<input class="form-control" type='number' name='prelocalid' id='prelocalid' value="LO" placeholder="LO"disabled/>
												</div>
												<div class="col-xs-6">
											        <input class="form-control" type='number' name='localid' id='localid'/>
											    </div>
											<br>
									        <br>
									        	<div id="error-localid" style="display:none"><span>ไม่มีสินค้าดังกล่าว</span></div>
									        </div>
									        <div class="form-group">
										        <label class="pipe-lname">ชื่อ:</label>
										        <input class="form-control" type="text" name="itemname" id="itemname" disabled/>
									        </div>
										</div>
										<div class="col-xs-6">
									        <div class="form-group">
										        <label class="pipe-quan">จำนวน:</label>
										        <input class="form-control" type='number' name='quantity' id='quantity' value='0'/>
										    </div>
									        <button class="btn btn-primary signup" id="add-pipe-post">เพิ่มคำสั่งซือ</button>	
										</div>

									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
                	<div class="col-md-12">
					    <div class="panel panel-default">
	                        <div class="panel-heading">
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
											<th>ลบ</th>
										</tr>
									</thead>
									<tbody id="tbodyid">
									</tbody>
								</table>
	    					
		    					<div class="row">
			                 		<div class="col-md-4">
											<button class="btn btn-primary signup" id="submit-pipe-post">บันทึก</button>
									</div>
								</div>
							</div>
	    				</div>
	    			</div>
	    		</div>
		    
	      	<script type="text/javascript">
	      	$( document ).ready(function() {
	      		var stack = {};
	      		var sheetcount = "<?php echo $this->sheetcount; ?>";
		      	var hosturl = "<?php echo URL.'pipe/'; ?>";

				$("#add-pipe-post").on('click', function(e){
					e.preventDefault();
	      			getSheet(hosturl, stack, function(p){ 
					    addPipeOrder(stack);
			      	} );
		      	});
			    // getPart('#localid');
			    submitPipeOrder('#submit-pipe-post',stack, hosturl, sheetcount);


	      		//this needs to be used for dynamic element
	      		textSheetTimer('#localid', hosturl);
	      		deletePipeOrder(stack);
			});
			</script>