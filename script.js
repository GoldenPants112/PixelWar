function generateGrilles (){
    
    let pixels = document.querySelector("pixels");
    for (i=1;i<901;i++){
   
        const pixel = document.createElement("pixel");
        pixel.id=i;
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
//fonction qui attend 10 secondes
function delais(){
    setTimeout(10000);
}

function pixelColor() {
    const pixels =Array.from(document.querySelectorAll("pixel"));
    const affiche_color= Array.from(document.querySelectorAll("color"));
    let flag=false;
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
                flag=true;
                return flag ;
        
            }); 
                      
        });
        
    });
    
    
}


function grilleLoop(){
    let flag= pixelColor();

    if (flag){
        delais();
    }  
    pixelColor();

}

window.addEventListener("load",grilleLoop());


//fonction qui cherche a envoyer des donee au fichier php afin de recuperere la couleur et la position des pixels
async function getGrille(){
    const pixels = Array.from(document.querySelectorAll("pixel"));
    const formData= new formData;

    pixels.forEach(pixel=>{
        let id=pixel.id;
        let color = pixel.classList;
        
        formData.append("color[]",color);
        formData.append("position[]",id);
    });
        

        
    try{const reponse = await fetch ("grille.php",{
            method:"post",
            body:formData
        });
    const message= await reponse.text();
    console.log(message);}
    catch(error){
        console.error("Sending errors",error);
    }
}
//window.addEventListener("load",getGrille());
