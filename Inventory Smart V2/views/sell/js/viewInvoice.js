function searchInvoice(HTMLid, hosturl){
    $(HTMLid).on('click', function(e){
        e.preventDefault();       
        console.log('searchInvoice');
        if($("#invoicenumber").val() == ''){
            alert("กรุณาใส่หมายเลขใบเสร็จ");
            return;
        }
        $.ajax({
            type: "GET",
            url:  hosturl + "get",
            data: {"invoicenumber":$("#invoicenumber").val()},
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
                        tag.className = html[k]['invoicenumber'];
                        tag.innerHTML = "<td>"+(k+1)+"</td>\n<td>"+
                                        html[k]['invoicenumber']+"</td>\n<td>"+
                                        html[k]['TransactionDate']+"</td>\n<td>"+
                                        html[k]['Name']+"</td>\n<td>"+//
                                        html[k]['paymentType']+"</td>\n<td>"+
                                        html[k]['paymentDuration']+"</td>\n<td>"+
                                        html[k]['wage']+"</td>\n<td>"+
                                        html[k]['discount']+"</td>\n<td>";
                    
                            document.getElementById("tbodyid").appendChild(tag);
                            $(tag).hide().fadeIn(300);
                            document.getElementById("search-form").reset();
                        }
                } else {
                    alert('ไม่มีใบเสร็จดังกล่าวในระบบ');
                }
            }
        });
    });
}