const socket = new WebSocket("ws://localhost:3001");

socket.addEventListener("open", function() {
    console.log("CONNECTED");
    $('[id^=attributeActuat]').change(function(){
        
        var message;
        if($(this).attr('type') == "checkbox"){
            message = {
                id: $(this).attr('id'),
                value: $(this).prop("checked"),
                date: Math.floor((new Date()).getTime()/1000)
            };
        }else{
            message = {
                id: $(this).attr('id'),
                value: $(this).val(),
                date: Math.floor((new Date()).getTime()/1000)
            };
        }
        console.log(message);
        socket.send(JSON.stringify(message));
    });
    $('[id^=graphAttr]').each(function() {
        $(this).hide();
    });
    $('[id^=buttonAttr]').click(function(){
        let id = $(this).attr('id').substr(10);
        if($('#graphAttr'+id).attr('data-visible')=='false'){
            updateGraph(id);
        }
        else{
            $('#graphAttr'+id).slideUp(750);
            $('#graphAttr'+id).attr('data-visible','false');
        }
    });
    socket.addEventListener("message", function(e) {
        data = JSON.parse(e.data);
        let idSensor = "attributeSensor"+data.id.substr(15);
        let idActuat = "attributeActuat"+data.id.substr(15);
        var element;
        
        element = $('#'+idActuat);
        if(!element.length)
            element = $('#'+idSensor);
        console.log(element);
        console.log(idActuat + " " + idSensor)
        if(element.attr('type') == "checkbox"){
            element.prop('checked',data.value);
        }else{
            element.val(data.value);
        }
        if($('#graphAttr'+data.id.substr(15)).attr('data-visible')=='true')
            updateGraph(data.id.substr(15));
    });
});

function updateGraph(id) {
    var currentGraphID = 'graphAttr'+id;
    $('[id^=graphAttr]').each(function() {
        if($(this).attr('data-visible')=='true' && $(this).attr('id')!=currentGraphID){
            $(this).attr('data-visible','false');
            $(this).slideUp(750);
        }
    });
    $.ajax({  
        url:        '/async/graph',  
        type:       'POST',  
        data: {attributeID :  id}, 
        dataType:   'json',  
        async:      true,  

        success: function(data, status) {  
            let graphID ='graphAttr'+data.id;
            console.log($('#'+graphID).attr('data-visible'));
            $('#'+graphID).slideDown(500);
            $('#'+graphID).attr('data-visible','true');
            console.log($('#'+graphID).attr('data-visible'));
            console.log('ajax '+id);
            console.log(data);
            console.log($('#'+graphID).attr('data-curveType'));
            if($('#'+graphID).attr('data-curveType')=="toggle")
                drawToggle(data,graphID);
            else
                drawLine(data,graphID);
        },  
        error : function(xhr, textStatus, errorThrown) {  
            alert('Ajax request failed.');  
        }
    });  
}
function drawLine(data,graphID){
    let series = [];
    data.values.forEach(function (row) {
        series.push({x:row.x, y:parseInt(row.y)});
    });
    console.log(series);
    JSC.Chart(graphID, {
        legend_visible: false,
        type: 'line spline',
        backgroundColor:'black',
        series: [{name: 'entry', points: series}]
    });
}
function drawToggle(data,graphID){
    let series = [];
    data.values.forEach(function (row) {
        series.push({x:row.x, y:1-parseInt(row.y)});
    });
    series.unshift({x:'currently', y:parseInt(data.values[0].y)});
    console.log(series);
    JSC.Chart(graphID, {
        legend_visible: false,
        type: 'step',
        series: [{name: 'entry', points: series}]
    });
}

$(document).ready(function(){
    $(".device").click(function() {
        console.log("cmon");
    });
});