<script>
    document.addEventListener('DOMContentLoaded', function() {
    let hours = @json($hours);
            let orderCounts = @json($hourlyOrderCounts);
            let orderEarnings = 78;

            let yesterday_orderCounts   = 50;
            let yesterday_orderEarnings = 50;

            var options3 = {
                chart: {
                    type: 'area',
                    height:380
                },
                series: [
                    {
                        name: 'Orders',
                        data: orderCounts,
                        color: '#0feaaf'
                    },
                    {
                        name: 'Earnings',
                        data: orderEarnings,
                        color: '#f58b30'
                    },

                    // {
                    //     name: 'Yesterday Orders',
                    //     data: yesterday_orderCounts,
                    //     color: '#650cab'
                    // },
                    // {
                    //     name: 'Yesterday Earnings',
                    //     data: yesterday_orderEarnings,
                    //     color: '#d90e74'
                    // },
                ],
                title:{
                    text : "Today's Total Order Count : {{ 8 }} \n Yesterday Order Count: {{ 10 }} Today's Order Earning : {{ 12 }} , \n Yesterday Order Earning : {{ 14 }}",
                    align: 'center', // Optional: to align the title
                    style: {
                        fontSize: '10px', // Optional: to style the title
                        color: '#263238' // Optional: to set the color
                    }
                },
                xaxis: {
                    categories: hours,
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
                        colors: ["#red"]
                    }
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top' // Position the label at the top
                        }
                    }
                },
            }

            var hourlyChart = new ApexCharts(document.querySelector("#hourlyChart"), options3);
            hourlyChart.render();

        });
</script>
