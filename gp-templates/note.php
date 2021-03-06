<?php
/**
 * Template for the single note side by the editor
 *
 * @package    GlotPress
 * @subpackage Templates
 */

$can_edit = GP::$permission->current_user_can( 'admin', 'notes', $translation->id );
$note     = GP::$notes->get( $note->id );
?>
<div class="note">
	<?php gp_link_user( get_userdata( $note->user_id ) ); ?>
	<?php _e( 'Commented', 'glotpress' ); ?>
	<span class="date">
		<?php
			/* translators: How much time before was sent the note */
			echo esc_html( sprintf( __( '%s ago', 'glotpress' ), human_time_diff( strtotime( $note->date_added ), time() ) ) );
		?>
	</span>
	<?php if ( $can_edit || get_current_user_id() === (int) $note->user_id ) : ?>
		<button class="note-actions" ><?php _e( 'edit', 'glotpress' ); ?></button>
	<?php endif; ?>
	<div class="note-body">
		<?php echo make_clickable( nl2br( esc_html( $note->note ) ) ); // WPCS: XSS ok. ?>
	</div>
	<?php if ( $can_edit || get_current_user_id() === (int) $note->user_id ) : ?>
	<div class="note-body edit-note-body" style="display: none;">
		<textarea autocomplete="off" class="foreign-text" name="edit-note[<?php echo esc_attr( $note->id ); ?>]" id="edit-note-<?php echo esc_attr( $note->id ); ?>"><?php echo esc_html( $note->note ); ?></textarea>
		<button class="update-note" tabindex="-1" data-note-id="<?php echo esc_attr( $note->id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'edit-note-' . $note->id ) ); ?>">
			<?php esc_attr_e( 'Update Note', 'glotpress' ); ?>
		</button>
		<button class="update-cancel" tabindex="-1">
			<?php esc_attr_e( 'Cancel', 'glotpress' ); ?>
		</button>
		<button class="delete-note" tabindex="-1" data-note-id="<?php echo esc_attr( $note->id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'delete-note-' . $note->id ) ); ?>">
			<?php esc_attr_e( 'Delete', 'glotpress' ); ?>
		</button>
	</div>
	<?php endif; ?>
</div>
