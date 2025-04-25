function showHide(elemente)
{
    elemente.classList.toggle('hidded') 
}

modif = document.getElementById('img_modif_show')
imgForm = document.getElementById('img_form')

modif.addEventListener("click",() => {
    showHide(imgForm)
})