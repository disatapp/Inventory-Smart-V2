function $cus_adder(HTMLid, hosturl){
    $(HTMLid).on('click',function(e) {
        e.preventDefault();

        console.log("Customer adder.");

        //find if name is populated
        if(!($("#addname").val())){
             alert("กรุณาใส่ชื่อลูกค้าที่ต้องการเพิ่มเข้าสู่ระบบ");
             return false;
        }

        //pop-up to confirm addition
        if(!confirm("ท่านต้องการเพิ่มลูกค้าใหม่หรือไม่?")){
            return false;
        }

        //change all blanks into -
        var name = $("#addname").val();
        var surname = $("#addsurname").val() === "" ? "-" : $("#addsurname").val();
        //check if the cus name already exists and add cus
        existingCusChecker(name,surname, hosturl);
        //return false;
    });
}

function existingCusChecker(cusname, cusSurname, hosturl){
    console.log("Check exists customer.");
    $.ajax({
        url: hosturl + 'check',
        type: 'GET',
        dataType: 'text',
        data: "name="+cusname+"&surname="+cusSurname,
        success: function(result){
            console.log(result);
            if(result==="existed"){
                // ask if still want to add
                if(!confirm("ลูกค้าที่มีชื่อเช่นนี้มีอยูในระบบแล้ว\n"+
                    "ท่านยังต้องการเพิ่มลูกค้าท่านนี้หรือไม่?")){
                    return false;
                } else {
                    //call the adder
                    addNewCus(hosturl);
                }
            }else if(result==="none-existed") {
                //add new customer
                addNewCus(hosturl);
            }else{
                //throw error
            }
        }
    });
}

function addNewCus(hosturl){
    //change all blanks into -
    var name = $("#addname").val();
    var surname = $("#addsurname").val() === "" ? "-" : $("#addsurname").val();
    var address = $("#addaddress").val() === "" ? "-" : $("#addaddress").val();
    var bldname = $("#addbldname").val() === "" ? "-" : $("#addbldname").val();
    var muu = $("#addmuu").val() === "" ? "-" : $("#addmuu").val();
    var soi = $("#addsoi").val() === "" ? "-" : $("#addsoi").val();
    var road = $("#addroad").val() === "" ? "-" : $("#addroad").val();
    var subdis = $("#addsubdis").val() === "" ? "-" : $("#addsubdis").val();
    var dis = $("#adddis").val() === "" ? "-" : $("#adddis").val();
    var prov = $("#addprov").val() === "" ? "-" : $("#addprov").val();
    var zip = $("#addzip").val() === "" ? "-" : $("#addzip").val();
    var tel = $("#addtel").val() === "" ? "-" : $("#addtel").val();
    var fax = $("#addfax").val() === "" ? "-" : $("#addfax").val();
    var taxnum = $("#addtaxnum").val() === "" ? "-" : $("#addtaxnum").val();

    $.ajax({
        url: hosturl + 'post',
        type: 'POST',
        dataType: 'text',
        data: "name="+name+"&surname="+surname+"&address="+address+"&bldname="+bldname+
        "&muu="+muu+"&soi="+soi+"&road="+road+"&subdis="+subdis+"&dis="+dis+"&prov="+
        prov+"&zip="+zip+"&tel="+tel+"&fax="+fax+"&taxnum="+taxnum,
        success: function(result){
            if(result=='true'){
                //show that the addition was successful
                alert("เพิ่มชื่อลูกค้าสำเร็จ");
                //clear the values
                //$('#adder-form').find('input:text').val('');
                $(".add-form").val("");
            } else {
                alert("An error has occured.");
                //show the error
            }
        }
    });
}

function $cus_searcher(HTMLid, hosturl){
    $(HTMLid).on('click',function(e) {
        e.preventDefault();

        console.log("Search customer.");

        //remove all element in the table
        // $("#search-tbody").empty();
        // delete old edit form
        // $("#editor-popup").empty();

        //find if name or surname is entered
        if(!($("#name").val()) && !($("#surname").val())){
             alert("กรุณาใส่ชื่อหรือนามสกุลของลูกค้าที่ท่านต้องการค้นหา");
             return false;
        }
        
        var name = $("#name").val();
        var surname = $("#surname").val();

        $.ajax({
            url: hosturl + 'get',
            type: 'GET',
            dataType: 'JSON',
            data: { 'name' : name, 'surname' : surname },
            success: function(html){
                if(!html){
                    alert("ไม่มีลูกค้าดังกล่าวในระบบ");
                } else {
                    //print table
                    var rows = html.length;
                    for (var i = 0; i < rows; i++) {
                    var curr_row = html[i];
                    var tag = document.createElement("tr");
                    tag.innerHTML = "<td class='table-cusID'>"+curr_row[0]+"</td>\n"+
                                "<td class='table-name'>"+curr_row[1]+"</td>\n"+
                                "<td class='table-surname'>"+curr_row[2]+"</td>\n"+
                                "<td class='table-address'>"+curr_row[3]+"</td>\n"+
                                "<td class='table-bldname'>"+curr_row[4]+"</td>\n"+
                                "<td class='table-muu'>"+curr_row[5]+"</td>\n"+
                                "<td class='table-soi'>"+curr_row[6]+"</td>\n"+
                                "<td class='table-road'>"+curr_row[7]+"</td>\n"+
                                "<td class='table-subdis'>"+curr_row[8]+"</td>\n"+
                                "<td class='table-dis'>"+curr_row[9]+"</td>\n"+
                                "<td class='table-prov'>"+curr_row[10]+"</td>\n"+
                                "<td class='table-zip'>"+curr_row[11]+"</td>\n"+
                                "<td class='table-tel'>"+curr_row[12]+"</td>\n"+
                                "<td class='table-fax'>"+curr_row[13]+"</td>\n"+
                                "<td class='table-taxnum'>"+curr_row[14]+"</td>\n"+
                                "<button data-toggle='modal' data-target='#cusModal'"+
                                " class='edit-search btn btn-danger' id='"+
                                curr_row[0]+"' >แก้ไข</button>\n</td>\n";
                    document.getElementById("search-tbody").appendChild(tag);
                    }
                }
            }
        });

        return false;
    });
}

