            
                <div class="row">
                    <div class="col-lg-12">
                         <!-- <form method="post" action="" id="search-form" name="search-form"> -->
                         <form id="search-form" name="search-form">
                            <h1 class="page-header">พิมพ์ใบเสร็จ</h1> 
                            <fieldset style="width:30%" class="form-custom"> 
                                <div class="form-group">  
                                    <label> หมายเลข:</label><input class="form-control add-form" type='text' name='invoice' id='invoice'/>
                                </div>
                                <div class="form-group">
                                    <label> VAT:</label><input class="form-control add-form" type='number' name='VAT' id='VAT' value='0.00'/>
                                </div>
                                <div class="col-lg-6">
                                    <label class="sell-date">พิมพ์วันที่:</label>
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="printdate" value="1" checked/> พิมพ์</label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="printdate" value="0"/> ไม่พิมพ์</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary add" id="print-post">Print</button>                  
                            </fieldset>
                        </form>
                    </div>
                </div>

                <script type="text/javascript">
                    $( document ).ready(function() {
                    var hosturl = "<?php echo URL.'printing/preview/'; ?>";
                        $("#print-post").on('click', function(e){
                            e.preventDefault();
                            if($('#invoice').val()){
                                location.href = hosturl+$('#invoice').val() +'/' +$('input[name="printdate"]:checked').val() + '/'+ $('#VAT').val();
                            } else {
                                alert('please enter a valid invoice');
                            }
                        });
                    });
                </script>