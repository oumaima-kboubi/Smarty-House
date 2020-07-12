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
    socket.addEventListener("message", function(e) {
        data = JSON.parse(e.data);
        var element = $('#'+data.id);
        console.log(data);
        if(element.attr('type') == "checkbox"){
            element.prop('checked',data.value);
        }else{
            element.val(data.value);
        }
        if($('#graphAttr'+data.id.substr(17)).attr('data-visible')=='true')
            updateGraph(data.id.substr(17));
        console.log(data.id);
    });
});

$(document).ready(function(){
    $(".device").click(function() {
        console.log("work");
    });
    
    });