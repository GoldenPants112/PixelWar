function generateGrilles (){
    
    let pixels = document.querySelector("pixels");
    for (i=0;i<900;i++){
   
    const pixel = document.createElement("pixel");
    pixels.appendChild(pixel);
    }

}

window.addEventListener("load",generateGrilles());


function colorPixel(){
    const pixels = Array.from(document.querySelectorAll('pixel'));
    pixels.forEach(pixel => {
        pixel.addEventListener('click',() =>{
        pixel.classList.add("red");
        });
    });

    
}
//window.addEventListener("load",colorPixel());


//fonction qui surligne la couleur selectionne
function colorSelector(){
    const colors= Array.from(document.querySelectorAll("color"));
    console.log(colors);
    colors.forEach(color=>{
        color.addEventListener("click",()=>{

            if (!color.classList.contains("active")){
                try{
                    document.querySelector("color.active").classList.remove("active");
                    
                }
                finally{
                    color.classList.add("active");
                }
            }
        })
    })
}
window.addEventListener("load",colorSelector());



/*
function pixelColor() {
    const pixels =Array.from(document.querySelectorAll("pixel"));
    const affiche_color= Array.from(document.querySelectorAll("color"));
    pixels.forEach(pixel => {
        affiche_color.forEach(color =>{
            addEventListener("click",()=>{
                if(color.classList.contains("red")){

                }




            });
            
        });
    });
}*/