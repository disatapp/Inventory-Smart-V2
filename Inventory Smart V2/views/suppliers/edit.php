        <script type="text/javascript">
            $(document).ready(function() {
                //used for dynamic elements
                editSupplier();
                saveEditedSupplier(hosturl);
                $('#supModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                });
            });
        </script>
        <div class="modal fade" id="supModal" tabindex="-1" role="dialog" aria-labelledby="supModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="supModalLabel">แก้ไข</h4>
                    </div>
                    <div class="modal-body">
                        <!-- <div id="editor-popup"> -->
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">  
                                            <label> ชื่อบิรษัท:</label><input class="form-control" type='text' name='editname' id='editname'/>
                                        </div>
                                        <div class="form-group">
                                            <label> บุคคลที่เราติดต่อ:</label><input class="form-control" type='text' name='editcontname' id='editcontname'/>
                                        </div>
                                        <div class="form-group">
                                            <label> เลขที่:</label><input class="form-control" type='text' name='editaddress' id='editaddress'/>
                                        </div>
                                        <div class="form-group">
                                            <label> อาคาร:</label><input class="form-control" type='text' name='editbldname' id='editbldname'/>
                                        </div>
                                        <div class="form-group">
                                            <label> หมู่:</label><input class="form-control" type='text' name='editmuu' id='editmuu' />
                                        </div>
                                        <div class="form-group">
                                            <label> ซอย:</label><input class="form-control" type='text' name='editsoi' id='editsoi' />
                                        </div>
                                        <div class="form-group">
                                            <label> ถนน:</label><input class="form-control" type='text' name='editroad' id='editroad' />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> ตำบล:</label><input class="form-control" type='text' name='editsubdis' id='editsubdis' />
                                        </div>
                                        <div class="form-group">
                                            <label> อำเภอ:</label><input class="form-control" type='text' name='editdis' id='editdis' />
                                        </div>
                                        <div class="form-group">
                                            <label> จังหวัด:</label><input class="form-control" type='text' name='editprov' id='editprov' />
                                        </div>
                                        <div class="form-group">
                                            <label> รหัสไปรษณีย์:</label><input class="form-control" type='text' name='editzip' id='editzip' />
                                        </div>
                                        <div class="form-group">
                                            <label> โทร:</label><input class="form-control" type='text' name='edittel' id='edittel' />
                                        </div>
                                        <div class="form-group">
                                            <label> แฟกซ์:</label><input class="form-control" type='text' name='editfax' id='editfax' />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <!-- </div> -->
                    </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                            <button class='save-edited-sup btn btn-primary save' id=''>บันทึก</button>
                        </div>
                </div>
            </div>
        </div>