/*=========================================================================================
    File Name: column.js
    Description: Chartjs column chart
    ----------------------------------------------------------------------------------------
    Item Name: Chameleon Admin - Modern Bootstrap 4 WebApp & Dashboard HTML Template + UI Kit
    Version: 1.0
    Author: ThemeSelection
    Author URL: https://themeselection.com/
==========================================================================================*/

// Column chart
// ------------------------------
$(window).on("load", function(){

    //Get the context of the Chart canvas element we want to select
    var ctx = $("#column-chart");

    var d = new Date();
    var date = d.getDate();
    var month = d.getMonth() + 1;
    var week = [0,0,0,0,0,0,0];
    var b =0;
    const entryInfoElements =
        document.querySelectorAll('[data-entry-info]');

    // Map over each element and extract the data value
    const entryInfoObjects =
        Array.from(entryInfoElements).map(
            item => JSON.parse(item.dataset.entryInfo)
        );
    if (entryInfoObjects[1][0] != null) {
        const parsed = parseInt(entryInfoObjects[1][0]["value"], 10);
        let y = 0;
        if (isNaN(parsed)) {
            for (var i = 0; i < 7; i++) {
                for (var j = 0; i < entryInfoObjects[1].length; j++) {
                    if (entryInfoObjects[1][j] != null) {
                        if (entryInfoObjects[1][j]["date"]["date"].slice(8, 10) === (d.getDate() - i))
                            week[i]++;
                    } else break;
                }
            }
        } else {
            for (var i = 0; i < 7; i++) {
                for (var j = 0; i < entryInfoObjects[1].length; j++) {
                    if (entryInfoObjects[1][j] != null) {
                        b =parseInt(entryInfoObjects[1][j]["date"]["date"].slice(8, 10),10);
                        if (b === (d.getDate() - i)) {
                            y = parseInt(entryInfoObjects[1][j]["value"], 10);
                            if (week[i] === 0)
                                week[i] = y;
                            else week[i] = (week[i] + y)/2 ;
                        }
                    } else break;
                }
            }
        }
    }

  /*  for (var i=0; i<7; i++) {
        for (var j=0; i<entryInfoObjects[1].length; j++) {
            if (entryInfoObjects[1][j].getDay() == (d.getDate()-i))
                week[i]++;
        }
    }*/


    // Chart Options
    let chartOptions = {
        // Elements options apply to all of the options unless overridden in a dataset
        // In this case, we are setting the border of each bar to be 2px wide and green
        elements: {
            rectangle: {
                borderWidth: 2,
                borderColor: 'rgb(0, 255, 0)',
                borderSkipped: 'bottom'
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        responsiveAnimationDuration:500,
        legend: {
            position: 'top',
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false,
                },
                scaleLabel: {
                    display: true,
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false,
                },
                scaleLabel: {
                    display: true,
                }
            }]
        },
        title: {
            display: true,
            text: 'Chart.js Bar Chart'
        }
    };

    // Chart Data
    var chartData = {
        labels: [date-6 + "/" + month, date-5 + "/" + month, date-4 + "/" + month, date-3 + "/" + month, date-2 + "/" + month, date-1 + "/" + month, date + "/" + month],
        datasets: [{
            label: "Data of usage",
            data: week,
            backgroundColor: "#FF4961",
            hoverBackgroundColor: "rgba(255,73,97,.9)",
            borderColor: "transparent"
        }]
    };

    var config = {
        type: 'bar',

        // Chart Options
        options : chartOptions,

        data : chartData
    };

    // Create the chart
    var lineChart = new Chart(ctx, config);
});