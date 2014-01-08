<div class="row-fluid">
    <div class="slider">
        <div id="myCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                  <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <?php $slider_1st = $manageContent->getSliderContent(1); ?>
                  </div>
                  <div class="item">
                    <?php $slider_2nd = $manageContent->getSliderContent(2); ?>
                  </div>
                  <div class="item">
                    <?php $slider_3rd = $manageContent->getSliderContent(3); ?>
                  </div>
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
              </div>
    </div>
</div>