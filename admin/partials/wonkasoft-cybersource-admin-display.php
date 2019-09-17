<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @category   Cybersource
 * @package    Wonkasoft_Cybersource
 * @subpackage Wonkasoft_Cybersource/admin/partials
 * @author     Wonkasoft <support@wonkasoft.com>
 * @link       https://wonkasoft.com
 * @since      1.0.0
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="settings-wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form method="post" action="options.php"> 
		<?php settings_fields( 'cybersource-settings-group' ); ?>
		<?php
		do_settings_sections( 'cybersource-settings-group' );

			$options_init = new Wonkasoft_Cybersource_Admin( WONKASOFT_CYBERSOURCE_SLUG, WONKASOFT_CYBERSOURCE_VERSION );
		?>
		<table class="form-table">
			<tbody>
				<tr>
					<th colspan="2"><h2>Headers Data for API</h2></th>
				</tr>
				<tr>
					<th>
						<?php echo 'Merchant ID'; ?>
					</th>
					<td>
						<input type="text" name="_v_c_merchant_id" id ="_v_c_merchant_id" placeholder="Merchant ID*" value="<?php esc_attr( $options_init->the_cybersource_vc_merchant_id() ); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<?php echo 'Host'; ?>
					</th>
					<td>
						<input type="text" name="_host" id ="_host" placeholder="Host*" value="<?php esc_attr( $options_init->the_cybersource_host() ); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<?php echo 'Digest'; ?>
					</th>
					<td>
						<input type="text" name="_digest" id ="_digest" placeholder="Digest*" value="<?php esc_attr( $options_init->the_cybersource_digest() ); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<?php echo 'Signature'; ?>
					</th>
					<td>
						<input type="text" name="_signature" id ="_signature" placeholder="Signature*" value="<?php esc_attr( $options_init->the_cybersource_signature() ); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<?php echo 'Content-Type'; ?>
					</th>
					<td>
						<input type="text" name="_content_type" id ="_content_type" placeholder="Content-Type*" value="<?php esc_attr( $options_init->the_cybersource_content_type() ); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
		<?php submit_button(); ?>
	</form>
</div>
