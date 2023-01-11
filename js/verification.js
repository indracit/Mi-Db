
const display = (data) => {
 var html;
 console.log(data[0].length);
 if(data[0].length===4){
 html = "<table border='1|1'><tr><th>Tablename</th><th>Date</th><th>Count</th><th>Amount</th></tr>"
 }
 else if (data[0].length > 4) {
  html =
    "<table border='1|1'><tr><th>Serialno</th><th>RRN</th><th>GatewayRRN</th><th>VendorID</th><th>RespToClient</th><th>Amount</th><th>ServiceName</th><th>ONUS</th><th>ServerTime</th></tr>"
 } else {
   html =
     "<table border='1|1'><tr><th>Tablename</th><th>Date</th><th>Count</th></tr>"
 } 
  for (var i = 0; i < data.length; i++) {
    html += '<tr>'
    for (var j = 0; j < data[i].length; j++) {
      html += '<td>' + data[i][j] + '</td>'
    }
    html += '</tr>'
  }
  html += '</table>'
  return html;
  
}
const datafetch = async (url,id) => {
  let resp = await fetch(url).then((resp) => resp.json())
  document.getElementById(id).innerHTML = display(resp);
}

datafetch('apis/mis.php','box1');
datafetch('apis/txn_ver.php', 'box2');
datafetch('apis/bcwise.php', 'box3');
datafetch('apis/enrol.php', 'box4');