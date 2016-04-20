function $part_adder(HTMLid, hosturl) {
    $(HTMLid).on('click',function(e){
        e.preventDefault();

        console.log("Add new part.");

        //find if partname is populated
        if(!($("#adderpartname").val())){
            alert("กรุณาใส่ชื่อสินค้าที่ต้องการเพิ่มเข้าสู่ระบบ");
            return false;
        }

        //pop-up to confirm addition
        if(!(confirm("ท่านต้องการเพิ่มสินค้าใหม่หรือไม่?"))){
            return false;
        }

        var localid = $("#adder-part-localid-selector").val()+$("#adder-localid-textbox").val();
        var partname = $("#adderpartname").val();

        //add - or 0 to the blank fields
        var partnumber = $("#adderpartnumber").val() === "" ? "-" : $("#adderpartnumber").val();
        var storingplace = $("#adderstoringplace").val() === "" ? "-" : $("#adderstoringplace").val();
        var priceperunit = $("#adderpriceperunit").val() === "" ? "0" : $("#adderpriceperunit").val();
        var quantity = $("#adderquantity").val() === "" ? "0" : $("#adderquantity").val();
        var regularprice =$("#adderregularprice").val() === "" ? "0" : $("#adderregularprice").val();
        var commissionprice = $("#addercommissionprice").val() === "" ? "0" : $("#addercommissionprice").val();
        var warningquantity = $("#adderwarningquantity").val() === "" ? "0" : $("#adderwarningquantity").val();
        var note = $("#addernote").val() === "" ? "-" : $("#addernote").val();

        $.ajax({
            url: hosturl + 'post',
            type: 'POST',
            dataType: 'text',
            data: "localid="+localid+"&partname="+partname+"&partnumber="+partnumber+"&storingplace="+storingplace+
            "&priceperunit="+priceperunit+"&quantity="+quantity+"&regularprice="+regularprice+
            "&commissionprice="+commissionprice+"&warningquantity="+warningquantity+"&note="+note,
            success: function(html){
                console.log(html);
                if(html=='true'){
                    //show success
                    alert("เพิ่มสินค้าใหม่สำเร็จ: "+localid);
                    //clear all fields
                    $(".add-form").val("");
                    //find next localid number
                    localIDFinder(hosturl);
                } else {
                    alert("An error has occured.");
                    //show the error
                }
            }
        });
        return false;    
    });
}

//from stackoverflow
function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function localIDFinder(hosturl){
    $.ajax({
        url: hosturl + 'check',
        type: 'GET',
        dataType: 'text',
        data: "localid="+$("#adder-part-localid-selector").val(),
        success: function(html){
            if(html){
                //set the value of the next part localid after incrementing it
                var number = parseInt(html);
                number++;
                $("#adder-localid-textbox").val(pad(number,3));
            } else {
                //show error
                alert("An error has occured.");
            }
        }
    });
}

function aiNextLocalID(hosturl){
    $(document).on('change', '#adder-part-localid-selector', function(event) {
        event.preventDefault();
        localIDFinder(hosturl);
        return false;
    });
}

function $part_searcher(HTMLid, host){
    $(HTMLid).on('click',function(e){
        e.preventDefault();

        console.log("Search for part.");

        //delete old table
        // $("#search-tbody").empty();
        // delete old edit form
        // $("#editor-popup").empty();

        var check_fields = false;
        $(".add-input").each(function() {
            if($(this).val()!="") {
                check_fields = true;
                return false;
            }
        });
        //find if at leat one criteria is inserted
        if(!check_fields){
            alert("กรุณาใส่ข้อมูลสินค้าที่ต้องการค้นหาอย่างน้อย 1 ช่อง");
            return false;
        }

        var localid = "";

        //check the localID structure validity --> XX000 or XX
        //if the localid textbox is populated, the user is using this field to search
        //if not, the user is not using the field so the search criteria for localid = ""
        if($("#localid-textbox").val()){
            if($("#localid-textbox").val().length !== 3){
                alert("กรุณาใส่รหัสสินค้าตามรูปแบบในตัวอย่าง\nตัวอย่าง: AA001");
                return false;
            }else{
                localid = $("#part-localid-selector").val()+$("#localid-textbox").val();
            }
        }
        
        var partname = $("#partname").val();
        var partnumber = $("#partnumber").val();
        var storingplace = $("#storingplace").val();

        $.ajax({    
            url: hosturl + 'get',
            type: 'GET',
            dataType: 'JSON',
            data: { 'localid' : localid, 'partname' : partname, 'partnumber' : partnumber,
                    'storingplace' : storingplace },
            success: function(result){
                console.log(result);
                if(!result){
                    alert("ไม่มีสินค้าดังกล่าวในระบบ");
                } else {
                    //print table
                    var rows = result.length;
                    for (var i = 0; i < rows; i++) {
                    var curr_row = result[i];
                    var tag = document.createElement("tr");
                    tag.innerHTML = "<td class='table-localID'>"+curr_row[0]+"</td>\n"+
                                "<td class='table-partname'>"+curr_row[1]+"</td>\n"+
                                "<td class='table-partnumber'>"+curr_row[2]+"</td>\n"+
                                "<td class='table-storingplace'>"+curr_row[3]+"</td>\n"+
                                "<td class='table-priceperunit'>"+curr_row[4]+"</td>\n"+
                                "<td class='table-quantity'>"+curr_row[5]+"</td>\n"+
                                "<td class='table-regularprice'>"+curr_row[6]+"</td>\n"+
                                "<td class='table-commissionprice'>"+curr_row[7]+"</td>\n"+
                                "<td class='table-warningquantity'>"+curr_row[10]+"</td>\n"+
                                "<td class='table-note'>"+curr_row[11]+"</td>\n"+
                                "<button data-toggle='modal' data-target='#partModal'"+
                                " class='edit-search btn btn-danger' id='"+
                                curr_row[0]+"'>แก้ไข</button>\n</td>\n";
                    document.getElementById("search-tbody").appendChild(tag);
                    }
                }
            }
        });
        return false;
    });
}

