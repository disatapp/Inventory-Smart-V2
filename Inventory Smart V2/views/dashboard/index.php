                <div class="row">
                    <div class="col-lg-12">
                        <h1>สวัสดี, <?php echo Sessions::get('USERNAME') ?></h1>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div style="{margin-top = 5px}">
                            <div class="panel-body ">
                                <div class="col-md-6 text-center">
                                    <a href="<?php echo URL; ?>order" class="btn btn-primary btn-xxl signup" id="add-order-post">ซื้อ</a>   
                                </div>
                                <div class="col-md-6 text-center">
                                    <a href="<?php echo URL; ?>sell" class="btn btn-primary btn-xxl signup" id="add-order-post">ขาย</a>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
                
                <div class="row">
                     <!-- <div class="col-lg-12"> -->
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h2>แจ้งเตือนสินค้ายังไม่ได้รับ</h2>
                                    <p>หากไม่รับสินค้าหน้านี้จำนวนสินค้าในสต็อกจะไม่เพิ่มขึ้น</p>
                                    <div class="form-group">
                                            <label>วันที่ได้รับสินค้า:</label>
                                            <div class='input-group date' id='datetimepicker'>
                                                <input type='text' id="receivingdate" class="form-control" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div id="pending-display" class="pending-display">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <fieldset style="width:50%" class="form-custom">
                                    <form action="" method="post" id="pending-form" name="pending-form">
                                        
                                    </form>
                            </fieldset>
                        </div>
                    <!-- </div> -->
                </div>
    <script type="text/javascript">
    $( document ).ready(function() {
        var stack = {};
        var hosturl = "<?php echo URL.'dashboard/'; ?>";
        getPendingParts(hosturl);
        editPending();
        submitPending(hosturl);
        $('#datetimepicker').datetimepicker({ format: "YYYY-MM-DD", locale:"th" });
    });
    </script>