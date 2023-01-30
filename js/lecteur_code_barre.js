/*
    SCRIPT GERANT LE SYSTEME DE DETECTION DE CODES BARRES
*/

const tolerance_precision_code_barre = 0.16;

window.addEventListener("load", () => {

})

document.getElementById("boutonPhoto").addEventListener("click", () => {
        afficher_camera();
});

//Handler qui s'éxécute lorsque qu'un code barre a été trouvé
Quagga.onDetected(function (data) {
    if(lecture_assez_precise(data)){
        //Si le code barre semble assez précis on fait ce qu'il faut en dessous
        console.log(data);
        cacher_camera();

        let code = data.codeResult.code;
        loadRessource(`https://world.openfoodfacts.org/api/v0/product/${code}.json`).then((platData) => {
            let nutriments = platData.product.nutriments;

            let valNuts = {
                energie: nutriments["energy-kcal_100g"],
                glucides: nutriments["carbohydrates_100g"],
                proteines: nutriments["proteins_100g"],
                lipides: nutriments["fat_100g"],
                nom: platData.product["product_name_fr"] + " " + platData.product["brands"].toUpperCase()
            }
            setAffichageValNuts(valNuts);
        })
    }
});

function afficher_camera(){
    temp_html = document.getElementById("corp").innerHTML;
    document.getElementById("corp").classList.add("cacher");
    document.getElementById("camera").classList.remove("cacher");
    activer_quagga();
    redimensionnerVideos();
}

function cacher_camera(){
    stopper_quagga();
    document.getElementById("camera").classList.add("cacher");
    document.getElementById("corp").classList.remove("cacher");
}

function activer_quagga(){
    Quagga.init({
        inputStream : {
        name : "Live",
        type : "LiveStream",
        target: document.querySelector('#camera')    // Or '#yourElement' (optional)
        },
        decoder : {
        readers : ["ean_reader"]
        }
    }, function(err) {
        if (err) {
            console.log(err);
            return
        }
        console.log("Initialization finished. Ready to start");
    });
    Quagga.start();
}

function stopper_quagga(){
    Quagga.stop();
}

function lecture_assez_precise(data){
    if(data.codeResult === undefined) return false;
    if(data.codeResult.decodedCodes === undefined) return false;
    if(data.codeResult.format != "ean_13") return false;
    if(data.codeResult.code === undefined) return false;
    
    let decodedCodes = data.codeResult.decodedCodes;
    let precision_des_codes = decodedCodes.slice(1, decodedCodes.length).map((e) => e.error);
    
    for(let i = 0; i<precision_des_codes.length; i++){
        if(precision_des_codes[i] > tolerance_precision_code_barre) return false;
    }


    return true;
}

function redimensionnerVideos() {
	let video = document.querySelector("#camera video");
    video.width = 1200;
}