<?php if (!empty($pager)) : ?>

    <div>
        <a class="btn btn-primary text-uppercase <?= $pager->hasPreviousPage() ? '' : 'disabled' ?>" href="<?= $pager->getPreviousPage() ?>">← Newer Posts</a>
    </div>
    <div class="ms-auto">
        <a class="btn btn-primary text-uppercase <?= $pager->getNextPage() ? '' : 'disabled' ?>" href="<?= $pager->getNextPage() ?>">Older Posts →</a>
    </div>

<?php endif; ?>