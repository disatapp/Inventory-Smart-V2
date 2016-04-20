function searchRequest(HTMLid, hosturl){
	////////////'REDO THIS FUNCTION IST BROKEN'
	    $(HTMLid).on('click',function(e) {
        e.preventDefault();
        if($('#startdate').val() == '' || $('#enddate').val() == '' ){
            alert("กรุณาใส่วันเริ่มและสิ้นสุด");
            return;
        }
        var string ='';
        $.ajax({
            type: "GET",
            url: hosturl+"get",
            data: { 'start': $('#startdate').val(),
                    'end': $('#enddate').val() },
            dataType: 'json',
	        success: function(html){               
	            if(html != false){
	                $("#error-load").fadeOut();
	                
	                for (var k = 0;k < html.length ;k++) {
	                    if(k == 0){
	                        var tag = document.createElement("div");
	                        tag.className = 'row';
	                        string = "<div class='col-lg-12 content-box'><div class='expand'><span class='arrow-expand glyphicon glyphicon-chevron-right'></span>"+
	                                 html[k]['requestNumber']+"  |  "+ html[k]['requestDate']+
	                                 "<a class='submit-row btn btn-success btn-sm pull-right'>บันทึก<span class='glyphicon glyphicon-ok'></span></a></div>"+
	                                 "<table class='pending-table table table-hover' style='display: none'><thead><tr>"+ 
	                                 "<th>รหัสสินค้า</th><th>ชื่อ</th><th>จำนวน</th><th>บันทึก</th></tr>"+
	                                 "</thead><tbody>";
	                    } else if(html[k]['requestNumber'] != html[k-1]['requestNumber']){
	                        var tag = document.createElement("div");
	                        tag.className = 'row';
	                        string = "<div class='col-lg-12 content-box'><div class='expand'><span class='arrow-expand glyphicon glyphicon-chevron-right'></span>"+
	                                 html[k]['requestNumber']+"  |  "+ html[k]['requestDate']+
	                                 "<a class='submit-row btn btn-success btn-sm pull-right'>บันทึก<span class='glyphicon glyphicon-ok'></span></a></div>"+
	                                 "<table class='pending-table table table-hover' style='display: none'><thead><tr>"+ 
	                                 "<th>รหัสสินค้า</th><th>ชื่อ</th><th>จำนวน</th><th>บันทึก</th></tr>"+
	                                 "</thead><tbody>";

	                    } 
	                    //get id, orginal LocalID, quantity 
	                    string += "<tr id='"+html[k]['id']+'-'+html[k]['quantity']+"'><td>"+html[k]['LocalID']+"</td><td>"+html[k]['PartName']+"</td><td><input value='"+html[k]['quantity']+"'/></td><td><textarea class='note' style='resize:vertical'>"+html[k]['note']+"</textarea></td></tr>";
	                    if(k == (html.length-1)) {
	                        string += "</tbody></table></div><br>";
	                        tag.innerHTML = string;
	                        string = '';
	                        document.getElementById("request-display").appendChild(tag);
	                    } else if(html[k]['requestNumber'] != html[k+1]['requestNumber']){
	                        string += "</tbody></table></div><br>";
	                        tag.innerHTML = string;
	                        string = '';
	                        document.getElementById("request-display").appendChild(tag);
	                    }

	                }
	            }else{
	                 $("#error-load").fadeIn();
	            }   
	        }
    	});
	});
}

/**
 * Submit the ordered items once the item has been sent clear and remove stack
 * @param {Object} HTMLid
 * @param {Object} stack 
 * @return {text} inside the table 
 */
function submitPending(hosturl) {
    $(document).on('click', '.submit-row',function(e) {
    	if(!confirm("ท่านต้องการเปลี่ยนแปลงข้อมูลรายการขายท่อเต่าบ่ม?")){
    		return;
    	}
        e.preventDefault();
        var $t = $(this).closest('.col-lg-12');
        var table = [];
        var name =['localid','PartName','quantity','Note'];
        var $row = $(this).closest('.col-lg-12').find('tbody tr');
        $row.has('td').each(function(index) {
			var array = {};
			$('td', $(this)).each(function(index, item) {
				array[name[index]] = (index < 2) ? $(item).html() : (index == 2) ? $(item).children('input').val() : $(item).children('textarea').val();
			});
			arr = $(this).attr('id').split('-');
            array['id'] = arr[0];
            array['oq'] = array['quantity'] - arr[1] + '';
        	table.push(array);
        	$(this).attr("id", array['id']+"-"+array['quantity']);
		});

        var data = JSON.stringify(table);
        // console.log(data);
        $.ajax({
	        type: "POST",
	        url: hosturl+ "update",
	        data: { 'data': data },
	        dataType: 'text',
	        success: function(html){                            
	                console.log(html);
	                if(html != false){
	                	alert("เปลี่ยนแปลงข้อมูลสำเร็จ");
	                    // location.href = "pending_item.php";
	                } else {
	                    alert("An error has occured.");
	                }
	            }
        });
        return false;
    });
}

/**
 * Submit the ordered items once the item has been sent clear and remove stack
 * @param {Object} HTMLid
 * @param {Object} stack 
 * @return {text} inside the table 
 */
function editPending(){
    $(document).on('click', '.expand',function(e) {
    	console.log($(this));
        if($(this).is('.submit-row')){
            return;
        }
        var $show = $(this).closest('.content-box').find('table');
        // var $arrow = $(this).find('span:first');
        var $arrow = $(this).find('span:first');
        $('.pending-table').not($show).stop(true).slideUp(100, function(){
            $(this).parent().find('span:first').removeClass('glyphicon-chevron-down');
            $(this).parent().find('span:first').addClass('glyphicon-chevron-right');
        });

        $show.stop(true).toggle(100, function () {
            if($show.is(":hidden")){
                $arrow.removeClass('glyphicon-chevron-down');
                $arrow.addClass('glyphicon-chevron-right');
            } else {
                $arrow.removeClass('glyphicon-chevron-right');
                $arrow.addClass('glyphicon-chevron-down');
            }
        });
        return false;
    });
}