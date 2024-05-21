function generateGrilles (){
    
    let pixels = document.querySelector("pixels");
    for (i=0;i<900;i++){
   
    const pixel = document.createElement("pixel");
    pixels.appendChild(pixel);
    }

}

window.addEventListener("load",generateGrilles());

