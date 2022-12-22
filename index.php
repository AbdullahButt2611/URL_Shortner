<!-- Redirecting User to the original link using shorter link -->
<?php
    include "php/config.php";
    if(isset($_GET['u']))
    {
        $u = mysqli_real_escape_string($conn, $_GET['u']);

        // Getting the full URL of that short url 
        $sql = mysqli_query($conn, "SELECT full_url FROM url WHERE shorten_url = '{$u}'");
        if(mysqli_num_rows($sql) > 0)
        {
            // Redirecting User
            $full_url = mysqli_fetch_assoc($sql);
            echo $full_url['full_url'];
            header("Location:".$full_url['full_url']);
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortner</title>

    <!-- IconScount Link for Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="Assets/logo.png" type="image/x-icon">
</head>
<body>
    <div class="wrapper">
        <form action="#">
            <input type="text" name="full_url" placeholder="Enter or paste a long url" required>
            <i class="url-icon uil uil-link"></i>
            <button>Shorten</button>
        </form>

        <?php

        $sql2 = mysqli_query($conn, "SELECT * FROM url ORDER BY id DESC");
        if(mysqli_num_rows($sql2) > 0)
        {
            ?>
            <div class="count">
                <span>Total Links: <span>10</span> and Total Clicks: <span>140</span></span>
                <a href="#">Clear All</a>
            </div>

            <div class="urls-area">
                <div class="title">
                    <li>Shorten URL</li>
                    <li>Original URL</li>
                    <li>Clicks</li>
                    <li>Actions</li>
                </div>
                <?php
                while($row = mysqli_fetch_assoc($sql2))
                {
                    ?>
                    <div class="data">
                        <li>
                            <a href="#">
                                <?php
                                    if('localhost/url?u='.strlen($row['shorten_url']) > 50){
                                        echo "localhost/url?u=" . substr($row['shorten_url'], 0, 50).'...';
                                    } 
                                    else
                                    {
                                        echo "localhost/url?u=".$row['shorten_url'];
                                    }
                                ?>
                            </a>
                        </li>

                        <li>
                                <?php
                                    if(strlen($row['full_url']) > 65){
                                        echo substr($row['full_url'], 0, 65).'...';
                                    } 
                                    else
                                    {
                                        echo $row['full_url'];
                                    }
                                ?>
                        </li>
                        <li><?php echo $row['clicks'] ?></li>
                        <li><a href="#">Delete</a></li>
                    </div>
                    <?php
                }
        }
        ?>
        </div>

    </div>

    <div class="blur-effect"></div>

    <div class="popup-box">
        <div class="info-box">Your short link is ready. You can also edit your short link now but can't edit once saved.</div>
        <form action="#">
            <label for="">Edit your shorten url</label>
            <input type="text" value="" spellcheck="false">
            <i class="copy-icon uil uil-copy"></i>
            <button>Save</button>
        </form>
    </div>


    <script src="script.js"></script>
</body>
</html>