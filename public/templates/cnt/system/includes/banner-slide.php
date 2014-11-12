 <?php 
    $dir = new DirectoryIterator(FILES_PATH . '/templates/banner-slide/');
    $arrBannerImages = array();
    foreach ($dir as $fileInfo) {
        if (!$fileInfo->isDot()) {
            $arrBannerImages[] = $fileInfo->getFilename();
        }
    }
?>     
      <div id="slideshow" class="row">
        <div id="carousel-id" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-id" data-slide-to="0" class=""></li>
                <li data-target="#carousel-id" data-slide-to="1" class=""></li>
                <li data-target="#carousel-id" data-slide-to="2" class="active"></li>
            </ol>
            <div class="carousel-inner">
               <?php 
                if (count($arrBannerImages) > 0) {
                    sort($arrBannerImages);
                
                    foreach ($arrBannerImages as $key=>$value) {
                        $banner_image_name = $value;
                        $banner_image_url = FILES_URL . '/templates/banner-slide/' . $banner_image_name;
                        if ($key == 0) {
            ?>  
                <div class="item active">
            <?php 
                        } else {
            ?>
                <div class="item">
            <?php 
                        }
            ?>
                    <img src="<?php echo $banner_image_url; ?>" >
                     <div class="container">
                        <div class="carousel-caption">
                            <img src="<?php echo $this->imgUrl; ?>/vaio.png" alt="Image">
                            <h1>sony vaio duo <span>13</span></h1>
                            <p>DIGITAL ART REVOLUTION</p>
                            <p><a class="btn btn-primary" href="details.html" role="button">SHOP NOW</a></p>
                        </div>
                    </div>
                </div>
            <?php 
                    }
                }
            ?>
                
            </div>
            <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
      </div>
