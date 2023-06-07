 <!-- Start Items Grid Area -->
 <section class="items-grid section custom-padding">
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <div class="section-title">
                     <h2 class="wow fadeInUp" data-wow-delay=".4s">Resultados de busqueda</h2>
                 </div>
             </div>
         </div>
         <div class="single-head">
             <div class="row">

                 <?php
                    if (isset($_GET['search'])) {
                        # code...
                        $category = $_GET['search'];
                    } else {
                        $category = '';
                    }
                    $sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND CATEGORY LIKE '%" . $category . "%' ORDER BY DATEPOSTED DESC";
                    $mydb->setQuery($sql);
                    $cur = $mydb->loadResultList();


                    foreach ($cur as $result) {
                    ?>

                     <div class="col-lg-12 col-md-6 col-12">
                         <!-- Start Single Grid -->
                         <div class="single-grid wow fadeInUp" data-wow-delay=".6s">
                             <div class="content">
                                 <div class="top-content">
                                     <a href="#" class="tag"> <?php echo  $result->COMPANYNAME ?></a>
                                     <h3 class="title">
                                         <a href="<?php echo web_root . 'index.php?q=viewjob&search=' . $result->JOBID; ?>"><?php echo $result->OCCUPATIONTITLE; ?></a>
                                     </h3>
                                     <p class="update-time"><?php echo $result->JOBDESCRIPTION; ?></p>

                                     <ul class="info-list">
                                         <li><a href="#"><i class="lni lni-map-marker"></i><?php echo $result->SECTOR_VACANCY; ?></a></li>
                                     </ul>
                                 </div>
                                 <div class="bottom-content">
                                     <p> Fecha de publicación : <?php echo date_format(date_create($result->DATEPOSTED), 'M d, Y'); ?></p>
                                     <a href="<?php echo web_root . 'index.php?q=viewjob&search=' . $result->JOBID; ?>" class="like"><i class="bi bi-arrow-right-circle-fill text-success"></i>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php  } ?>
             </div>
         </div>
     </div>
     </div>
 </section>