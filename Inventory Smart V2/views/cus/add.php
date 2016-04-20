        <script type="text/javascript">
            $(document).ready(function() {
                $cus_adder("#add-cus-post", hosturl);
                $('#cusAddModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                }); 
            });
        </script>

        <div class="modal fade" id="cusAddModal" tabindex="-1" role="dialog" aria-labelledby="cusAddModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="cusAddModalLabel">แก้ไข</h4>
                    </div>
                    <div class="modal-body">
                        <!-- <div id="or-popup"> -->
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">  
                                            <label> ชื่อ:</label><input class="form-control add-form" type='text' name='name' id='addname'/>
                                        </div>
                                        <div class="form-group">
                                            <label> นามสกุล:</label><input class="form-control add-form" type='text' name='surname' id='addsurname'/>
                                        </div>
                                        <div class="form-group">
                                            <label> บ้านเลขที่:</label><input class="form-control add-form" type='text' name='address' id='addaddress'/>
                                        </div>
                                        <div class="form-group">
                                            <label> อาคาร:</label><input class="form-control add-form" type='text' name='bldname' id='addbldname'/>
                                        </div>
                                        <div class="form-group">
                                            <label> หมู่:</label><input class="form-control add-form" type='text' name='muu' id='addmuu' />
                                        </div>
                                        <div class="form-group">
                                            <label> ซอย:</label><input class="form-control add-form" type='text' name='soi' id='addsoi' />
                                        </div>
                                        <div class="form-group">
                                            <label> ถนน:</label><input class="form-control add-form" type='text' name='road' id='addroad' />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> ตำบล:</label><input class="form-control add-form" type='text' name='subdis' id='addsubdis' />
                                        </div>
                                        <div class="form-group">
                                            <label> อำเภอ:</label><input class="form-control add-form" type='text' name='dis' id='adddis' />
                                        </div>
                                        <div class="form-group">
                                            <label> จังหวัด:</label><input class="form-control add-form" type='text' name='prov' id='addprov' />
                                        </div>
                                        <div class="form-group">
                                            <label> รหัสไปรษณีย์:</label><input class="form-control add-form" type='text' name='zip' id='addzip' />
                                        </div>
                                        <div class="form-group">
                                            <label> โทร:</label><input class="form-control add-form" type='text' name='tel' id='addtel' />
                                        </div>
                                        <div class="form-group">
                                            <label> แฟกซ์:</label><input class="form-control add-form" type='text' name='fax' id='addfax' />
                                        </div>
                                        <div class="form-group">
                                            <label> หมายเลขประจำตัวผู้เสียภาษี:</label><input class="form-control add-form" type='text' name='taxnum' id='addtaxnum' />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <!-- </div> -->
                    </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                            <button class="btn btn-primary add" id="add-cus-post">บันทึก</button>
                        </div>
                </div>
            </div>
        </div>