<!-- Redirecting User to the original link using shorter link -->
<?php
    include "php/config.php";
    $new_url = "";
    if(isset($_GET))
    {
        foreach($_GET as $key=>$val)
        {
            $u = mysqli_real_escape_string($conn, $key);
            $new_url = str_replace('/', '', $u);            //Removing / sign from url
        }

        // Getting the full URL of that short url 
        $sql = mysqli_query($conn, "SELECT full_url FROM url WHERE shorten_url = '{$new_url}'");
        if(mysqli_num_rows($sql) > 0)
        {
            $count_query = mysqli_query($conn, "UPDATE url SET clicks = clicks + 1 WHERE shorten_url = '{$new_url}' ");
            if($count_query){
                // Redirecting User
                $full_url = mysqli_fetch_assoc($sql);
                header("Location:".$full_url['full_url']);
            }

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
                <?php
                    $sql3 = mysqli_query($conn, "SELECT COUNT(*) FROM url");
                    $res = mysqli_fetch_assoc($sql3);

                    $sql4 = mysqli_query($conn, "SELECT clicks FROM url");
                    $total = 0;

                    while($c = mysqli_fetch_assoc($sql4) ){
                        $total = $c['clicks'] + $total;
                    }
                ?>

                <span>Total Links: <span><?php echo end($res); ?></span> and Total Clicks: <span><?php echo $total; ?></span></span>
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
                            <a href="http://localhost/URL_Shortner/<?php echo $row['shorten_url'] ?>" target="_blank" target="_blank">
                                <?php
                                    if('localhost/url?u='.strlen($row['shorten_url']) > 50){
                                        echo "localhost/URL_Shortner/" . substr($row['shorten_url'], 0, 50).'...';
                                    } 
                                    else
                                    {
                                        echo "localhost/URL_Shortner/".$row['shorten_url'];
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
                        <li><a href="php/delete.php?id=<?php echo $row['shorten_url'] ?>">Delete</a></li>
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