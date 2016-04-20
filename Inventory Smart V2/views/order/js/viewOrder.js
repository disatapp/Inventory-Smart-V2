function searchOrder(HTMLid, hosturl){
    $(HTMLid).on('click', function(e){
        e.preventDefault();
        console.log('searchOrder');
        if($("#ordernumber").val() == ''){
            alert("กรุณาใส่หมายเลขคำสั่งซื้อ");
            return;
        }
        $.ajax({
            type: "GET",
            url: hosturl + "get",
            data: {"ordernumber":$("#ordernumber").val()},
            dataType: 'json',
            success: function(html){ 
                console.log(html);                        
                if(html != false){
                    var node = document.getElementById("tbodyid");
                    while (node.firstChild) {
                        node.removeChild(node.firstChild);
                    }

                    for (var k = 0;k < html.length ;k++) {
                        var tag = document.createElement("tr");
                        tag.className = html[k]['id'];
                        tag.innerHTML = "<td>"+(k+1)+"</td>\n<td>"+
                                        html[k]['ordernumber']+"</td>\n<td>"+
                                        html[k]['CompanyName']+"</td>\n<td>"+
                                        html[k]['localid']+"</td>\n<td>"+
                                        html[k]['PartName']+"</td>\n<td>"+
                                        html[k]['quantity']+"</td>\n<td>"+
                                        html[k]['priceperunit']+"</td>\n<td>"+
                                        html[k]['totalamount']+"</td>\n<td>"+
                                        html[k]['receivingdate']+"</td>\n<td>"+
                                        html[k]['storingdate']+"</td>\n<td>";
                                        // +
                                        // "<a class='edit-row btn btn-danger remove'>"+
                                        // "<span class=' glyphicon glyphicon-trash'></span></a></td>\n<td>";
                            document.getElementById("tbodyid").appendChild(tag);
                            $(tag).hide().fadeIn(300);
                            document.getElementById("search-form").reset();
                        }
                } else {
                    alert('ไม่มีคำสั่งซื้อดังกล่าวในระบบ');
                }
            }
        });
    });
}
