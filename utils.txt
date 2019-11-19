$(".despl a").on("click", function(){
    console.log("hola");
    if(open == null){
        open = false;
    }
    if(!open){
        $(this).parent().children(".desplegable").slideUp();
        open = false;
    }else{
        $(this).parent().children(".desplegable").slideDown();
        open = true;
    }
    open = !open;
});


