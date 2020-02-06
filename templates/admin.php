<?php defined('ABSPATH') || exit; ?>
<div class="wrap">
    <h1>
        <?php _e('Users to Campaign Monitor', 'utcm'); ?>
    </h1>
    <form method="post" action="options.php">
        <?php settings_fields('utcm_options_group'); ?>
        <table class="form-table">
            <tbody>
                <tr>
                    <th>
                        <label for="utcm_username">
                            <?php _e('Username', 'utcm'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="password" id="utcm_username" name="utcm_username" value="<?php echo get_option('utcm_username'); ?>" class="regular-text">
                        <p class="description">
                            <?php _e('This is the "Client API key" within the "Manage API Keys" section in Campaign Monitor.', 'utcm'); ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="utcm_list_id">
                            <?php _e('List ID', 'utcm'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" id="utcm_list_id" name="utcm_list_id" value="<?php echo get_option('utcm_list_id'); ?>" class="regular-text">
                        <p class="description">
                            <?php _e('This is the "API Subscriber List ID" within the list edit page.', 'utcm'); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
