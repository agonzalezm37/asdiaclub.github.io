$(".calendario").on("scroll", function(){
    var left = $(this).scrollLeft();
    
    $(".calendario-left").css("left", left);
    var top = $(this).scrollTop();
    $(".calendario-top").css("top", top);
   
});

var casillaSelect = null;
var casillaFinal = null;
var elementsEventActive;
var reservaActual = null;

$(".celda").on("click", function(){
    var pista = $(this).parent().attr("data-pista");
    
    if(casillaSelect==null){
        initReserva($(this), 4);
    }else if(casillaSelect[0] == $(this)[0]){
        casillaSelect= null;
        reservaActual.remove();   reservaActual = null;
        
        console.log("mismo");
        $(this).removeClass("active");
        vaciarEventActive();
    }
    else if(pista != casillaSelect.parent().attr("data-pista")){
        vaciarEventActive();
        reservaActual.remove();    reservaActual = null;
        
        console.log("otra pista");
        casillaSelect.removeClass("active");
        initReserva($(this), 4);
        
    }else if(casillaFinal != null){
        console.log("hey dere");
        
        nuevaReserva();
        casillaSelect.removeClass("active");
        casillaSelect = null;
        vaciarEventActive();
    }
});

function initReserva(elemento, dist){
    casillaSelect = elemento;
    elemento.addClass("active");
    console.log("ninguno");
    elementsEventActive = new Array();
    reservaActual = elemento.append("<div class='nueva-reserva'> </div>").children(".nueva-reserva");
    var row = elemento.parent();
    if(elemento.attr("data-reserva") != "next")
    for(var i = 1; i < dist+1; i++){
        var element = row.children().eq( elemento.index() + i );
        if(!element.hasClass("disabled") && element.attr("data-reserva") != "prev"){
            elementsEventActive.push(element);
            element.addClass("selectable");
            element.on("mouseenter", function(){
                casillaFinal = $(this);
                var width = ($(this).index() - casillaSelect.index()) * 100;
                reservaActual.css({"left" : "50%", "right" : "unset", "width" : width + "%"});
            });
        }else{
            break; //rompe el bucle para impedir que se puedan montar reservas unas encima de otras
        }
    }
    if(elemento.attr("data-reserva") != "prev")
    for(var i = 1; i < dist+1; i++){
        var element = row.children().eq(elemento.index() - i);
        if(!element.hasClass("disabled") && elemento.index() - i >= 0 && element.attr("data-reserva") != "next"){
            elementsEventActive.push(element);
            element.addClass("selectable");
            element.on("mouseenter", function(){
                casillaFinal = $(this);
                var width = (casillaSelect.index() - $(this).index()) * 100;
                reservaActual.css({"right" : "50%", "left" : "unset", "width": width + "%"});
            });
        }else{
            break;    //rompe el bucle para impedir que se puedan montar reservas unas encima de otras
        }
    }
}
function vaciarEventActive(){
    elementsEventActive.forEach(function(element){
        element.off("mouseenter");
        element.removeClass("selectable");
    });
}
function crearReserva(fecha, horaInicio, horaFinal, pista, apellidos){
    console.log(fecha + "  " + horaInicio + "  " + horaFinal + "  " + pista + "  " + apellidos);
    var fechaoffset = 0;

    $(".row-dias").children().each(function(){
        if($(this).attr("data-reserva") == fecha){
            fechaoffset = parseInt( $(this).index()/2);
        }
    });

    var numero = fechaoffset*31 + (parseInt(horaInicio.split(":")[0]) - 8)*2 + (horaInicio.split(":")[1] == "30" ? 1 : 0) -1;
    var horas = fechaoffset*31 + (parseInt(horaFinal.split(":")[0]) - 8)*2 + (horaFinal.split(":")[1] == "30" ? 1 : 0) -1 - numero;
    var elementoInicial = $(".pista"+pista).children().eq(numero);
    if(elementoInicial.attr("data-reserva") == "prev"){
        elementoInicial.addClass("disabled");
    }else{
        elementoInicial.attr("data-reserva", "next");
    }
    elementoInicial.append("<div class='reserva'><p>"+ apellidos +"</p></div>").children(".reserva").css({"width": 100*horas + "%"});
    for (var i = 1; i < horas; i++ ){
        $(".pista"+pista).children().eq(numero + i).addClass("disabled");
    }
    if($(".pista"+pista).children().eq(numero + horas+1).hasClass("disabled"))
            $(".pista"+pista).children().eq(numero + horas).addClass("disabled");
    $(".pista"+pista).children().eq(numero+horas).attr("data-reserva", "prev");
}

var checkReservas = $.getJSON("calendario.php", {
    "fecha_inicial": $(".row-dias .celda:nth-child(2)").attr("data-reserva"),
    "fecha_final"  : $(".row-dias .celda:last-child").attr("data-reserva")
})
    .done(function( response ) {
        console.log(response.data.message);
        
        $.each(response.data.reservas, function(key, value){
            crearReserva(value.fecha, value.hora_inicio, value.hora_fin, value.pista, value.nombre);
        });
    });

function nuevaReserva(){
    $.ajax({
        type: "GET",
        url: "calendario.php",
        typedata: "html",
        data: {new_reserva : 1}
    })
    .done(function(result){
        $("#id p").text("#" + result);
    });


    var horae = casillaSelect.index() - parseInt(casillaSelect.index()/31) * 31;
    var hora = ("0" + Math.round( horae/2 + 8)).slice(-2) + (casillaSelect.index()%2 ? ":00" : ":30");
    fecha = $(".row-dias .celda").eq(parseInt(casillaFinal.index()/31)*2 + 1 ).attr("data-reserva");
    $("#fecha").attr("value", fecha);
    $("#hora-inicio").attr("value", hora);

    horae = casillaFinal.index() - parseInt(casillaFinal.index()/31) * 31;
    hora = ("0" + Math.round( horae/2 + 8)).slice(-2) + (casillaFinal.index()%2 ? ":00":":30");
    $("#hora-fin").attr("value", hora);
}

function searchUser(apellido){
    $.ajax({
        type: "GET",
        url: "calendario.php",
        typedata: "html",
        data: {apellido : apellido}
    })
    .done(function(result){
        $(".select-users").html(result);
    });
}
$("#apellidos").on("keyup", function(){
    console.log($(this).val());
    
    searchUser($(this).val());
});
// $("#nombre").on("click", function(){
//     nuevaReserva(0,0);
// });
//     console.log("uy");
//     $.ajax({
//         type: "GET",
//         url: "calendario.php",
//         typedata: "html",
//         data: { new_reserva : 1}
//     })
//     .done(function(result){
//         console.log(result);
//     })
// });
