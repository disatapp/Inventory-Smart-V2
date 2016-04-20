/**
 * Adds the a new sell order to and displays the DOM element
 * @param {Object} HTMLid 
 * @param {Object} stack
 * @return {Number} DOM element
 */
function addSell(stack){
    _changeTotal();
    
    if(!($("#localid").val() == '') && !($("#itemname").val() == '') && !($("#quantity").val() == 0) && !($("#totalamount").val() == 0)) {
        

        var localid = $("#prelocalid").val()+$("#localid").val();
        if((localid in stack)){
            alert("This part has already been added to the pending list!");
            return;
        }

        var itemname = $("#itemname").val()
        var quantity = Math.abs($("#quantity").val());
        var priceperunit = (Math.abs($("#priceperunit").val())).toFixed(2);
        var totalamount = $("#totalamount").val();

        var arr = [localid, totalamount, quantity];
        var tag = document.createElement("tr");
        tag.innerHTML = "<td>"+localid+"</td>\n<td>"+
                        itemname+"</td>\n<td>"+
                        quantity+"</td>\n<td>"+
                        priceperunit+"</td>\n<td>"+
                        totalamount+"</td>\n<td><a class='delete-row btn btn-danger remove'>"+
                        "<span class=' glyphicon glyphicon-trash'></span></a>\n</td>\n";
        document.getElementById("tbodyid").appendChild(tag);
        stack[localid] = arr;
        document.getElementById("sell-form").reset();
        // console.log(stack);
        alert('Element Added');
    } else {
        alert('กรุณาใส่ข้อมูลทุกช่อง');
    }
}

/**
 * Submit the sell items once the item has been sent clear and remove stack
 * @param {Object} HTMLid
 * @param {Object} stack 
 * @return {text} inside the table 
 */
function submitSell(HTMLid, stack, hosturl){
    $(HTMLid).on('click', function(e){
        e.preventDefault();
        if($.isEmptyObject(stack)){
            alert('กรุณาใส่สินค้าอย่างน้อย 1 รายการ');
            return;
        }
        var id = $("#cusname").val();
        
        if(id == '') {
            alert("กรุณาใส่ชื่อลูกค้า");
            return;
        }
        if( $("#duration").val() == '' || $("#wage").val() == '' || $("#discount").val() == ''|| $('#VAT').val() == '') {
            alert("กรุณาใส่รายละเอียดการขายให้ครบ");
            return;
        }
        var paymenttype = $('input[name=group1]:checked', '#sell-addition').val();
        var duration = Math.abs($("#duration").val());
        var wage = (Math.abs($("#wage").val())).toFixed(2);
        var discount = (Math.abs($("#discount").val())).toFixed(2);
        var vat = Math.abs($('#VAT').val()).toFixed(2);
        // var print = $('input[name=group2]:checked', '#sell-addition').val();
        var stackdata = JSON.stringify(stack);
        var invoicedata = JSON.stringify({'id': id,'duration': duration,'paymenttype': paymenttype,'wage': wage,'discount': discount });

        $.ajax({ 
                type: "POST",
                url: hosturl + "submit",
                data: { 'stack': stackdata, 'invoice': invoicedata },
                dataType: 'text',
                success: function(html){
                    // console.log(html);
                    if(html != false){
                        if(confirm("Are you sure you want to submit this form?")){
                            alert(hosturl.replace('sell/','printing/preview/')+html+'/'+$('input[name="printdate"]:checked').val()+'/'+vat);
                            // location.href = hosturl.replace('sell/','printing/preview/')+html+'/' +$('input[name="printdate"]:checked').val() + '/'+ $('#VAT').val();
                            // location.href = hosturl + "print/"+html;
                        } else {
                            location.href = hosturl;
                        }
                        
                        
                    } else {
                        alert("An error has occured.");
                    }
                }
            });
        return false;
    });
}

/**
 * Event Handler for finding customers
 */
function getCustomer(hosturl){
    var id = $("#cusname").val();
    if(id == ''){
        return;
    }
    $.ajax({
        type: "POST",
        url: hosturl + "find_cus",
        data: {'id': id },
        dataType: 'json',
        success: function(html){                            
            console.log(html[0]);
            if(html != false){
                var id = '';
                $('#cus-form :input').each(function(index){
                    if($(this).attr('id') != 'cusname'){
                        document.getElementById($(this).attr('id')).value = html[index-1];
                    }
                });
            }else{
                $('#cus-form :input').each(function(index){
                    if($(this).attr('id') != 'cusname'){
                        document.getElementById($(this).attr('id')).value = "No information";
                    }
                });
            }              
        }
    });
}
