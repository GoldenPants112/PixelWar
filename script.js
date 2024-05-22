function generateGrilles (){
    
    let pixels = document.querySelector("pixels");
    for (i=0;i<900;i++){
   
    const pixel = document.createElement("pixel");
    pixels.appendChild(pixel);
    }

}

window.addEventListener("load",generateGrilles());

//fonction qui colorie le pixel selon la couleur choisie
function colorPixel(){
    const pixels = Array.from(document.querySelectorAll('pixel'));
    pixels.forEach(pixel => {
        pixel.addEventListener('click',() =>{
        if(color.classList.contains("red") )
        pixel.classList.add("red");
        });
    });

    
}


//fonction qui surligne la couleur selectionne
function colorSelector(){
    const colors= Array.from(document.querySelectorAll("color"));
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


//fonction qui a pour but de supprimer la couleur d'un pixel 
function supprColor(pixel){
    pixel.classList="";
}

function pixelColor() {
    const pixels =Array.from(document.querySelectorAll("pixel"));
    const affiche_color= Array.from(document.querySelectorAll("color"));
    pixels.forEach(pixel => {
        affiche_color.forEach(color =>{
            pixel.addEventListener("click",()=>{
                if(color.classList.contains("red") && color.classList.contains("active")){             
                    supprColor(pixel);
                    pixel.classList.add("red");
                }
                else if(color.classList.contains("green") && color.classList.contains("active")){             
                    supprColor(pixel);
                    pixel.classList.add("green");
                }
                else if(color.classList.contains("blue") && color.classList.contains("active")){             
                    supprColor(pixel);
                    pixel.classList.add("blue");
                }
                else if(color.classList.contains("yellow") && color.classList.contains("active")){             
                    supprColor(pixel);
                    pixel.classList.add("yellow");
                }
                else if(color.classList.contains("orange") && color.classList.contains("active")){             
                    supprColor(pixel);
                    pixel.classList.add("orange");
                }
                else if(color.classList.contains("pink") && color.classList.contains("active")){             
                    supprColor(pixel);
                    pixel.classList.add("pink");
                }

            });
            
        });
    });
}
window.addEventListener("load",pixelColor());