function editPart(){
    $(document).on('click','.edit-search',function(e) {

        console.log("Part editor.");

        // delete old edit form
        // $("#editor-popup").empty();
        var editing_row = $(this).parent();
        $('.save-edited-part.btn.btn-primary.save').eq(0).attr('id', editing_row.find('.table-localID').text());

        //add existing data into boxes
        $("#edit-partname").val(editing_row.find('.table-partname').text());
        $("#edit-partnumber").val(editing_row.find('.table-partnumber').text());
        $("#edit-storingplace").val(editing_row.find('.table-storingplace').text());
        $("#edit-priceperunit").val(editing_row.find('.table-priceperunit').text());
        $("#edit-quantity").val(editing_row.find('.table-quantity').text());
        $("#edit-regularprice").val(editing_row.find('.table-regularprice').text());
        $("#edit-commissionprice").val(editing_row.find('.table-commissionprice').text());
        $("#edit-warningquantity").val(editing_row.find('.table-warningquantity').text());
        $("#edit-note").val(editing_row.find('.table-note').text());

        //call edit pop-up page
    });
}

function saveEditedPart(hosturl) {
    $(document).on('click','.save-edited-part',function(e) {
        e.preventDefault();

        console.log("Save edited part.");

        //find if name is populated
        if(!($("#edit-partname").val())){
             alert("กรุณาใส่ชื่อสินค้า");
             return false;
        }

        //pop-up to confirm addition
        if(!confirm("ท่านต้องการบันทึกข้อมูลที่แก้ไขแล้วหรือไม่?")){
            return false;
        }
        
        //add - or 0 to the blank fieldsvar localid = $("#part-localid-selector").val()+$("#localid-textbox").val();
        var partname = $("#edit-partname").val();
        var partnumber = $("#edit-partnumber").val() === "" ? "-" : $("#edit-partnumber").val();
        var storingplace = $("#edit-storingplace").val() === "" ? "-" : $("#edit-storingplace").val();
        var priceperunit = $("#edit-priceperunit").val() === "" ? "0" : $("#edit-priceperunit").val();
        var quantity = $("#edit-quantity").val() === "" ? "0" : $("#edit-quantity").val();
        var regularprice =$("#edit-regularprice").val() === "" ? "0" : $("#edit-regularprice").val();
        var commissionprice = $("#edit-commissionprice").val() === "" ? "0" : $("#edit-commissionprice").val();
        var warningquantity = $("#edit-warningquantity").val() === "" ? "0" : $("#edit-warningquantity").val();
        var note = $("#edit-note").val() === "" ? "-" : $("#edit-note").val();

        var localid = $(this).attr('id');

        $.ajax({
            url: hosturl + 'update',
            type: 'POST',
            dataType: 'text',
            data: "localid="+localid+"&partname="+partname+"&partnumber="+partnumber+"&storingplace="+storingplace+
            "&priceperunit="+priceperunit+"&quantity="+quantity+"&regularprice="+regularprice+
            "&commissionprice="+commissionprice+"&warningquantity="+warningquantity+"&note="+note,
            success: function(result){
                // console.log(result);
                if(result == 'true'){
                    //show that the addition was successful
                    alert("แก้ไขข้อมูลสินค้าสำเร็จ: "+localid);
                    //clear the edit form
                    // $("#editor-popup").empty();
                    //update the table
                    var refrehing_tr = $(".table-localID").filter(function() {
                                        return $(this).text() === localid;
                                        }).parent();
                    refrehing_tr.children('.table-partname').text(partname)
                    refrehing_tr.children('.table-partnumber').text(partnumber);
                    refrehing_tr.children('.table-storingplace').text(storingplace);
                    refrehing_tr.children('.table-priceperunit').text(priceperunit);
                    refrehing_tr.children('.table-quantity').text(quantity);
                    refrehing_tr.children('.table-regularprice').text(regularprice);
                    refrehing_tr.children('.table-commissionprice').text(commissionprice);
                    refrehing_tr.children('.table-warningquantity').text(warningquantity);
                    refrehing_tr.children('.table-note').text(note);
                } else {
                    alert("An error has occured.");
                    //show the error
                }
            }
        });

        return false;
    });
}