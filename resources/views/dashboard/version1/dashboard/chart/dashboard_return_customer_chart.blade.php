<script type="text/javascript">
    var options2 = {
        chart: {
            type: 'bar',
            height: 280,
        },
        series: [{
            name: 'Total Order',
            data: @json($returnCustomer->pluck('total'))
        }],

        colors :['#335af5', '#f58b30', '#30d9f7', '#30f78a', '#f78b30'],

        xaxis: {
            categories: @json(range(1,5)),
            title: {
                text: 'Top 5 Customer',
            }
        },
        yaxis: {
            title: {
                text: 'Number of Orders'
            }
        },
        dataLabels: {
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#fff"]
            }
        },

    };

    var chart2 = new ApexCharts(document.querySelector("#returnCustomer"), options2);
    chart2.render();

</script>
