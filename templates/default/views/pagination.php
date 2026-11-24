<?php
declare(strict_types=1);

$context = $pagination['context'];
$cursor = $pagination['current_cursor'];
$first = $pagination['first_url'];
$more = $pagination['has_more'];
if (!$more && $cursor === '') return;
?>
<nav id="pagination" class="pagination" aria-label="<?= $context === 'topic' ? '回复分页' : '主题分页' ?>">
  <?php if ($cursor !== ''): ?>
    <a class="extend prev" href="<?= e($first) ?>">第一页</a>
  <?php endif; ?>
  <?php if ($more): ?><a class="extend next" href="<?= e($pagination['next_url']) ?>" rel="next"><?= $context === 'topic' ? '更多回复' : '下一页' ?> ›</a><?php endif; ?>
</nav>
