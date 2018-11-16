function AbrirMapa(NomeCidade, elmnt) {
    // Mostrar todos elementos da class tabContent */
    var i, tabcontent, tablinks;
   
    // console.log(NomeCidade);
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }

    document.getElementById(NomeCidade).style.display = "block";
}
document.getElementById("defaultOpen").click();