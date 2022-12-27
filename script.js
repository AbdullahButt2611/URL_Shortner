// Selecting all the required elements
const form = document.querySelector(".wrapper form"),
fullURL = form.querySelector("input"),
shortenBtn = form.querySelector("button"),
blurEffect = document.querySelector(".blur-effect"),
popupBox = document.querySelector(".popup-box"),
shortenURL = popupBox.querySelector("input"),
saveBtn = popupBox.querySelector("button");


form.onsubmit = (e) => {

    // preventing form from submitting
    e.preventDefault();
}


shortenBtn.onclick = ()=>{
    
    // Starting ajax
    let xhr = new XMLHttpRequest();         // creating xhr object\
    xhr.open("POST", "php/url-control.php", true);

    xhr.onload = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){
            let data = xhr.response;
            if(data.length <= 5)
            {
                blurEffect.style.display = "block";
                popupBox.classList.add("show");

                let domain = "localhost/URL_Shortner/";
                shortenURL.value = domain + data;


                // Working on the Save Button
                saveBtn.onclick = () =>{
                    location.reload();              // Reload the Current Page
                };

            }
            else{
                alert(data)
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}