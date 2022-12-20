// Selecting all the required elements
const form = document.querySelector(".wrapper form"),
fullURL = form.querySelector("input"),
shortenBtn = form.querySelector("button");


form.onsubmit = (e) => {

    // preventing form from submitting
    e.preventDefault();
}


shortenBtn.onclick = ()=>{
    
    // Starting ajax
    let xhr = new XMLHttpRequest();         // creating xhr object\
    xhr.open("POST", "php/url-control.php", true);

    xhr.onload = () => {
        if(xhr.readyState == 4)
        {
            
        }
    }

    xhr.send();
}