        <script type="text/javascript">
            //edit buttton
            $(document).ready(function() {

                //used for dynamic elements
                editPart();
                saveEditedPart(hosturl);
                 $('#partModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                });
            });
        </script>
        <div class="modal fade" id="partModal" tabindex="-1" role="dialog" aria-labelledby="partModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="partModalLabel">แก้ไข</h4>
                    </div>
                    <div class="modal-body">
                        <!-- <div id="editor-popup"> -->
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> ชื่อ:</label><input class="form-control" type='text' id='edit-partname'/></div>
                                        <div class="form-group">
                                            <label> หมายเลขสินค้า:</label><input class="form-control" type='text' id='edit-partnumber'/></div>
                                        <div class="form-group">
                                            <label> สถานที่จัดเก็บ:</label><input class="form-control" type='text' id='edit-storingplace'/></div>
                                        <div class="form-group">
                                            <label> ราคาที่ซื้อมา:</label><input class="form-control" type='text' id='edit-priceperunit'/></div>
                                        <div class="form-group">
                                            <label> จำนวน:</label><input class="form-control" type='text' id='edit-quantity' /></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> ราคาขายทั่วไป:</label><input class="form-control" type='text' id='edit-regularprice' /></div>
                                        <div class="form-group">
                                            <label> ราคาขายราชการ:</label><input class="form-control" type='text' id='edit-commissionprice' /></div>
                                        <div class="form-group">
                                            <label> จำนวนที่แจ้งเตือน:</label><input class="form-control" type='text' id='edit-warningquantity' /> </div>
                                        <div class="form-group">
                                            <label> จำนวนที่แจ้งเตือน:</label><input class="form-control" type='text' id='edit-warningquantity' /> </div>
                                        <div class="form-group">
                                            <label> รายละเอียดเพิ่มเติม:</label><input class="form-control" type='text' id='edit-note' />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <!-- </div> -->
                    </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                            <button class='save-edited-part btn btn-primary save' id=''>บันทึก</button>
                        </div>
                </div>
            </div>
        </div> 