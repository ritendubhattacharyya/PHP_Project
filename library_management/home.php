<?php include("header.php");

    if(isset($_SESSION['username'])) {
        echo '
            <main >    
                <!-- welcome section -->
                <div class="index-intro">
                    <h2>WELCOME</h2>
                    <p class="index-intro-desc">Lorem ipsum dolor sit amet, <br/>
                    consectetur adipiscing elit, <br/>
                    sed do eiusmod tempor<br/>
                    incididunt ut</p>

                    <a href="#">ADD BOOKS</a>
                </div>
            </main>


            <!-- menu for hamburger menu -->';

        if(isset($_GET['success']) || isset($_GET['error'])) {
            echo '
            <ul class="menu menuslide">
                <li style="animation: item_slide 0s forwards ease;"><a href="#" onclick="addBooks()">ADD BOOKS</a></li>
                <li style="animation: item_slide 0s forwards ease;"><a href="#" onclick="addMembers()">ADD MEMBERS</a></li>
                <li style="animation: item_slide 0s forwards ease;"><a href="#" onclick="issueBooks()">ISSUE BOOKS</a></li>
                <li style="animation: item_slide 0s forwards ease;"><a href="viewBooks.php" target="_blank">VIEW BOOKS</a></li>
                <li style="animation: item_slide 0s forwards ease;"><a href="viewMembers.php" target="_blank">VIEW MEMBERS</a></li>
                <li style="animation: item_slide 0s forwards ease;"><a href="viewissues.php" target="_blank">VIEW ISSUES</a></li>
            </ul>';
        } else {
            echo '
            <ul class="menu">
                <li><a href="#" onclick="addBooks()">ADD BOOKS</a></li>
                <li><a href="#" onclick="addMembers()">ADD MEMBERS</a></li>
                <li><a href="#" onclick="issueBooks()">ISSUE BOOKS</a></li>
                <li><a href="viewBooks.php" target="_blank">VIEW BOOKS</a></li>
                <li><a href="viewMembers.php" target="_blank">VIEW MEMBERS</a></li>
                <li><a href="viewissues.php" target="_blank">VIEW ISSUES</a></li>
            </ul>';
        }

        //add books modal
        if(isset($_GET['addBooks'])) {
            echo '
            <!-- add books modal -->
            <div class="addBooksContainer">';
            if(isset($_GET['error'])) {
                if($_GET['error'] === 'emptyfield') { 
                    echo '
                        <div class="error" style="border-radius:0px;">
                            <img src="img/error.png" alt="E:">
                            <p class="error">Fields should not be empty</p>
                        </div>';
                }
            } else if(isset($_GET['success'])) {
                if($_GET['success'] === 'added') {
                    echo '
                        <div class="success" style="border-radius:0px;">
                            <img src="img/success.png" alt="E:">
                            <p class="error">Book added successfully</p>
                        </div>';
                }
            }
            echo '
                <form action="include/addBooks.inc.php" method="post" class="addBooksForm" style="animation: drop 0s forwards;">
                    <input type="text" name="bookName" placeholder="Book Name"/>
                    <input type="text" name="authorName" placeholder="Author Name"/>
                    <input type="text" name="category" placeholder="Category"/>
                    <input type="number" name="quantity" placeholder="Quantity"/>
                    <button type="submit" name="addBooksButton" class="add">ADD</button>
                    <a onclick="addBooksModalClose()" class="close">CLOSE</a>
                </form>
            </div>';
        } else {
            echo '
            <!-- add books modal -->
            <div class="addBooksContainer closeModal">
                <form action="include/addBooks.inc.php" method="post" class="addBooksForm">
                    <input type="text" name="bookName" placeholder="Book Name"/>
                    <input type="text" name="authorName" placeholder="Author Name"/>
                    <input type="text" name="category" placeholder="Category"/>
                    <input type="number" name="quantity" placeholder="Quantity"/>
                    <button type="submit" name="addBooksButton" class="add">ADD</button>
                    <a onclick="addBooksModalClose()" class="close">CLOSE</a>
                </form>
            </div>';
        }



        //add members modal
        if(isset($_GET['addMembers'])) {
            echo '
            <!-- add members modal -->
            <div class="addMembersContainer">';
            if(isset($_GET['error'])) {
                if($_GET['error'] === 'emptyfield') { 
                    echo '
                        <div class="error" style="border-radius:0px;">
                            <img src="img/error.png" alt="E:">
                            <p class="error">Fields should not be empty</p>
                        </div>';
                }
            } else if(isset($_GET['success'])) {
                if($_GET['success'] === 'added') {
                    echo '
                        <div class="success" style="border-radius:0px;">
                            <img src="img/success.png" alt="E:">
                            <p class="error">Member added successfully</p>
                        </div>';
                }
            }
             
            echo '
                <form action="include/addMembers.inc.php" method="post" class="addMembersForm" style="animation: drop 0s forwards;">
                    <input type="text" name="firstname" placeholder="First Name"/>
                    <input type="text" name="lastname" placeholder="Last Name"/>
                    <input type="date" name="dob" placeholder="Date of Birth"/>
                    <input type="text" name="adhaar" placeholder="Adhaar Number"/>
                    <input type="text" name="address" placeholder="Address"/>
                    <input type="text" name="mobile" placeholder="Mobile"/>
                    <button type="submit" name="addMembersButton" class="add">ADD</button>
                    <a onclick="addMembersModalClose()" class="close">CLOSE</a>
                </form>
            </div>';
        } else {
            echo '
            <!-- add members modal -->
            <div class="addMembersContainer closeModal">
                <form action="include/addMembers.inc.php" method="post" class="addMembersForm">
                    <input type="text" name="firstname" placeholder="First Name"/>
                    <input type="text" name="lastname" placeholder="Last Name"/>
                    <input type="date" name="dob" placeholder="Date of Birth"/>
                    <input type="text" name="adhaar" placeholder="Adhaar Number"/>
                    <input type="text" name="address" placeholder="Address"/>
                    <input type="text" name="mobile" placeholder="Mobile"/>
                    <button type="submit" name="addMembersButton" class="add">ADD</button>
                    <a onclick="addMembersModalClose()" class="close">CLOSE</a>
                </form>
            </div>';
        }


        //issue members modal
        if(isset($_GET['issueBooks'])) {
            echo '
            <!-- issue books modal -->
            <div class="issueBooksContainer">';
            if(isset($_GET['error'])) {
                if($_GET['error'] === 'emptyfield') { 
                    echo '
                        <div class="error" style="border-radius:0px;">
                            <img src="img/error.png" alt="E:">
                            <p class="error">Fields should not be empty</p>
                        </div>';
                } else if($_GET['error'] === 'nomembers') {
                    echo '
                        <div class="error" style="border-radius:0px;">
                            <img src="img/error.png" alt="E:">
                            <p class="error">There are no members!!</p>
                        </div>';
                } else if($_GET['error'] === 'nobooks') {
                    echo '
                        <div class="error" style="border-radius:0px;">
                            <img src="img/error.png" alt="E:">
                            <p class="error">There are no books!!</p>
                        </div>';
                } else if($_GET['error'] === 'bookidormemberidnotexistoralreadyissued') {
                    echo '
                        <div class="error" style="border-radius:0px;">
                            <img src="img/error.png" alt="E:">
                            <p class="error">Either bookId or memberId not exists or Already issued</p>
                        </div>';
                }
            } else if(isset($_GET['success'])) {
                if($_GET['success'] === 'added') {
                    echo '
                        <div class="success" style="border-radius:0px;">
                            <img src="img/success.png" alt="E:">
                            <p class="error">issued successfully</p>
                        </div>';
                }
            }
            echo '
                <form action="include/issueBooks.inc.php" method="post" class="issueBooksForm" style="animation: drop 0s forwards;">
                    <input type="number" name="memberId" placeholder="Member ID"/>
                    <input type="number" name="bookId" placeholder="Book ID"/>
                    <input type="date" name="issueDate" placeholder="Issue Date"/>
                    <button type="submit" name="issueBooksButton" class="add">ISSUE</button>
                    <a onclick="issueBooksModalClose()" class="close">CLOSE</a>
                </form>
            </div>';
        } else {
            echo '
            <!-- issue books modal -->
            <div class="issueBooksContainer closeModal">
                <form action="include/issueBooks.inc.php" method="post" class="issueBooksForm">
                    <input type="number" name="memberId" placeholder="Member ID"/>
                    <input type="number" name="bookId" placeholder="Book ID"/>
                    <input type="date" name="issueDate" placeholder="Issue Date"/>
                    <button type="submit" name="issueBooksButton" class="add">ISSUE</button>
                    <a onclick="issueBooksModalClose()" class="close">CLOSE</a>
                </form>
            </div>';
        }

        echo '
        </body>
        <script src="js/hamburger.js?v=<?php echo time(); ?>"></script>
        <script src="js/modal.js?v=<?php echo time(); ?>"></script>
        </html>';
    } else {
        header("Location: index.php");
    }
?>


    

