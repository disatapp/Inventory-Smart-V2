<script type="text/javascript">
    //dynamic
    $(document).ready(function() {
        //fire search localid once
        localIDFinder(hosturl);
        //auto increment next local id
        aiNextLocalID(hosturl);
        $part_adder("#add-part-post", hosturl);
        $('#partAddModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
        });

    });
</script>
<div class="modal fade" id="partAddModal" tabindex="-1" role="dialog" aria-labelledby="partAddModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="partAddModalLabel">เพิ่มสินค้าใหม่:</h4>
            </div>
            <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="localid"> รหัส:</label> 
                                <div class="row">

                                    <div class="col-xs-6"> 
                                        <div class="form-group">

                                            
                                            <select name="part-localid" class="form-control" id="adder-part-localid-selector">
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
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <input type='text' name='localid-textbox' class="form-control" id='adder-localid-textbox' readonly/>
                                        </div>
                                    </div>
                            
                                </div>
                                    <div class="form-group">
                                        <label> ชื่อ:</label><input class="form-control add-form" type='text' id='adderpartname'/>
                                    </div>

                                    <div class="form-group">
                                        <label> หมายเลขสินค้า:</label><input class="form-control add-form" type='text' id='adderpartnumber'/>
                                    </div>
                                    <div class="form-group">
                                        <label> สถานที่จัดเก็บ:</label><input class="form-control add-form" type='text' id='adderstoringplace'/>
                                    </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> ราคาที่ซื้อมา:</label><input class="form-control add-form" type='text' id='adderpriceperunit'/>
                                </div>
                                <div class="form-group">
                                    <label> จำนวน:</label><input class="form-control add-form" type='text' id='adderquantity' />
                                </div>
                                <div class="form-group">
                                    <label> ราคาขายทั่วไป:</label><input class="form-control add-form" type='text' id='adderregularprice' />
                                </div>
                                <div class="form-group">
                                    <label> ราคาขายราชการ:</label><input class="form-control add-form" type='text' id='addercommissionprice' />
                                </div>
                                <div class="form-group">
                                    <label> จำนวนที่แจ้งเตือน:</label><input class="form-control add-form" type='text' id='adderwarningquantity' />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label> รายละเอียดเพิ่มเติม:</label><textarea style="resize:vertical" class="form-control add-form" type='text' id='addernote'></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button class="btn btn-primary add" id="add-part-post">บันทึก</button>
            </div>
        </div>
    </div>
</div>