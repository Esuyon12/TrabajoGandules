<?php if (!empty($cur2)) { ?>
    <?php if ($cur2->MSG == 0) { ?>
        <span class="badge bg-danger text-uppercase">Enviar correo</span>
        <?php } else if (!empty($cur2->RESULT)) {
        if ($cur2->RESULT >= 16) { ?>
            <span class="badge bg-success text-uppercase">correo aprobatorio</span>
    <?php }
    } ?>
    <?php if (!empty($cur2->DATE_END) and $fechaHoraActual > $cur2->DATE_END) { ?>
        <span class="badge bg-success text-uppercase">Aprobado</span>
        <?php if (empty($cur2->RESULT)) { ?>
            <span class="badge bg-warning text-uppercase">revision</span>
        <?php } ?>
    <?php } else if (!empty($cur2->DATE_END) and $fechaHoraActual < $cur2->DATE_END) { ?>
        <span class="badge bg-secondary text-uppercase">En proceso</span>
    <?php } else { ?>
        <span class="badge bg-warning text-uppercase">pendiente</span>
    <?php } ?>
<?php } else { ?>
    <span class="badge bg-danger text-uppercase">sin evaluacion</span>
<?php } ?>