// Selecting all the required elements
const form = document.querySelector(".wrapper form"),
fullURL = form.querySelector("input"),
shortenBtn = form.querySelector("button"),
blurEffect = document.querySelector(".blur-effect"),
popupBox = document.querySelector(".popup-box"),
form2 = popupBox.querySelector("form"),
shortenURL = popupBox.querySelector("input"),
saveBtn = popupBox.querySelector("button"),
copyBtn = popupBox.querySelector("form .copy-icon"),
infoBox = popupBox.querySelector(".info-box");

form.onsubmit = (e) => {
    // preventing form from submitting
    e.preventDefault();
}


shortenBtn.onclick = ()=>{
    
    // Starting ajax
    let xhr = new XMLHttpRequest();         // creating xhr object\
    xhr.open("POST", "php/url-control.php", true);

    xhr.onload = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){       // if ajax request status is ok or success
            let data = xhr.response;
            if(data.length <= 5)
            {
                blurEffect.style.display = "block";
                popupBox.classList.add("show");

                let domain = "localhost/URL_Shortner/";
                shortenURL.value = domain + data;
                
                copyBtn.onclick = () => {
                    shortenURL.select();
                    document.execCommand("copy");
                }

                form2.onsubmit = (e) =>{
                    e.preventDefault();
                }
                
                // Working on the Save Button
                saveBtn.onclick = () =>{


                    let xhr2 = new XMLHttpRequest();         // creating xhr object\
                    xhr2.open("POST", "php/save-url.php", true);

                    xhr2.onload = ()=>{
                        if(xhr2.readyState == 4 && xhr2.status == 200){       // if ajax request status is ok or success
                            let data = xhr2.response;
                            if(data == "Success")
                            {
                                location.reload();          // Reload the current page
                            }
                            else
                            {
                                infoBox.innerText = data;
                                infoBox.classList.add("error");
                            }
                        }
                    }

                    // Sending two daya values from ajax to php
                    let short_url = shortenURL.value;
                    let hidden_url = data;
                    xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr2.send("shorten_url="+short_url+"&hidden_url="+hidden_url);

                    // location.reload();
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