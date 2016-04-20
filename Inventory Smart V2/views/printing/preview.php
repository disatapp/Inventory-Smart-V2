            <div class="panel panel-default" style="margin-top: 10px;">
                <div class="panel-body">
                    <div class="row">
                            <div class="col-lg-12">
                                <button class="btn btn-primary" id="print-post">Print</button>
                                <a class="btn btn-danger" href="<?php echo URL?>printing" id="back-post">Choose Invoice</a> 
                            </div>
                    </div>
                </div>
            </div>

                <div class="printarea">
                    <div class="top-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="col-xs-12 pull-left brand">
                                          <!-- logo here -->
                                                <div class="row">
                                                    <img src="<?php echo URL?>public/images/logo.jpg" alt="logo" align="left"/>
                                                    <h3><strong>บริษัท เทพนิธิ จำกัด</strong></h3> 
                                                    <h5>THEPNITHI Co.,Ltd.</h5>
                                                </div>
                                                <p class="small">
                                                            87/1 ถ.บำรุงราษฎร์ ต.วัดเกต อ.เมือง เชียงใหม่ 50000<br>
                                                            โทร.053-242212, 053-241976 แฟกซ์.053-243191<br>
                                                            email : tntchiangmai@gmail.com<br></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-xs-12 pull-left">
                                                <strong>ชื่อลูกค้า : </strong> <?php echo  str_replace('-', '', $this->inputdata['Name'].' '.$this->inputdata['Surname']);?><br>
                                                <strong>ที่อยู่ : </strong><?php echo $this->address;?><br>

                                                 <?php if(($this->inputdata['taxnumber'] != "null") && !empty($this->inputdata['taxnumber'])) { echo '<strong>Taxnumber : </strong>'.$this->inputdata['taxnumber']; }?><br>

                                                 <?php //echo $this->inputdata['contact'];?>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                    <!-- invoice# and detail -->
                                    <div class="col-xs-6 pull-right text-right">
                                        
                                                <br><h4><b>สำเนาใบกำกับภาษีและใบส่งของ</b></h4><br>
                                                <strong>เอกสารออกเป็นชุด</strong>
                                                
                                                <p>เลขประจำตัวผู้เสียภาษีอากร : 3 501 00047 0<br>
                                                ทะเบียนนิติบุคคลเลขที่: 0 50 5503 00007 8</p>

                                                <strong>หมายเลขใบเสร็จ : </strong> <?php echo $this->invoice;?><br>
                                                <?php if($this->printdate == '1'){   
                                                        echo '<strong>วันที่ : </strong>'.$this->today['mday'].' ';
                                                        echo $this->strMonthThai.' ';
                                                        echo $this->today['year']+543;
                                                    }?>
                                                <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- invoice item detail -->
                        <div class="row">
                            <div class="col-lg-12">

                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รายการสินค้า</th>
                                            <th>ราคาต่อหน่วย</th>
                                            <th>จำนวน</th>
                                            <th>ราคา</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <!-- query and fetch rows -->
                                     <?php 
                                        echo $this->result;
                                    ?>
     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class='bottom-group'>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6 pull-left ">
                                <span>
                                    <b>ราคาเป็นตัวอักษร:</b><br> <?php echo  $this->numberToText;?>
                                </span></br></br>
                                <span>
                                    <b>เงื่อนไขการชำระเงิน</b> ภายใน 
                                                    <?php if($this->inputdata['paymentDuration']== 0){ 
                                                            echo '-';
                                                        } else{
                                                            echo $this->inputdata['paymentDuration'];
                                                        }?> วัน                                       
                                </span><br>

                                <span>
                                    <?php if($this->inputdata['paymentType']=='เงินสด'){
                                                   $this->box1='■'; $this->box2='□';
                                                } else {
                                                   $this->box1='□'; $this->box2='■';
                                                }?><br>

                                    ชำระโดย<br>
                                    <?php echo $this->box1;?> เงินสด<br>
                                    <?php echo $this->box2;?> เช็ค/ธนาคาร______________สาขา______________<br>
                                        </p>เลขที่เช็ค___________________ลงวันที่___/_____/____<br>
                                </span>

                            </div>
                            <div class="col-xs-4 pull-right">
                                <table class="table table-condensed">
                                    <tr >
                                        <td class="text-left">รวมราคาสินค้า</td>
                                        <td class="right">฿ <?php echo $this->subtotal?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">ราคาบริการ</td>
                                        <td class="right">฿ <?php echo $this->wage ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Discount</td>
                                        <td class="right">฿ <?php echo $this->discount ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">ภาษีมูลค่าเพิ่ม</td>
                                        <td class="right">฿ <?php echo $this->vat ?></td>
                                    </tr>
                                    <tr class="active">
                                        <td class="text-left">รวมราคาสุทธิ</td>
                                        <td class="right">฿ <?php echo $this->total ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-xs-6 pull-right" >
                                         <p style="float: right">ลงชื่อ _________________________ ผู้รับสินค้า<br>
                                            ลงชื่อ _________________________ ผู้ขาย<br>
                                            ลงชื่อ _________________________ ผู้รับเงิน<br>
                                            วันที่ ____/________/______<br>
                                            </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">

                                <p class="small">ถ้าท่านชำระเงินด้วยเช็ค โปรดจ่ายเช็คขีดคร่อมในนาม บริษัท เทพนิธิ จำกัดใบเสร็จรับเงินฉบับนี้จะสมบูรณ์ก็ต่อเมื่อเช็คของท่านเรียกเก็บจากธนาคารได้ครบถ้วน</p>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $(function () {
                        $("#print-post").on("click", function (e) {
                            e.preventDefault();
                            window.print();
                        });
                    });
                </script>