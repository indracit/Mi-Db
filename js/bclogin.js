
const display = (data,{report_date,daily_count,monthly_count,active_count}) => {
 var html = "<table border='1|1'><tr><th>"+report_date+"</th><th>"+daily_count+"</th><th>"+monthly_count+"</th><th>"+active_count+"</th></tr>"
  
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
const datafetch = async (url) => {
  let resp = await fetch(url).then((resp) => resp.json())
console.log(resp)
 return resp;
}



const header={
report_date:"report_date",
daily_count:"daily_count",
monthly_count:"monthly_count",
active_count:"active_count"
}

datafetch('apis/bclogin.php').then(data => 
{
document.getElementById('box1').innerHTML = display(data,header)
});

