<?php defined('ABSPATH') || exit; ?>
<div class="wrap">
    <h1>Users to Campaign Monitor</h1>
    <form method="post" action="options.php">
        <?php settings_fields('utcm_options_group'); ?>
        <table class="form-table">
            <tbody>
                <tr>
                    <th>
                        <label for="utcm_list_id">
                            List ID
                        </label>
                    </th>
                    <td>
                        <input type="text" id="utcm_list_id" name="utcm_list_id" value="<?php echo get_option('utcm_list_id'); ?>" class="regular-text">
                        <p class="description">This is the "API Subscriber List ID" within the list edit page.</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
