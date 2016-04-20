/**
 * Submit the ordered items once the item has been sent clear and remove stack
 * @param {Object} HTMLid
 * @param {Object} stack 
 * @return {text} inside the table 
 */
function getPendingParts(hosturl){
    var string ='';
    $.ajax({
        type: "GET",
        url: hosturl + "get",
        dataType: 'json',
        success: function(html){    
            // console.log(html);       
            if(html != false){
                $("#error-load").fadeOut();
                
                for (var k = 0;k < html.length ;k++) {
                    if(k == 0){
                        var tag = document.createElement("div");
                        tag.className = 'row';
                        string = "<div class='col-lg-12 content-box highlight-hover'><div class='expand'><span class='arrow-expand glyphicon glyphicon-chevron-right'></span>"+
                                 html[k]['ordernumber']+"  |  "+html[k]['CompanyName']+"  "+
                                 "<a class='submit-row btn btn-success btn-sm pull-right'><span class='glyphicon glyphicon-ok'></span></a></div>"+
                                 "<table class='pending-table table table-hover' style='display: none'><thead><tr>"+ 
                                 "<th>รหัสสินค้า</th><th>ชื่อ</th><th>จำนวน</th></tr>"+
                                 "</thead><tbody>";
                    } else if(html[k]['ordernumber'] != html[k-1]['ordernumber']){
                        var tag = document.createElement("div");
                        tag.className = 'row';
                        string = "<div class='col-lg-12 content-box highlight-hover'><div class='expand'><span class='arrow-expand glyphicon glyphicon-chevron-right'></span>"+
                                 html[k]['ordernumber']+"  |  "+html[k]['CompanyName']+"  "+
                                 "<a class='submit-row btn btn-success btn-sm pull-right'><span class='glyphicon glyphicon-ok'></span></a></div>"+
                                 "<table class='pending-table table table-hover' style='display: none'><thead><tr>"+ 
                                 "<th>รหัสสินค้า</th><th>ชื่อ</th><th>จำนวน</th></tr>"+
                                 "</thead><tbody>";

                    }
                    string += "<tr id='"+html[k]['id']+"'><td>"+html[k]['localid']+"</td><td>"+html[k]['PartName']+"</td><td><input value='"+html[k]['quantity']+"'/></td></tr>";
                    if(k == (html.length-1)) {
                        string += "</tbody></table></div><br>";
                        tag.innerHTML = string;
                        string = '';
                        document.getElementById("pending-display").appendChild(tag);
                    } else if(html[k]['ordernumber'] != html[k+1]['ordernumber']){
                        string += "</tbody></table></div><br>";
                        tag.innerHTML = string;
                        string = '';
                        document.getElementById("pending-display").appendChild(tag);
                    }

                }
            }else{
                 $("#error-load").fadeIn();
            }   
        }
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
        e.preventDefault();
        if($('#receivingdate').val() == ''){
            alert("กรุณาใส่วันที่ได้รับสินค้า");
            return;
        }
        var $t = $(this).closest('.col-lg-12');
        var table = [];
        var name =['localid','PartName','quantity'];
        var $row = $(this).closest('.col-lg-12').find('tbody tr');
        $row.has('td').each(function(index) {
			var array = {};
			$('td', $(this)).each(function(index, item) {
			    array[name[index]] = (index != 2) ? $(item).html(): $(item).children('input').val();
			});
            array['id'] = $(this).attr('id');
        	table.push(array);
		});
        
        var data = JSON.stringify(table);
        $.ajax({
	        type: "POST",
	        url: hosturl + "update",
	        data: { 'data': data,
	        		'receivingdate': $('#receivingdate').val() },
	        dataType: 'text',
	        success: function(html){                            
	                console.log(html);
	                if(html != false){
                        $t.parent().fadeOut(500, function() { 
                            $(this).remove(); 
                        });
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