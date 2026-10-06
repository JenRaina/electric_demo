<?php

use CodeIgniter\Pager\PagerRenderer;

/** @var PagerRenderer $pager */
$pager->setSurroundCount(2);
?>

<?php if ($pager->getPageCount() > 1): ?>

<style>
    .simple-pagination {
        display: flex;
        gap: 14px;
        align-items: center;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .simple-pagination a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
    }

    .simple-pagination a:hover {
        color: #0d6efd;
        text-decoration: underline;
    }

    .simple-pagination .active a {
        color: #0d6efd;
        font-weight: bold;
    }
</style>

<nav aria-label="Account pages">
    <ul class="simple-pagination">

        <?php if ($pager->hasPrevious()): ?>
            <li>
                <a href="<?= $pager->getFirst() ?>">&lt;&lt;</a>
            </li>

            <li>
                <a href="<?= $pager->getPrevious() ?>">&lt;</a>
            </li>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link): ?>
            <li class="<?= $link['active'] ? 'active' : '' ?>">
                <a href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <?php if ($pager->hasNext()): ?>
            <li>
                <a href="<?= $pager->getNext() ?>">&gt;</a>
            </li>

            <li>
                <a href="<?= $pager->getLast() ?>">&gt;&gt;</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>

<?php endif; ?>