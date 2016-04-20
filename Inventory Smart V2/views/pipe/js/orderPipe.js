function addPipeOrder(stack){
    if(!($("#localid").val() == '') && !($("#itemname").val() == '') && !($("#quantity").val() == 0) && !($("#quantity").val() == '')){
        var localid = "LO"+$("#localid").val();
        if((localid in stack)){
            alert("This type of pipe has already been added to the pending list!");
            return;
        }
        var itemname = $("#itemname").val();
        var quantity = Math.abs($("#quantity").val());

        var arr = [localid, quantity];
        var tag = document.createElement("tr");
        tag.innerHTML = "<td>"+localid+"</td>\n<td>"+
                        itemname+"</td>\n<td>"+
                        quantity+"</td>\n<td><a class='delete-row btn btn-danger remove'>"+
                        "<span class=' glyphicon glyphicon-trash'></span></a>\n</td>\n";
        document.getElementById("tbodyid").appendChild(tag);
        stack[localid] = arr;
        document.getElementById("order-form").reset();
        alert('Pipe added to list');
    } else {
        alert('กรุณาใส่ข้อมูลทุกช่อง');
    }
}


function submitPipeOrder(HTMLid, stack, hosturl, sheetcount){
    $(HTMLid).on('click', function(e){
        e.preventDefault();
        
        var q = $("#squantity").val();
        if($.isEmptyObject(stack)){
            alert('กรุณาใส่ท่ออย่างน้อย 1 รายการ');
            return;
        }
        if(q == ''){
            alert('กรุณาใส่จำนวนแผ่นเหล็กที่เบิก');
            return;
        }
        //check the quantity if its > what is left
        if(q > sheetcount){
            alert('ปริมาณแผ่นเหล็กที่ใช้มากกว่าที่มีเก็บไว้ในสต็อก\nกรุณาเลือกจำนวนแผ่นเหล็กใหม่');
            return;
        }

        var data = JSON.stringify(stack);
        console.log(data);
        $.ajax({
        type: "POST",
        url: hosturl + "submit",
        data: { 'stack': data,
                'squantity': q  },
        dataType: 'text',
        success: function(html){                            
                console.log(html);
                if(html != false){
                    location.href = hosturl;
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
function textSheetTimer(HTMLid, hosturl){
    // var timer;               
    // var timerInterval = 1000;
    // $(HTMLid).on('keyup', function () {
    //     clearTimeout(timer);
    //     timer = setTimeout(getSheet(hosturl), timerInterval);
    // });

    $(HTMLid).focusout( function(e) {
        getSheet(hosturl);
    });
}


function deletePipeOrder(stack){
    $(document).on('click', '.delete-row',function(e) {
        //get text from the first element
        var id = $(this).parent().siblings(":first").text();
        delete stack[id]; 
        $(this).closest('tr').fadeOut(500, function() { 
            $(this).remove(); 
        });;
    });
}

function getSheet(hosturl, stack, callback){
    var localid = $("#localid").val();
    if(localid == ''){
        return;
    }
    if(localid.length < 3){
        localid = ("000" + localid).slice(-3);
    }
     var id = 'LO'+localid.toString();
    $.ajax({
        type: "POST",
        url: hosturl + "find_part",
        data: { 'localid': id},
        dataType: 'json',
        success: function(html){                            
            var arr = $.map(html, function(el) { return el; });
            if(arr[0] != 'false'){
                $("#error-localid").fadeOut();
                document.getElementById("localid").value = localid;
                document.getElementById("itemname").value = html['name'];
                if (callback && typeof(callback) === "function") {
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
                document.getElementById("localid").value = localid;
            }   
        }
    });
}