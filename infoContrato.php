<br>
<br>
<section class="items-grid section">
    <div class="row">
        <?php
        $sql = "SELECT * FROM `tbltipocontrato`";
        $mydb->setQuery($sql);
        $comp = $mydb->loadResultList(); ?>

        <?php foreach ($comp as $contrato) {
            $companyUrl = web_root . 'index.php?q=hiring&search=' . urlencode($contrato->TIPOCONTRATO); ?>

            <div class="content">
                <div class="top-content">
                    <h3 class="title">
                        <a href="<?php echo $companyUrl; ?>">
                            <?php echo $contrato->TIPOCONTRATO; ?>
                        </a>
                    </h3>
                    <p class="text-muted"><?php echo $contrato->TIPOCONTRATO; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</section>