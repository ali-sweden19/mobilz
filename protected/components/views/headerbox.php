        <div class="<?php echo $class;?>">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-xs-3 col-md-3 text-center">
                        <img src="<?php echo Yii::app()->theme->baseUrl . '/images/'.$image_file;?>" alt="bootsnipp"
                            class="img-rounded img-responsive" />
                    </div>
                    <div class="col-xs-9 col-md-9 section-box" style="height: 170px;">
                        <h2>
                            <?php echo $headerText; ?> <!-- <a href="http://softhem.se/" target="_blank"><span class="glyphicon glyphicon-new-window">
                            </span></a> -->
                        </h2>
                        <p>
                            <?php echo $description; ?></p>
                        <hr />
                    </div>
                    <div style="padding:0 10px;">
                        <div class="img-thumbnail col-sm-3 col-md-3 col-lg-3" style="padding-left: 2px; padding-right: 2px;">
                            <img src="<?php echo Yii::app()->request->baseUrl .'/images/seb.png';?>" alt="SEB bank" class="img-rounded img-responsive">
                        </div> 
                        <div class="img-thumbnail col-sm-3 col-md-3 col-lg-3" style="padding-left: 2px; padding-right: 2px;">
                            <img src="<?php echo Yii::app()->request->baseUrl .'/images/swed.jpg';?>" alt="Swedbank" class="img-rounded img-responsive">
                        </div> 
                        <div class="img-thumbnail col-sm-3 col-md-3 col-lg-3" style="padding-left: 2px; padding-right: 2px;">
                            <img src="<?php echo Yii::app()->request->baseUrl .'/images/nordea.png';?>" alt="Nordea Bank" class="img-rounded img-responsive">
                        </div> 
                        <div class="img-thumbnail col-sm-3 col-md-3 col-lg-3" style="padding-left: 2px; padding-right: 2px;">
                            <img src="<?php echo Yii::app()->request->baseUrl .'/images/handelsbanken.png';?>" alt="Handelsbanken" class="img-rounded img-responsive">
                        </div> 
                    </div>
                </div>
            </div>
        </div>
