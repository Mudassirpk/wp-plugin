<?php
include_once plugin_dir_path(__FILE__) . "../admin.php";
global $mp_admin;
$vehicles = $mp_admin->get_vehicles_with_metadata();
?>

<div class="mp_add_vehicle_container">
    <h2>Add New Vehicle</h2>
    <form action="" method="post">

        <label for="name">Name</label>
        <input type="text" name="name">
        <label for="company">Company</label>
        <input type="text" name="company">
        <label for="production">Production</label>
        <input type="date" name="production">
        <input type="text" hidden name="ACTION" value="CREATE_MP_VEHICLE_ACTION">
        <button type="submit">Add</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Production</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($vehicles)) {
                foreach ($vehicles as $vehicle) {
                    ?>
                    <tr>
                        <td><?php echo esc_html($vehicle->post_title); ?></td>
                        <td><?php echo esc_html($vehicle->company); ?></td>
                        <td><?php echo esc_html($vehicle->production); ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3">No vehicles found.</td>
                </tr>
                <?php
            }

            ?>

        </tbody>
    </table>
</div>