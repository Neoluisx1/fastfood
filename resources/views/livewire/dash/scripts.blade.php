<script>
    document.addEventListener('livewire:load',function(){
//grafica top 5
        var optionsTop5 = {
          series: [
            parseFloat(@this.top5Data[0]['total']),
            parseFloat(@this.top5Data[1]['total']),
            parseFloat(@this.top5Data[2]['total']),
            parseFloat(@this.top5Data[3]['total']),
            parseFloat(@this.top5Data[4]['total'])
          ],
          chart: {
            height: 392,
          type: 'donut',
        },
        labels:
        [
            @this.top5Data[0]['product'],
            @this.top5Data[1]['product'],
            @this.top5Data[2]['product']
            @this.top5Data[3]['product'],
            @this.top5Data[4]['product']
          ],

        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chartTop5 = new ApexCharts(document.querySelector("#chartTop5"), options);
        chartTop5.render();

//gaficos semanales

        var options = {
          series: [{
          name: 'Ventas del Dia',
          data: [
            parseFloat(@this.weekSales_Data[0]),
            parseFloat(@this.weekSales_Data[1]),
            parseFloat(@this.weekSales_Data[2]),
            parseFloat(@this.weekSales_Data[3]),
            parseFloat(@this.weekSales_Data[4]),
            parseFloat(@this.weekSales_Data[5]),
            parseFloat(@this.weekSales_Data[6])
          ]
        }],
          chart: {
          height: 380,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          categories: ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"]
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        };

        var chart = new ApexCharts(document.querySelector("#chartArea"), options);
        chart.render();
    })
</script>
