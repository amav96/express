let cerrar = document.querySelectorAll(".close-per")[0];
let abrir = document.querySelectorAll(".openModalWorking")[0];
let modal = document.querySelectorAll(".modal-per")[0];
let modalContainer = document.querySelectorAll(".modal-container-per")[0];

abrir.addEventListener("click" , function(e){
    e.preventDefault();
    modalContainer.style.opacity = "1";
    modalContainer.style.visibility = "visible";
    modal.classList.toggle("modal-close-per");
});

cerrar.addEventListener("click", function(){
    modal.classList.toggle("modal-close-per");
   
    setTimeout(function(){
        modalContainer.style.opacity = "0";
        modalContainer.style.visibility = "hidden";
    },600)
})
 window.addEventListener("click", function(e){
    //  console.log(e.target)
     if(e.target == modalContainer){

        modal.classList.toggle("modal-close-per");
   
    setTimeout(function(){
        modalContainer.style.opacity = "0";
        modalContainer.style.visibility = "hidden";
    },850)

     }
     


})



// modal uno logistica inversa


let cerrarpoint = document.querySelectorAll(".close-point-uno")[0];
let abrirpoint = document.querySelectorAll("#openModalPointUno")[0];
let modalpoint = document.querySelectorAll(".modal-point-uno")[0];
let modalContainerpoint = document.querySelectorAll(".modal-container-point-uno")[0];

abrirpoint.addEventListener("click" , function(e){
    e.preventDefault();
    modalContainerpoint.style.opacity = "1";
    modalContainerpoint.style.visibility = "visible";
    modalpoint.classList.toggle("modal-close-point-uno");
});

cerrarpoint.addEventListener("click", function(){
    modalpoint.classList.toggle("modal-close-point-uno");
   
    setTimeout(function(){
        modalContainerpoint.style.opacity = "0";
        modalContainerpoint.style.visibility = "hidden";
    },600)
})
 window.addEventListener("click", function(e){
    //  console.log(e.target)
     if(e.target == modalContainerpoint){

        modalpoint.classList.toggle("modal-close-point-uno");
   
    setTimeout(function(){
        modalContainerpoint.style.opacity = "0";
        modalContainerpoint.style.visibility = "hidden";
    },850)

     }
     


})


let cerrarpointdos = document.querySelectorAll(".close-point-dos")[0];
let abrirpointdos = document.querySelectorAll("#openModalPointDos")[0];
let modalpointdos = document.querySelectorAll(".modal-point-dos")[0];
let modalContainerpointdos = document.querySelectorAll(".modal-container-point-dos")[0];

abrirpointdos.addEventListener("click" , function(e){
    e.preventDefault();
    modalContainerpointdos.style.opacity = "1";
    modalContainerpointdos.style.visibility = "visible";
    modalpointdos.classList.toggle("modal-close-point-dos");
});

cerrarpointdos.addEventListener("click", function(){
    modalpointdos.classList.toggle("modal-close-point-dos");
   
    setTimeout(function(){
        modalContainerpointdos.style.opacity = "0";
        modalContainerpointdos.style.visibility = "hidden";
    },600)
})
 window.addEventListener("click", function(e){
    //  console.log(e.target)
     if(e.target == modalContainerpointdos){

        modalpoint.classList.toggle("modal-close-point-dos");
   
    setTimeout(function(){
        modalContainerpointdos.style.opacity = "0";
        modalContainerpointdos.style.visibility = "hidden";
    },850)

     }
     


})
















