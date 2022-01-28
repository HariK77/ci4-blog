<?php if (!empty($pager)) : ?>

<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation example">
    <ul class="pagination">

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

    </ul>
</nav>

<?php endif; ?>