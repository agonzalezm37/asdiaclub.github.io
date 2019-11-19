


//funciones generales



//galería!!
$(".mostrar-btn").on("click", function(){
    var $nuevoValor = $(this).hasClass("active")? "N" : "S";
    var $id = $(this).parent().parent().attr("data-row");
    var $this = $(this);
    $.ajax({
        type: "POST",
        url: "php/funcionesAjax.php",
        typedata: "html",
        data: {
            id: $id,
            tabla: "galeria",
            columna: "mostrar",
            valor: $nuevoValor,
            "mostrar-btn" : 1
        }
    })
    .done(function(result){
        console.log(result);
        $this.toggleClass("active");
    });
});
 //texto editable
 
 //Inicializar texto editable
$(document).ready(function(){
    
    $(".editable-text").each(function(){
        var html = "<textarea style='display:none; width:100%; height:100%'>"+ $(this).children("p").text() +"</textarea>" + 
        "<div class='pantalla'></div>";

        $(this).append(html);
        $(this).children(".pantalla").on("click", function(){
            $(this).parent().children("textarea").css({
                display: "block"
            });

            $(this).parent().children("textarea").focus();
            $(this).parent().children("p").css({
                display: "none"
            });
            $(this).css({display: "none"});

            $(this).parent().children("textarea").on("focusout", function(){
                console.log("dfskjfkj");
                if(!confirm("¿desea actualizar los datos?")){
                    $(this).off("focusout");
                    $(this).parent().children("p").css({display:"block"});
                    $(this).css({display:"none"});
                    $(this).val($(this).parent().children("p").text());
                    $(this).parent().children(".pantalla").css({display:"block"});
                }else{
                    var $this = $(this);
                    var $columna = $(this).parent().attr("data-column");
                    var $value = $(this).val();
                    var $id = $(this).parent().parent().attr("data-row");
                    var $tabla =  $(this).parent().parent().attr("data-tabla");
                    $.ajax({
                        type: "POST",
                        url: "php/funcionesAjax.php",
                        typedata: "html",
                        data: {
                            id: $id,
                            tabla: $tabla,
                            columna: $columna,
                            valor: $value,
                            "mostrar-btn" : 1
                        }
                    })
                    .done(function(result){
                        console.log(result);
                        $this.css({display: "none"});
                        $this.parent().children("p").css({display:"block"});
                        $this.parent().children(".pantalla").css({display:"block"});
                        $this.parent().children("p").text($this.val());
                        $this.off("focusout");
                    })
                    .fail(function(result){
                        console.log(alert(result));
                    });
                }
            });
            
        
        });
    });
    $(".editable-img").each(function(){
        var html = "<form action='php/funcionesAjax.php' style='display: none' method='post' enctype='multipart/form-data'> <label class='btn-self' for='img-input"+ $(this).parent().index() +"'>Seleccionar img</label> <input class='d-none input' id='img-input"+ $(this).parent().index() +"' type='file' name='img'>" +
        "<input class='btn-self' name='subir-img' type='submit' value='subir'>" +
        "<input name='tabla' type='hidden' value='"+ $(this).parent().attr("data-tabla") +"'>" +
        "<input name='id' type='hidden' value='"+ $(this).parent().attr("data-row") +"'>" +
        "</form>" + 
        "<div class='pantalla'></div>";

        $(this).append(html);

        $(this).children(".pantalla").on("click", function(){
            $(this).parent().children("form").css({
                display: "flex"
            });
            $(this).css({display: "none"});
            console.log($(this).parent().find(".input"));
            
            $(this).parent().find(".input").change(function() {
                console.log("hola, que tal");
                
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    var $this = $(this);
                    
                    reader.onload = function(e) {
                        $this.parent().parent().children("img").attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    });
});

function initGalleryEvents(element){
    element.find(".editable-text").each(function(){
        var html = "<textarea style='display:none; width:100%; height:100%'>"+ $(this).children("p").text() +"</textarea>" + 
        "<div class='pantalla'></div>";
        $(this).append(html);
        $(this).children(".pantalla").on("click", function(){
            $(this).parent().children("textarea").css({
                display: "block"
            });
            $(this).parent().children("textarea").focus();
            $(this).parent().children("p").css({
                display: "none"
            });
            $(this).css({display: "none"});
            $(this).parent().children("textarea").on("focusout", function(){
                console.log("dfskjfkj");
                if(!confirm("¿desea actualizar los datos?")){
                    $(this).off("focusout");
                    $(this).parent().children("p").css({display:"block"});
                    $(this).css({display:"none"});
                    $(this).val($(this).parent().children("p").text());
                    $(this).parent().children(".pantalla").css({display:"block"});
                }else{
                    var $this = $(this);
                    var $columna = $(this).parent().attr("data-column");
                    var $value = $(this).val();
                    var $id = $(this).parent().parent().attr("data-row");
                    var $tabla =  $(this).parent().parent().attr("data-tabla");
                    console.log($columna + $value + $id + $tabla);
                    
                    $.ajax({
                        type: "POST",
                        url: "php/funcionesAjax.php",
                        typedata: "html",
                        data: {
                            id: $id,
                            tabla: $tabla,
                            columna: $columna,
                            valor: $value,
                            "mostrar-btn" : 1
                        }
                    })
                    .done(function(result){
                        console.log(result);
                        $this.css({display: "none"});
                        $this.parent().children("p").css({display:"block"});
                        $this.parent().children(".pantalla").css({display:"block"});
                        $this.parent().children("p").text($this.val());
                        $this.off("focusout");
                    })
                    .fail(function(result){
                        console.log(alert(result));
                    });
                }
            });
        });
    });
    element.find(".editable-img").each(function(){
        var html = "<form action='php/funcionesAjax.php' style='display: none' method='post' enctype='multipart/form-data'> <label class='btn-self' for='img-input"+ $(this).parent().index() +"'>Seleccionar img</label> <input class='d-none input' id='img-input"+ $(this).parent().index() +"' type='file' name='img'>" +
        "<input class='btn-self' name='subir-img' type='submit' value='subir'>" +
        "<input name='tabla' type='hidden' value='"+ $(this).parent().attr("data-tabla") +"'>" +
        "<input name='id' type='hidden' value='"+ $(this).parent().attr("data-row") +"'>" +
        "</form>" + 
        "<div class='pantalla'></div>";

        $(this).append(html);
        $(this).children(".pantalla").on("click", function(){
            $(this).parent().children("form").css({
                display: "flex"
            });
            $(this).css({display: "none"});
            console.log($(this).parent().find(".input"));
            
            $(this).parent().find(".input").change(function() {
                console.log("hola, que tal");
                
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    var $this = $(this);
                    
                    reader.onload = function(e) {
                        $this.parent().parent().children("img").attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    });
}
$(".nueva-imagen-btn").on("click", function(){
    var id = parseInt($(".tabla .galeria-row:last-of-type").attr("data-row")) + 1;
    var pos = parseInt($(".tabla .galeria-row:last-of-type td:first-of-type").text())+1;
    console.log(pos);

    if($(".nueva-row").length == 0){
        var html = "<tr class='galeria-row' data-row='"+ id + "' data-tabla='galeria'>" +
        "<td class='w25'>"+ pos +"</td>" +
        "<td class='img w70 img editable-img'> <img src='assets'></td>" +
        "<td class='w50 editable-text' data-column='titulo'> <p></p></td>" +
        "<td class='w95 editable-text' data-column='descripcion' ><p class=' mb0'></p></td> " +
        "<td class='w50'> <a class='mostrar-btn ' href='javascript://'></a> </td>" +
        "</tr>";
        console.log(html);
        $(".tabla tbody").append(html);
        initGalleryEvents($(".tabla tbody tr:last-child"));
        

        $.ajax({
            type: "POST",
            url: "php/funcionesAjax.php",
            typedata: "html",
            data: {
                "galeria-nueva-linea" : 1
            }
        })
        .done(function(){
            console.log("conexxion");
        });
    }
});
