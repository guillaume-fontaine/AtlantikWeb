function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav item-rounded-background") {
    x.className += "-responsive responsive";
  } else {
    x.className = "topnav item-rounded-background";
  }
} 

$(document).ready(function() {
    $('table.table-responsive > tbody > tr.link-table').click(function() {

        var href = $(this).find("td a").attr("href");      
        if(href) {
            window.location = href;
        }
    });

});

$(document).ready(function(){
  $("#myBtn").click(function(){
    //disable the submit button
    $(this).attr('disabled','true');$(this).css('cursor','progress');$(this).html('En cours de traitement');
    $.ajax({
      url: 'http://localhost/codeigniter/index.php/Visiteur/horaireTraverseeData/'+document.getElementById('liaison').value+'/'+document.getElementById('date').value,
      success: function(data,status)
      {
        createTableByJqueryEach(data);
        //enable the submit button
        $('#myBtn').css('cursor','pointer');$('#myBtn').html('Rechercher');$('#myBtn').removeAttr('disabled');
      },
      async:   true,
      dataType: 'json'
    }); 
  });
});
 
function createTableByJqueryEach(data)
{
 
 
  var eTable='<table class="table-responsive"><thead><tr><th>N°</th><th>Heure</th><th>Bateau</th><th>A</br>Passager</th><th>B</br>Véh.inf.2m</th><th>C</br>Véh.sup.2m</th></tr></thead><tbody>'
  $.each(data,function(index, row){
    $.each(row,function(key,value){
      if(key == 0) eTable += '<tr class="link-table" onclick="document.location = \'http://localhost/codeigniter/index.php/Client/ReserveeUneTraversee/'+value+'\';"><td> <a class="text">'+value+" </a> </td>";
      else eTable += "<td>"+value+"</td>";
    });
    eTable += "</tr>";
  });
  eTable +="</tbody></table>";
  $('#eachTable').html(eTable);
}