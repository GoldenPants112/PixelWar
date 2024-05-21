function generateGrilles (){
    
    let pixels = document.querySelector("pixels");
    for (i=0;i<900;i++){
   
    const pixel = document.createElement("pixel");
    pixels.appendChild(pixel);
    }

}

window.addEventListener("load",generateGrilles());


function attachToolsEvent(){
    const pixels = Array.from(document.querySelectorAll('pixel'));
    pixels.forEach(pixel => {
        pixel.addEventListener('click',() =>{
        pixel.classList.add("red");
        });
    });

    
}
window.addEventListener("load",attachToolsEvent());