<!--"
//TABLE THAT WE ARE WORKING WITH

CREATE TABLE IF NOT EXISTS posts  (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    post TEXT NOT NULL,
    ip varchar(30) NOT NULL,
    posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)"; -->

<!DOCTYPE html>
<html>
    <head>
        <title>Shit shat away!</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>

            :root {
                --color: white;
            }
            body{background-color:black;}
            h4{color:white;}

            textarea:hover, 
            input:hover, 
            textarea:active, 
            input:active, 
            textarea:focus, 
            input:focus,
            button:focus,
            button:active,
            button:hover,
            label:focus,
            .btn:active,
            .btn.active
            {
                outline:0px !important;
                -webkit-appearance:none;
                box-shadow: none !important;
            }

            .userPost { border: 1px solid var(--color);}
            .userPost p {color: var(--color);}
        </style>
    </head>
    <body>
    <canvas id="canvasBackground" style="position: absolute"> </canvas>
        
        <div class="row d-flex justify-content-center ">
            <div style="background:transparent; height:auto;"  class="col-md-6">

                <div class="container text-center">

                    <h4>Shit shatter messageboard</h4>
                    
                    <form class="text-left px-2 p-3 mx-auto text-center" method="post">
                    
                            <div class="col-md-6 mx-auto">

                                <textarea class="userPost" style="background:black; color:white; border-radius:5px;" name="text" rows="5" cols="38" required></textarea>
                                <div class="container pt-3 text-left">
                                    <input class="btn btn-dark" type="submit" name="submit" value="Submit">
                                </div>

                            </div>

                    </form>
                </div>
            
                <?php

                    if(isset($_POST['text']))
                    {
                        $post = $_POST['text'];
                    
                    }

                    function queryData($query) {

                        $conn = new mysqli("localhost", "root", "", "postsdb");
                        $result = $conn->query($query);

                        return $result;

                        $conn->close();
                    }
                    

                    $posts = queryData("SELECT * FROM posts");
                    foreach($posts as $row) {
                        
                        echo '
                                <div class="col-md-12 ">

                                    <div class="card mb-4 userPost">
                                        <div style="background:black;" class="card-header">
                                            <div class="media flex-wrap align-items-center">
                                                <div style="color:white;" class="media-body ml-3"> 
                                                    <p>Anonymous </p>
                                                    <div class="small"> <p>' .$row['posted'], '</p></div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p>' .$row['post'], '</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>';
                    }
                ?>
            </div>
        </div>
       
        <script type="text/javascript">
           
                let canvas = document.getElementById("canvasBackground");
                let ctx = canvas.getContext("2d");
                    
                canvas.height = window.innerHeight-20;
                canvas.width = window.innerWidth-10;
                    
                let chars = "01";
                chars = chars.split("");

                let font_size = 13;
                let columns = canvas.width/font_size;
                let drops = [];
			
                for(var x = 0; x < columns; x++)
				    drops[x] = 1; 


                function draw()
		        {
                    const color = 'rgba(' + Math.round(Math.random()*255) + ',' + Math.round(Math.random()*255) + ',' + Math.round(Math.random()*255) + ',' + Math.random().toFixed(1) + ')'

                    document.documentElement.style.setProperty('--color', color);

					ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
					ctx.fillRect(0, 0, canvas.width, canvas.height);
					
					ctx.fillStyle = color;
					ctx.font = font_size + "px arial";
				
                    for(let i = 0; i < drops.length; i++)
                    {
                        let text = chars[Math.floor(Math.random()*chars.length)];
                        ctx.fillText(text, i*font_size, drops[i]*font_size);
                        
                        if(drops[i]*font_size > canvas.height && Math.random() > 0.975)
                            drops[i] = 0;

                        drops[i]++;
                    }
			    }
			
			
			let matrix = setInterval(draw, 30, false);
        </script>

    </body>
</html>