function editCustomer(){
    $(document).on('click','.edit-search',function(e) {
        e.preventDefault();
        console.log("Customer editor.");
        // delete old edit form
        // $("#editor-popup").empty();
        var editing_row = $(this).parent();
        $('.save-edited-cus.btn.btn-primary.save').eq(0).attr('id', editing_row.find('.table-cusID').text());

        //add existing data into boxes
        $("#editname").val(editing_row.find('.table-name').text());
        $("#editsurname").val(editing_row.find('.table-surname').text());
        $("#editaddress").val(editing_row.find('.table-address').text());
        $("#editbldname").val(editing_row.find('.table-bldname').text());
        $("#editmuu").val(editing_row.find('.table-muu').text());
        $("#editsoi").val(editing_row.find('.table-soi').text());
        $("#editroad").val(editing_row.find('.table-road').text());
        $("#editsubdis").val(editing_row.find('.table-subdis').text());
        $("#editdis").val(editing_row.find('.table-dis').text());
        $("#editprov").val(editing_row.find('.table-prov').text());
        $("#editzip").val(editing_row.find('.table-zip').text());
        $("#edittel").val(editing_row.find('.table-tel').text());
        $("#editfax").val(editing_row.find('.table-fax').text());
        $("#edittaxnum").val(editing_row.find('.table-taxnum').text());

        //call edit pop-up page
    });
}

function saveEditedCustomer(hosturl) {
    $(document).on('click','.save-edited-cus',function(e) {
        e.preventDefault();

        console.log("Save edited customer.");

        //find if name is populated
        if(!($("#editname").val())){
             alert("กรุณาใส่ชื่อลูกค้า");
             return false;
        }

        //pop-up to confirm addition
        if(!confirm("ท่านต้องการบันทึกข้อมูลที่แก้ไขแล้วหรือไม่?")){
            return false;
        }
        
        //change all blanks into -
        var name = $("#editname").val();
        var surname = $("#editsurname").val() === "" ? "-" : $("#editsurname").val();
        var address = $("#editaddress").val() === "" ? "-" : $("#editaddress").val();
        var bldname = $("#editbldname").val() === "" ? "-" : $("#editbldname").val();
        var muu = $("#editmuu").val() === "" ? "-" : $("#editmuu").val();
        var soi = $("#editsoi").val() === "" ? "-" : $("#editsoi").val();
        var road = $("#editroad").val() === "" ? "-" : $("#editroad").val();
        var subdis = $("#editsubdis").val() === "" ? "-" : $("#editsubdis").val();
        var dis = $("#editdis").val() === "" ? "-" : $("#editdis").val();
        var prov = $("#editprov").val() === "" ? "-" : $("#editprov").val();
        var zip = $("#editzip").val() === "" ? "-" : $("#editzip").val();
        var tel = $("#edittel").val() === "" ? "-" : $("#edittel").val();
        var fax = $("#editfax").val() === "" ? "-" : $("#editfax").val();
        var taxnum = $("#edittaxnum").val() === "" ? "-" : $("#edittaxnum").val();

        var cusID = $(this).attr('id');
        $.ajax({
            url: hosturl + 'update',
            type: 'POST',
            dataType: 'text',
            data: "name="+name+"&surname="+surname+"&address="+address+"&bldname="+bldname+
            "&muu="+muu+"&soi="+soi+"&road="+road+"&subdis="+subdis+"&dis="+dis+"&prov="+
            prov+"&zip="+zip+"&tel="+tel+"&fax="+fax+"&taxnum="+taxnum+"&cusID="+cusID,
            success: function(html){
                if(html=='true'){
                    //show that the addition was successful
                    alert("แก้ไขข้อมูลลูกค้าสำเร็จ: "+name);
                    //clear the edit form
                    // $("#editor-popup").empty();
                    //update the table
                    var refrehing_tr = $(".table-cusID").filter(function() {
                                        return $(this).text() === cusID;
                                        }).parent();
                    refrehing_tr.children('.table-name').text(name)
                    refrehing_tr.children('.table-surname').text(surname);
                    refrehing_tr.children('.table-address').text(address);
                    refrehing_tr.children('.table-bldname').text(bldname);
                    refrehing_tr.children('.table-muu').text(muu);
                    refrehing_tr.children('.table-soi').text(soi);
                    refrehing_tr.children('.table-road').text(road);
                    refrehing_tr.children('.table-subdis').text(subdis);
                    refrehing_tr.children('.table-dis').text(dis);
                    refrehing_tr.children('.table-prov').text(prov);
                    refrehing_tr.children('.table-zip').text(zip);
                    refrehing_tr.children('.table-tel').text(tel);
                    refrehing_tr.children('.table-fax').text(fax);
                    refrehing_tr.children('.table-taxnum').text(taxnum);
                } else {
                    alert("An error has occured.");
                    //show the error
                }
            }
        });

        return false;
    });
}