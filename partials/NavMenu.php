<ul class="menu">
  <?php foreach ($menuItems as $item): ?>
    <?php if (in_array(strtolower($_SESSION['role']), array_map('strtolower', $item["authorized"]))): ?>
      <li>
        <a href="<?= htmlspecialchars($item["href"]) ?>" class="link-items">
          <i class="<?= htmlspecialchars($item["icon"]) ?>"></i>
          <span><?= htmlspecialchars($item["text"]) ?></span>
        </a>
      </li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>