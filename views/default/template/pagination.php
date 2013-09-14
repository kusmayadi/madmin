<?php if (isset($pagination)): ?>
    <div class="pagination pagination-small">
        <ul>
            <?php if ($pagination->get_current_page() == 1): ?>
                <li class="disabled"><a href="#">«</a></li>
            <?php else: ?>
                <li><a href="<?php echo $pagination->url(1); ?>">«</a></li>
            <?php endif; ?>

            <?php for ($i=1;$i <= $pagination->get_total_pages(); $i++): ?>
            <?php if ($i == $pagination->get_current_page()): ?>
                <li class="active"><a href="#"><?php echo $i; ?></a></li>
            <?php else: ?>
                <li><a href="<?php echo $pagination->url($i); ?>"><?php echo $i; ?></a></li>
            <?php endif; ?>
            <?php endfor; ?>

            <?php if ($pagination->get_current_page() < $pagination->get_total_pages()): ?>
                <li><a href="<?php echo $pagination->url($pagination->get_total_pages()); ?>">»</a></li>
            <?php else: ?>
                <li class="disabled"><a href="#">»</a></li>
            <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>