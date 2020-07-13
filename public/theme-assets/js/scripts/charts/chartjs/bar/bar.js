// Bar chart
// ------------------------------
$(window).on("load", function(){

    //Get the context of the Chart canvas element we want to select
    var ctx = $("#bar-chart");
    const entryInfoElements =
        document.querySelectorAll('[data-entry-info]');

    // Map over each element and extract the data value
    const entryInfoObjects =
        Array.from(entryInfoElements).map(
            item => JSON.parse(item.dataset.entryInfo)
        );
    var y = new Date().getFullYear();
    y = y.toString();
    var months = [0,0,0,0,0,0,0,0,0,0,0,0];
    const parsed = parseInt(entryInfoObjects[0][0]["value"], 10);
    var j=0;
    var i=0;
    if (isNaN(parsed)) {
        if (entryInfoObjects[0][j] != null) {
        while (entryInfoObjects[0][j]["date"]["date"].slice(0, 4) === y) {
                months[parseInt(entryInfoObjects[0][j]["date"]["date"].slice(5, 7), 10)-1]++;
                j++;
            if (entryInfoObjects[0][j] == null) break;
            }
        }
    }else {
        if (entryInfoObjects[0][j] != null) {
            console.log(y);
            while (entryInfoObjects[0][j]["date"]["date"].slice(0, 4) === y) {
                console.log(entryInfoObjects[0][j]);
                    i = parseInt(entryInfoObjects[0][j]["date"]["date"].slice(5, 7), 10) - 1;
                    if (months[i] === 0)
                        months[i] = parseInt(entryInfoObjects[0][j]["value"]);
                    else months[i] = (parseInt(entryInfoObjects[0][j]["value"],10) + months[i])/2;
                    j++;
                if (entryInfoObjects[0][j] == null) break;
            }
        }
    }




    // Chart Options
    var chartOptions = {
        // Elements options apply to all of the options unless overridden in a dataset
        // In this case, we are setting the border of each horizontal bar to be 2px wide and green
        elements: {
            rectangle: {
                borderWidth: 2,
                borderColor: 'rgb(0, 255, 0)',
                borderSkipped: 'left'
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
            display: false,
            text: 'Chart.js Horizontal Bar Chart'
        },
        animation: {
            duration: 5000
        }
    };

    // Chart Data
    var chartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [{
            label: "Average of Every Month",
            data: months,
            backgroundColor: "#28D094",
            hoverBackgroundColor: "rgba(40,208,148,.9)",
            borderColor: "transparent"
        }]
    };

    var config = {
        type: 'horizontalBar',

        // Chart Options
        options : chartOptions,

        data : chartData
    };

    // Create the chart
    var lineChart = new Chart(ctx, config);
});