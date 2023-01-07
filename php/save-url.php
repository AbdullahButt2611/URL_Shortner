<?php

// Getting values sent from ajax

include "config.php";
$og_url = mysqli_real_escape_string($conn, $_POST['shorten_url']);
$full_url = str_replace(' ', '', $og_url);              //Removing spaces from URL if user entered mistakenly
$hidden_url = mysqli_real_escape_string($conn, $_POST['hidden_url']);

if(!empty($full_url))
{
    $domain = "localhost";
    // Checking user have edited or removed the domain name or not
    if(preg_match("/{$domain}/i", $full_url) && preg_match("/\//i", $full_url))
    {
        $explodeURL = explode('/', $full_url);
        $short_url = end($explodeURL);                  // Getting last value of full URL

        if($short_url != "")
        {
            // Selecting randomly created url to update the value with the user entered value
            $sql = mysqli_query($conn,  "SELECT shorten_url from url where shorten_url = '{$short_url}' && shorten_url != '{$hidden_url}'");
            if(mysqli_num_rows($sql) == 0){         // If user entered URL does not exist in our database.
                
                // Updaing the link or URL
                $sql2 = mysqli_query($conn,  "UPDATE url set shorten_url = '{$short_url}' Where shorten_url = '{$hidden_url}' ");
                if($sql2){              // If the URL is updated
                    echo "Success";
                }else{
                    
                }

            }else{
                echo "Error! - This URL already exists.";
            }

        }else{
            echo "Invalid URL! - You can't edit domain name";
        }

    }else{
        echo "Invalid URL! - You can't edit domain name";
    }

}else{
    echo "Error! - You have entered short URL";
}

?>