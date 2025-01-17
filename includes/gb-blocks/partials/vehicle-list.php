<?php
include_once plugin_dir_path(__FILE__) . "../vehicle-block.php";
$vehicles = get_vehicles();
?>

<div class="vehicle-list">
    <?php if (empty($vehicles)): ?>
        <p>No vehicles found.</p>
    <?php else: ?>
        <?php foreach ($vehicles as $vehicle): ?>
            <div class="vehicle-item">
                <h3><?php echo esc_html($vehicle['title']); ?></h3>
                <p><strong>Company:</strong> <?php echo esc_html($vehicle['company']); ?></p>
                <p><strong>Production:</strong> <?php echo esc_html($vehicle['production']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>