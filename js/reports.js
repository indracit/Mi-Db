
 const display = (data) => {
   var html
  
     html ="<table border='1|1'><tr><th>bank</th><th>Transaction_Time</th><th>id_customer_info</th><th>id_terminal_info</th><th>cust_cards</th><th>sweep_txn</th><th>sweep_amt</th><th>txn_cnt</th><th>txn_amt</th><th>scot_txn</th><th>ifis_txn</th><th>rupay_txn</th><th>aeps_txn</th><th>fund_transfer_txn</th><th>offline_txn</th><th>total_cr_txn</th><th>total_dr_txn</th><th>total_cr_amt</th><th>total_dr_amt</th><th>scot_amt</th><th>scot_cr_txn</th><th>scot_cr_amt</th><th>scot_dr_txn</th><th>scot_dr_amt</th><th>ifis_amt</th><th>ifis_cr_txn</th><th>ifis_cr_amt</th><th>ifis_dr_txn</th><th>ifis_dr_amt</th><th>rupay_amt</th><th>rupay_cr_txn</th><th>rupay_cr_amt</th><th>rupay_dr_txn</th><th>rupay_dr_amt</th><th>aeps_amt</th><th>aeps_cr_txn</th><th>aeps_cr_amt</th><th>aeps_dr_txn</th><th>aeps_dr_amt</th><th>fund_transfer_amt</th><th>offline_amt</th><th>offline_cr_txn</th><th>offline_cr_amt</th><th>offline_dr_txn</th><th>offline_dr_amt</th><th>aadhaar_login</th><th>exported_on</th><th>unique_txn_cust_count</th><th>accom_txn_count</th><th>accom_txn_amt</th><th>self_txn</th><th>self_txn_amt</th><th>split_txn</th><th>split_txn_amt</th><th>accom_ft_cnt</th><th>accom_ft_amt</th><th>balance_zero</th><th>balance_zero_amt</th><th>imps_count</th><th>imps_amt</th><th>onus_txn_count</th><th>onus_txn_amt</th><th>offus_txn_count</th><th>offus_txn_amt</th><th>aeps_onus_count</th><th>aeps_offus_count</th><th>aeps_onus_amt</th><th>aeps_offus_amt</th><th>rupay_onus_count</th><th>rupay_offus_count</th><th>rupay_onus_amt</th><th>rupay_offus_amt</th><th>tpd_txn_count</th><th>tpd_txn_amt</th><th>bbps_txn</th><th>bbps_amt</th><th>shg_txn</th><th>shg_amt</th><th>shg_cr_txn</th><th>shg_cr_amt</th><th>shg_dr_txn</th><th>shg_dr_amt</th><th>imps_cr_txn</th><th>imps_cr_amt</th><th>total_fin_txn</th><th>total_fin_amt</th><th>total_nonfin_cnt</th><th>aeps_onus_cr_cnt</th><th>aeps_onus_cr_amt</th><th>aeps_onus_dr_cnt</th><th>aeps_onus_dr_amt</th><th>aeps_onus_ft_cnt</th><th>aeps_onus_ft_amt</th><th>aeps_offus_cr_cnt</th><th>aeps_offus_cr_amt</th><th>aeps_offus_dr_cnt</th><th>aeps_offus_dr_amt</th><th>aeps_offus_ft_cnt</th><th>aeps_offus_ft_amt</th><th>rupay_onus_cr_cnt</th><th>rupay_onus_cr_amt</th><th>rupay_onus_dr_cnt</th><th>rupay_onus_dr_amt</th><th>rupay_offus_cr_cnt</th><th>rupay_offus_cr_amt</th><th>rupay_offus_dr_cnt</th><th>rupay_offus_dr_amt</th><th>unique_txn_cust_count</th><th>total_be_txn</th><th>total_mini_stmt_txn</th><th>aeps_onus_non_fin</th><th>aeps_onus_bal_enq</th><th>aeps_onus_mini_stmt</th><th>aeps_offus_non_fin</th><th>aeps_offus_bal_enq</th><th>aeps_offus_mini_stmt</th><th>rupay_onus_non_fin</th><th>rupay_onus_bal_enq</th><th>rupay_onus_mini_stmt</th><th>rupay_offus_non_fin</th><th>rupay_offus_bal_enq</th><th>rupay_offus_mini_stmt</th></tr>"
   for (var i = 0; i < data.length; i++) {
     html += '<tr>'
     for (var j = 0; j < data[i].length; j++) {
       html += '<td>' + data[i][j] + '</td>'
     }
     html += '</tr>'
   }
   html += '</table>'
   return html
 }

  formElem.onsubmit = async (e) => {
    e.preventDefault()
    let data = new FormData(formElem)
    data.append('type', 'ALB_BCTXN')
    document.getElementById('box2').innerHTML = "Loading ... "
    
    let response = await fetch(
      'apis/sync.php',
      {
        method: 'POST',
        body: data,
      }
    )
    document.getElementById('box2').innerHTML = 'Ready to Export'
    let resp = await  response.json()
      
     document.getElementById('box1').innerHTML = display(resp);
     document.getElementById('box1').style.opacity = '0'
     

     }


   

    
    
  

 
 
 

 