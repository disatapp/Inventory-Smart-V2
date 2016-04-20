
            <div class="container-fluid">
                 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">ค้นหาข้อมูลลูกค้า:</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div id="cus-searcher" class="panel panel-default">
                            <div class="panel-body">
                                <form id="searcher-form">
                                <fieldset  class="form-custom">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="name"> ชื่อ:</label>
                                                <input type='text' class="form-control" name='name' id='name' />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="surname"> นามสกุล:</label>
                                                <input type="text" class="form-control" name="surname" id="surname"/>
                                            </div>
                                        </div>
                                    </div>
                                            
                                </fieldset>
                                </form>
                                <div class="row">
                                    <div class="col-lg-12">
                                         <button class="btn btn-primary" id="search-post">ค้นหา</button>
                                         <button data-toggle='modal' data-target='#cusAddModal' class='add btn btn-danger'>เพิ่มลูกค้าใหม่</button>
                                    </div>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                ลูกค้า
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body overflow-table">

                                <div class="search-result">
                                    <div id="shadow" class="popup">
                                    <table class="table table-condensed" id="search-display">
                                        <thead>
                                            <tr>
                                                <th>รหัส</th>
                                                <th>ชื่อ</th>
                                                <th>นามสกุล</th>
                                                <th>ที่อยู่</th>
                                                <th>อาคาร</th>
                                                <th>หมู่</th>
                                                <th>ซอย</th>
                                                <th>ถนน</th>
                                                <th>ตำบล</th>
                                                <th>อำเภอ</th>
                                                <th>จังหวัด</th>
                                                <th>รหัสไปรษณีย์</th>
                                                <th>โทร</th>
                                                <th>แฟกซ์</th>
                                                <th>รหัสประจำตัวผู้เสียภาษี</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="search-tbody">
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <script type="text/javascript">
            var hosturl = "<?php echo URL.'cus/'; ?>";
            $(document).ready(function() {
                $cus_searcher("#search-post", hosturl); 
            });
        </script>
