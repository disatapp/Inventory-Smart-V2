                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">ค้นหาข้อมูลขายท่อเตาบ่ม:</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class='col-md-6'>ตั้งแต่วันที่
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker'>
                                                <input type='text' class="form-control" id='startdate'/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-6'>ถึง
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker2'>
                                                <input type='text' class="form-control" id='enddate'/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                     <button class="btn btn-primary" id="search-request-post">ค้นหาและแก้ไขข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                รายการขายท่อเตาบ่ม
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body overflow-table">

                               <div id="request-display" class="request-display">

                               </div>
                            </div>
                        </div>
                    </div>
                </div>

            <script type="text/javascript">
                $(function () {
                    var hosturl = "<?php echo URL.'pipe/'; ?>";
                    editPending();
                    submitPending(hosturl);
                    searchRequest("#search-request-post", hosturl);
                    $('#datetimepicker').datetimepicker({format: "YYYY-MM-DD", locale:"th"});
                    $('#datetimepicker2').datetimepicker({format: "YYYY-MM-DD", 
                        locale:"th",
                        useCurrent: false
                    });
                    $("#datetimepicker").on("dp.change", function (e) {
                        $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
                    });
                    $("#datetimepicker2").on("dp.change", function (e) {
                        $('#datetimepicker').data("DateTimePicker").maxDate(e.date);
                    });
                });
            </script>