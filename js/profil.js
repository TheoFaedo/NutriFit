const ObjInputs = {energ: document.getElementById("energie"), lip: document.getElementById("lipides"), prot: document.getElementById("proteines"), gluc: document.getElementById("glucides")};

document.getElementById("bouton_obj").addEventListener("click", () => {
    console.log("a")
    changerObjectifs({
        energie: ObjInputs.energ.value,
        lipides: ObjInputs.lip.value,
        glucides: ObjInputs.gluc.value,
        proteines: ObjInputs.prot.value
    })
})

function changerObjectifs(objectifs){
    const data = objectifs; //On mets les différentes quantité en payload
    fetch('api/changerObjectifs/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
        })
        .then((response) => actualiserObjectif());
}

function actualiserObjectif(){
    loadRessource("api/getObjectif")
        .then((res) => {
            let obj = res.objectif;
            ObjInputs.energ.value = obj.obj_energie;
            ObjInputs.lip.value = obj.obj_lipides;
            ObjInputs.gluc.value = obj.obj_glucides;
            ObjInputs.prot.value = obj.obj_proteines;
        });
}

