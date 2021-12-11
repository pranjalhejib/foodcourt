<div id="contact" class="container text-center pt-5 pb-5" style="font-family: 'Merienda', cursive; color: black; background-color: #FDFAF6;">
    <br>
    <h2>Contact Us</h2><br>

    <div class="text-dark mx-auto" style="background-color: #FDFAF6;">

        <!--  form  -->
        <form action="" method="post" class="container pt-1 mt-1">
            <!-- fname -->
            <div class="input-group mb-3 mx-auto" style="width: 75%;">
                <span class="input-group-text"><i class="far fa-user" style="font-size: 20px;"></i></span>
                <input type="text" class="form-control" placeholder="First Name" name="fname" required>
            </div>
            <!-- lname -->
            <div class="input-group mb-3 mx-auto" style="width: 75%;">
                <span class="input-group-text"><i class="far fa-user-circle" style="font-size: 20px;"></i></span>
                <input type="text" class="form-control" placeholder="Last Name" name="lname" required>
            </div>
            <!-- email -->
            <div class="input-group mb-3 mx-auto" style="width: 75%;">
                <span class="input-group-text"><i class="far fa-envelope" style="font-size: 20px;"></i></span>
                <input type="email" class="form-control" placeholder="Email Id" name="email" required>
            </div>
            <!-- contact -->
            <div class="input-group mb-3 mx-auto" style="width: 75%;">
                <span class="input-group-text"><i class="fas fa-phone" style="font-size: 20px;"></i></span>
                <input type="text" class="form-control" placeholder="Contact No" name="contact" required>
            </div>
            <!-- add comments -->
            <div class="input-group mb-3 mx-auto" style="width: 75%;">
                <span class="input-group-text"><i class="far fa-comment-dots" style="font-size: 20px;"></i></span>
                <textarea class="form-control" placeholder="Comments" name="comments" required></textarea>
            </div>
            <!-- submit -->
            <button type="submit" class="btn btn-dark">Submit</button>
        </form>

        <!-- php -->

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $comments = $_POST['comments'];

            //connecting to db
            include_once 'config.php';

            //submit this to db

            //my sql query to be executed
            $sql = "INSERT INTO `contactus` (`fname`, `lname`, `email`, `contact`, `comments`, `created_at`) VALUES ('$fname', '$lname', '$email', '$contact', '$comments', current_timestamp())";



            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '<div class="mt-2 alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Thanks for contacting us.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else {
                echo "Not inserted succesfully!";
                mysqli_errno($conn);
            }
        }



        ?>




    </div>

</div>