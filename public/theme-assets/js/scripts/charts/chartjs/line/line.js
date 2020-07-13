/*=========================================================================================
    File Name: line.js
    Description: Chartjs simple line chart
    ----------------------------------------------------------------------------------------
    Item Name: Chameleon Admin - Modern Bootstrap 4 WebApp & Dashboard HTML Template + UI Kit
    Version: 1.0
    Author: ThemeSelection
    Author URL: https://themeselection.com/
==========================================================================================*/

// Line chart
// ------------------------------
$(window).on("load", function(){

    //Get the context of the Chart canvas element we want to select
    let ctx = $("#line-chart");

    const entryInfoElements =
        document.querySelectorAll('[data-entry-info]');

    // Map over each element and extract the data value
    const entryInfoObjects =
        Array.from(entryInfoElements).map(
            item => JSON.parse(item.dataset.entryInfo)
        );
    let years = new Array();
    years[0] = entryInfoObjects[2][0]["date"]["date"].slice(0,4);
    var j=0;
    let mint="";
    for (var i =1; i< entryInfoObjects[2].length; i++) {
        mint=entryInfoObjects[2][i]["date"]["date"].slice(0,4);
        console.log(mint);
        if(mint !== years[j]) {
            j++;
            years[j]=mint;
        }
    }
    var months = new Array(years.length);
    for( i =0; i<years.length; i++) {
        months[i] = [0,0,0,0,0,0,0,0,0,0,0,0];
    }
    let nbre=0;
    j=0;
    for ( i=0; i<years.length; i++) {
         console.log(entryInfoObjects[2]);
        while(entryInfoObjects[2][j]["date"]["date"].slice(0,4) === years[i]) {
            nbre = parseInt(entryInfoObjects[2][j]["date"]["date"].slice(5,7), 10);
            console.log(entryInfoObjects[2][j]["date"]["date"].slice(5,7));
            months[i][nbre-1]++;
            j++;
            if(j>=entryInfoObjects[2].length) break;
        }
    }
    console.log(months);
    console.log(years);

    datab = new Array();
    let str="";
    for(let i=0;i<years.length;i++){
        str="#"+Math.floor(Math.random()*16777215).toString(16);
        datab.push({
            label: years[i],
            data: months[i],
            fill: false,
            borderDash: [5, 5],
            borderColor: str,
            pointBorderColor: str,
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        });
    }

    // Chart Options
    var chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'bottom',
        },
        hover: {
            mode: 'label'
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
                    labelString: 'Month'
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
                    labelString: 'Value'
                }
            }]
        },
        title: {
            display: true,
            text: 'Chart.js Line Chart - Legend'
        }
    };

    // Chart Data
 /*   var chartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [{
            label: "My First dataset",
            data: [65, 59, 80, 81, 56, 55, 40, 1, 2, 3, 4, 5],
            fill: false,
            borderDash: [5, 5],
            borderColor: "#9C27B0",
            pointBorderColor: "#9C27B0",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }, {
            label: "My Second dataset",
            data: [28, 48, 40, 19, 86, 27, 90, 1, 2, 3, 4, 5],
            fill: false,
            borderDash: [5, 5],
            borderColor: "#00A5A8",
            pointBorderColor: "#00A5A8",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }, {
            label: "My Third dataset - No bezier",
            data: [45, 25, 16, 36, 67, 18, 76, 1, 2, 3, 4, 5],
            lineTension: 0,
            fill: false,
            borderColor: "#FF7D4D",
            pointBorderColor: "#FF7D4D",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }]
    };
*/
    let chartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: datab
    };

    var config = {
        type: 'line',

        // Chart Options
        options : chartOptions,

        data : chartData
    };

    // Create the chart
    let lineChart = new Chart(ctx, config);
});