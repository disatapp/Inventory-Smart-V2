                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">ค้นหาข้อมูลผู้จัดส่งสินค้า:</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">                     
                        <div id="sup-searcher" class="panel panel-default">
                            <div class="panel-body">
                                <form id="searcher-form">
                                    <fieldset class="form-custom">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="name"> ชื่อบริษัท:</label>
                                                <input class="form-control" type='text' name='name' id='name' />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="contname"> ชื่อบุคคลที่เราติดต่อด้วย:</label>
                                                <input class="form-control" type="text" name="contname" id="contname"/>
                                            </div>
                                        </div>
                                    </div>
                                    </fieldset>
                                </form>
                                <div class="row">
                                    <div class="col-md-12">
                                         <button class="btn btn-primary add" id="search-post">ค้นหา</button>
                                         <button data-toggle='modal' data-target='#supAddModal' class='add btn btn-danger'>เพิ่มผู้จัดส่งใหม่</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Invoice Tables
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body overflow-table">
                                <div class="search-result">
                                    <div id="shadow" class="popup">
                                    <table class="table table-condensed overflow-table" id="search-display">
                                        <thead>
                                            <tr>
                                                <th>หมายเลข</th>
                                                <th>ชื่อบริษัท</th>
                                                <th>ชื่อบุคคลที่ติดต่อ</th>
                                                <th>บ้านเลขที่</th>
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
                var hosturl = "<?php echo URL.'suppliers/'; ?>";
                $(document).ready(function() {

                    $sup_searcher("#search-post", hosturl);
                });
            </script>