<?php
declare(strict_types=1);

$context = $pagination['context'];
$cursor = $pagination['current_cursor'];
$numbered = $context === 'home' && ($cursor === '' || ctype_digit($cursor));
$current = (int)($pagination['page_number'] ?? 1);
$total = (int)($pagination['page_count'] ?? 1);
$first = $pagination['first_url'];
$more = $pagination['has_more'];
if (($numbered && $total <= 1) || (!$numbered && !$more && $cursor === '')) return;
?>
<nav id="pagination" class="pagination" aria-label="<?= $context === 'topic' ? '回复分页' : '主题分页' ?>">
  <?php if ($numbered): ?>
    <?php if ($current > 1): ?><a class="extend prev" href="<?= e($current === 2 ? $first : '/forum-'.($current - 1)) ?>" rel="prev" aria-label="上一页">‹</a><?php endif; ?>
    <?php $previous = 0; foreach (array_unique(array_merge([1], range(max(1, $current - 2), min($total, $current + 2)), [$total])) as $number): ?>
      <?php if ($number > $previous + 1): ?><span class="page-number space" aria-hidden="true">…</span><?php endif; ?>
      <?php if ($number === $current): ?>
        <span class="page-number current" aria-current="page"><?= $number ?></span>
      <?php else: ?>
        <a class="page-number" href="<?= e($number === 1 ? $first : '/forum-'.$number) ?>"><?= $number ?></a>
      <?php endif; ?>
      <?php $previous = $number; ?>
    <?php endforeach; ?>
  <?php elseif ($cursor !== ''): ?>
    <a class="extend prev" href="<?= e($first) ?>">第一页</a>
  <?php endif; ?>
  <?php if ($more): ?><a class="extend next" href="<?= e($pagination['next_url']) ?>" rel="next"><?= $context === 'topic' ? '更多回复' : '下一页' ?> ›</a><?php endif; ?>
</nav>
