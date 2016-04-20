<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">ค้นหาข้อมูลสินค้า:</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">                     
                        <div id="part-searcher" class="panel panel-default">
                            <div class="panel-body">
                                <form id="searcher-form">
                                <fieldset class="form-custom">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">    
                                                <label class="localid"> รหัสสินค้า:</label>
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                        <select name="part-localid" class="form-control" id="part-localid-selector">
                                                            <?php   $db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die();
                                                                    $stmt = $db->prepare("SELECT localid FROM parts GROUP BY localid"); 
                                                                    $stmt->execute(); 
                                                                    $stmt->bind_result($id); 
                                                                    $temp = '';
                                                                    while($stmt->fetch()){
                                                                        if(strpos($id, $temp) === false){
                                                                            $temp = substr($id,0,2);
                                                                            echo '<option value="'.$temp.'">'.$temp.'</option>\n';
                                                                        }
                                                                    } 
                                                                    $stmt->close();
                                                            ?>
                                                        </select>
                                                        </div>
                                                         <div class="col-xs-6">
                                                        <input class="add-input form-control" type='text' name='localid-textbox' id='localid-textbox'/>
                                                        </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="partname"> ชื่อ:</label>
                                                <input class="add-input form-control" type='text' name='partname' id='partname' />
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="partnumber"> หมายเลขสินค้า:</label>
                                                <input class="add-input form-control" type="text" name="partnumber" id="partnumber"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="storingplace"> สถานที่จัดเก็บ:</label>
                                                <input class="add-input form-control" type="text" name="storingplace" id="storingplace"/>
                                            </div>
                                        </div>  
                                        </div>
                                    </fieldset>
                                </form>
                                <div class="row">
                                    <div class="col-lg-12">
                                         <button class="btn btn-primary add" id="search-post">ค้นหา</button>
                                         <button data-toggle='modal' data-target='#partAddModal' class='add btn btn-danger'>เพิ่มสินค้าใหม่</button>
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
                                Invoice Tables
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body overflow-table">
                                <div class="search-result">
                                    <div id="shadow" class="popup">
                                    <table class="table table-condensed " id="search-display">
                                        <thead>
                                            <tr>
                                                <th>รหัสสินค้า</th>
                                                <th>ชื่อ</th>
                                                <th>หมายเลขสินค้า</th>
                                                <th>สถานที่จัดเก็บ</th>
                                                <th>ราคาที่ซื้อมา</th>
                                                <th>จำนวน</th>
                                                <th>ราคาขายทั่วไป</th>
                                                <th>ราคาขายราชการ</th>
                                                <th>จำนวนที่แจ้งเตือน</th>
                                                <th>รายละเอียดอื่นๆ</th>
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
                var hosturl = "<?php echo URL.'parts/'; ?>";
                $(document).ready(function() {

                    $part_searcher("#search-post", hosturl);
                });

               
            </script>