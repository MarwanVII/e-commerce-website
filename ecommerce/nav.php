<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li ><a href="index.php">Home</a></li>
                <?php
                include 'connectDatabase.php';
                include 'Category.php';
                $selectCategoryNameQuery = $pdo->prepare("SELECT * FROM `category`");
                $selectCategoryNameQuery->execute();
                $selectCategoryNameQuery->setFetchMode(PDO::FETCH_CLASS,'Category');
                $categories=$selectCategoryNameQuery->fetchAll(PDO::FETCH_OBJ);
                foreach ($categories as $category)
                {
                ?>
                <li class="<?php if(isset($_GET['categoryId']) && $_GET['categoryId'] == $category->categoryId)
                {
                    echo 'active';
                }
                    ?>"><a href="categoryStore.php?categoryId=<?=$category->categoryId ;?>"><?=$category->categoryName ;?></a></li>
                <?php  }?>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- NAVIGATION -->