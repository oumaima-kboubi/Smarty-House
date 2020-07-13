/*=========================================================================================
    File Name: pie.js
    Description: Chartjs pie chart
    ----------------------------------------------------------------------------------------
    Item Name: Chameleon Admin - Modern Bootstrap 4 WebApp & Dashboard HTML Template + UI Kit
    Version: 1.0
    Author: ThemeSelection
    Author URL: https://themeselection.com/
    '#'+Math.floor(Math.random()*16777215).toString(16);
==========================================================================================*/

// Pie chart
// ------------------------------
$(window).on("load", function(){

    //Get the context of the Chart canvas element we want to select
    var ctx = $("#simple-pie-chart");
    const entryInfoElements =
        document.querySelectorAll('[data-entry-info]');

    // Map over each element and extract the data value
    const entryInfoObjects =
        Array.from(entryInfoElements).map(
            item => JSON.parse(item.dataset.entryInfo)
        );
    var names =new Array(entryInfoObjects[3].length);
    var values = new Array(entryInfoObjects[3].length);
    var colors = new Array(entryInfoObjects[3].length);
    for(var i=0; i<entryInfoObjects[3].length; i++) {
        names[i]=entryInfoObjects[3][i]["name"];
        values[i]=entryInfoObjects[3][i]["value"];
        colors[i]='#'+Math.floor(Math.random()*16777215).toString(16);
    }

    // Chart Options
    var chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        responsiveAnimationDuration:500,
    };

    // Chart Data
    var chartData = {
        labels: names,
        datasets: [{
            label: "My use of gadgets for a week",
            data: values,
            backgroundColor: colors,
        }]
    };

    var config = {
        type: 'pie',

        // Chart Options
        options : chartOptions,

        data : chartData
    };

    // Create the chart
    var pieSimpleChart = new Chart(ctx, config);
});