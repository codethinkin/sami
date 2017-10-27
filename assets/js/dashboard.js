var currentLocation = window.location;
var bgColor = [];
var bgBorder = [];
var paramTotales = [];
var paramFechas = [];
$(document).ready(function(){
   compras();
push();
   ventas();
});

function compras()
{
  $.post(currentLocation + "/dashboard/getCompras",


    function(data){
      var obj = JSON.parse(data);

      paramTotales = [];
      paramFechas = [];
      bgColor = [];
      bgBorder = [];
      $.each(obj, function(i,item){
        var r = Math.random() * 255;
        r = Math.round(r);

        var g = Math.random() * 255;
        g = Math.round(g);

        var b = Math.random() * 255;
        b = Math.round(b);

        paramTotales.push(item.Mes);
        paramFechas.push(item.Total);
        bgColor.push('rgba('+r+','+g+','+b+', 0.3)');
        bgBorder.push('rgba('+r+','+g+','+b+', 1)');
      });

      //Eliminamos y creamos la etiqueta canvas
      $('#myChart').remove();
      $('#contenedor_grafico').append("<canvas id='myChart' width='400' height='150'></canvas>");

      var ctx = $("#myChart");
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: paramTotales,
              datasets: [{
                  label: 'Valor',
                  data: paramFechas,
                  backgroundColor: bgColor,
                  borderColor: bgBorder,
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });

    });
}



  function ventas()
  {
    $.post(currentLocation + "/dashboard/getVentas",


      function(data){
        var obj = JSON.parse(data);

        paramTotales = [];
        paramFechas = [];
        bgColor = [];
        bgBorder = [];
        $.each(obj, function(i,item){
          var r = Math.random() * 255;
          r = Math.round(r);

          var g = Math.random() * 255;
          g = Math.round(g);

          var b = Math.random() * 255;
          b = Math.round(b);

          paramTotales.push(item.Mes);
          paramFechas.push(item.Total);
          bgColor.push('rgba('+r+','+g+','+b+', 0.3)');
          bgBorder.push('rgba('+r+','+g+','+b+', 1)');
        });

        //Eliminamos y creamos la etiqueta canvas
        $('#ventas').remove();
        $('#contenedor_grafico_ventas').append("<canvas id='ventas' width='400' height='150'></canvas>");

        var ctx = $("#ventas");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: paramTotales,
                datasets: [{
                    label: 'Ventas',
                    data: paramFechas,
                    backgroundColor: bgColor,
                    borderColor: bgBorder,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

      });
  }

function push(){
  Push.create('Hi there!', {
      body: 'This is a notification.',
      icon: 'icon.png',
      timeout: 8000,               // Timeout before notification closes automatically.
      vibrate: [100, 100, 100],    // An array of vibration pulses for mobile devices.
      onClick: function() {
          // Callback for when the notification is clicked.
          console.log(this);
      }
  });
}
