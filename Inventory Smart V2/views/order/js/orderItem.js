/**
 * Adds the a new order to and displays the DOM element
 * @param {Object} HTMLid 
 * @param {Object} stack
 * @return {Number} DOM element
 */
function addOrder(stack){
    _changeTotal();
    console.log('val:'+$("#itemname").val());
    if(!($("#localid").val() == '') && !($("#itemname").val() == '') && !($("#quantity").val() == 0) && !($("#totalamount").val() == 0)){
        var localid = $("#prelocalid").val()+$("#localid").val();
        if((localid in stack)){
            alert("This part has already been added to the pending list!");
            return;
        }
        var itemname = $("#itemname").val();
        var suppliername = _getSelectedText("order-supname");
        var supplierid = $("#order-supname").val();
        var quantity = Math.abs($("#quantity").val());
        var priceperunit = (Math.abs($("#priceperunit").val())).toFixed(2);
        var totalamount = $("#totalamount").val();
        var arr = [localid, supplierid, quantity, priceperunit, totalamount];
        var tag = document.createElement("tr");
        tag.innerHTML = "<td>"+localid+"</td>\n<td>"+
                        itemname+"</td>\n<td>"+
                        suppliername+"</td>\n<td>"+
                        quantity+"</td>\n<td>"+
                        priceperunit+"</td>\n<td>"+
                        totalamount+"</td>\n<td><a class='delete-row btn btn-danger remove'>"+
                        "<span class=' glyphicon glyphicon-trash'></span></a>\n</td>\n";
        document.getElementById("tbodyid").appendChild(tag);
        stack[localid] = arr;
        document.getElementById("order-form").reset();
        alert('Element Added to list');
    } else {
        alert('กรุณาใส่ข้อมูลทุกช่อง');
    }
}

/**
 * Delete append DOM element and remove time
 * @param {Object} stack
 */
function deleteOrder(stack){
    $(document).on('click', '.delete-row',function(e) {
        //get text from the first element
        var id = $(this).parent().siblings(":first").text();
        delete stack[id]; 
        $(this).closest('tr').fadeOut(500, function() { 
            $(this).remove(); 
        });;
    });
}



function changeTotalOrder(HTMLid){
    
    $(HTMLid).keyup(function(e){
        _changeTotal();
    });
}

function _changeTotal(){
    var ppu = Math.floor($("#priceperunit").val() * 100)/100;
    var q = parseInt($("#quantity").val(),10);
    if (typeof q === 'number' && (q%1) === 0){
        var total = ((q%1) === 0) ? Math.abs(ppu) * Math.abs(q): 0;
        document.getElementById("totalamount").value = parseFloat(total).toFixed(2);
    }
}

/**
 * Submit the ordered items once the item has been sent clear and remove stack
 * @param {Object} HTMLid
 * @param {Object} stack 
 * @return {text} inside the table 
 */
function submitOrder(HTMLid, stack, hosturl){
    $(HTMLid).on('click', function(e){
        e.preventDefault();
        console.log(stack);
        if($.isEmptyObject(stack) || ($("#orderingdate").val() == '')){
            alert('กรุณาเลือกวันที่สั่งสินค้า');
            return;
        }
        var orderingdate = $("#orderingdate").val();
        var data = JSON.stringify(stack);
        $.ajax({
            type: "POST",
            url: hosturl + "submit",
            data: { 'stack': data,
                    'orderingdate': orderingdate },
            dataType: 'text',
            success: function(html){                            
                    console.log(html);
                    if(html != false){
                        location.href = "order/index";
                    } else {
                        alert("An error has occured.");
                    }
                }
            });
        return false;
    });
}

/**
 * Event Listener for Part Input
 * @param {Object} HTMLid 
 */
function textTimer(HTMLid, hosturl){
    // var timer;               
    // var timerInterval = 3000;
    // $(HTMLid).on('keyup', function () {
    //     clearTimeout(timer);
    //     timer = setTimeout(getPart(hosturl), timerInterval);
    // });

    $(HTMLid).focusout(function(e) {
        getPart(hosturl);
    });
}

/**
 * Event Handler for finding parts
 */
function getPart(hosturl, stack, callback){
    var pre = document.getElementById("prelocalid");
    var str = pre.options[pre.selectedIndex].value;
    var localid = $("#localid").val();
    var q = Math.abs($("#quantity").val());
    var id = localid.toString();
    if(id == ''){
        return;
    }
    if(id.length < 3){
        id = ("000" + id).slice(-3);
    } 
    localid = str.concat(id);
    $.ajax({
        type: "POST",
        url: hosturl + "find_part",
        data: {'localid': localid },
        dataType: 'json',
        // error: function(jqXHR, textStatus, errorThrown) {
        //         alert('An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!');

        // },
        success: function(html){                         
            var arr = $.map(html, function(el) { return el; })
            if(arr[0] != 'false'){
                $("#error-localid").fadeOut();
                document.getElementById("localid").value = id;
                document.getElementById("itemname").value = html['name'];
                document.getElementById("itemid").value = html['id'];
                document.getElementById("priceperunit").value = html['ppu'];
                var total = 0.00;
                if(q > 0){
                    total = html['ppu'] * q;
                }
                document.getElementById("totalamount").value = parseFloat(total).toFixed(2);
                if (callback && typeof(callback) === "function") {
                    console.log('success');
                    callback(stack);
                }
            }else{
                $("#error-localid").fadeIn();
                var elem = document.getElementsByTagName("input");
                for (var i=0; i < elem.length; i++) {
                    if (elem[i].type == 'text') {
                        elem[i].value = '';
                    }
                }
                document.getElementById("localid").value = id;
            }   
        }
    });
}

/**
 * get the text from the option field
 * @param {Object} elementId
 * @return {text} inside the table 
 */
function _getSelectedText(elementId) {
    var select = document.getElementById(elementId);

    if (select.selectedIndex == -1){
        return null;
    }

    return select.options[select.selectedIndex].text;
}
