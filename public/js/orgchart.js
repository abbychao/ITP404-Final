google.load('visualization', '1', {packages:['orgchart']});
google.setOnLoadCallback(drawChart);
function drawChart() {

  $.ajax({
    url: 'http://localhost:8888/GitHub/ITP404-Final/public/home/family_ajax',
    data: {
      family_id: global_family_id // TO BE UPDATED
    },
    dataType: 'json',
    success: function(response) {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Name');
      data.addColumn('string', 'Big Bro');
      // data.addColumn('string', 'ToolTip');

      var i = 0;
      while(response[i] != null) {
        var content = '<font color=black>'+response[i].bro_fname+' '+response[i].bro_lname;
        content +='<br>'+response[i].pc_sem+' '+response[i].pc_year+'</font>';
        var bigbro_id = response[i].bigbro_id;
        if(bigbro_id == 0) {bigbro_id = null;}
        data.addRows([
          [{v:response[i].bro_id, f:content}, bigbro_id] // can add tooltip
        ]);
        i++;
      }


      var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
      chart.draw(data, {allowHtml:true});
    },
    error: function(err1, err2, err3) {
      console.log(err1, err2, err3);
    }
  });
}