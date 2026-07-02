<?php
/**
 * Comments Template — Styled comment list and reply form.
 *
 * @package DanialPortfolio
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title text-2xl font-black text-white tracking-tighter mb-8">
			<?php
			$comment_count = get_comments_number();
			printf(
				 esc_html( _nx( '%1$s دیدگاه به &ldquo;%2$s&rdquo;', '%1$s دیدگاه به &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'devportfolio' ) ),
				number_format_i18n( $comment_count ),
				'<span>' . wp_kses_post( get_the_title() ) . '</span>'
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments( [
				'style'      => 'ol',
			'short_ping'  => true,
			'avatar_size' => 40,
			] );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comments-nav" class="comments-nav flex justify-between items-center mt-8 pt-8 border-t border-border">
				<?php previous_comments_link( '<span class="text-[10px] font-bold uppercase tracking-widest text-primary">&larr; دیدگاه قبلی</span>' ); ?>
				<?php next_comments_link( '<span class="text-[10px] font-bold uppercase tracking-widest text-primary">دیدگاه بعدی &rarr;</span>' ); ?>
			</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments text-zinc-500 text-sm mt-8"><?php esc_html_e( 'دیدگاه‌ها بسته شده‌اند.', 'devportfolio' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form( [
		'title_reply'        => esc_html__( 'دیدگاه بگذارید', 'devportfolio' ),
		'title_reply_before' => '<div id="respond" class="comment-respond mt-12 pt-8 border-t border-border"><h3 id="reply-title" class="comment-reply-title text-xl font-black text-white tracking-tighter mb-6">',
		'title_reply_after'  => '</h3>',
		'cancel_reply_before'=> ' <small>',
		'cancel_reply_after' => '</small>',
		'comment_notes_after'=> '',
		'fields'             => [
			'author' => '<div class="mb-4"><label for="author" class="block text-[10px] font-bold uppercase tracking-widest text-zinc-500 mb-2">' . esc_html__( 'نام', 'devportfolio' ) . ' *</label><input id="author" name="author" type="text" class="w-full px-4 py-3 bg-surface-darkest border border-border rounded-sm text-white text-sm focus:border-primary outline-none transition-colors" required /></div>',
			'email'  => '<div class="mb-4"><label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-zinc-500 mb-2">' . esc_html__( 'ایمیل', 'devportfolio' ) . ' *</label><input id="email" name="email" type="email" class="w-full px-4 py-3 bg-surface-darkest border border-border rounded-sm text-white text-sm focus:border-primary outline-none transition-colors" required /></div>',
			'url'    => '<div class="mb-4"><label for="url" class="block text-[10px] font-bold uppercase tracking-widest text-zinc-500 mb-2">' . esc_html__( 'وبسایت', 'devportfolio' ) . '</label><input id="url" name="url" type="url" class="w-full px-4 py-3 bg-surface-darkest border border-border rounded-sm text-white text-sm focus:border-primary outline-none transition-colors" /></div>',
		],
		'comment_field'      => '<div class="mb-4"><label for="comment" class="block text-[10px] font-bold uppercase tracking-widest text-zinc-500 mb-2">' . esc_html__( 'دیدگاه', 'devportfolio' ) . ' *</label><textarea id="comment" name="comment" class="w-full px-4 py-3 bg-surface-darkest border border-border rounded-sm text-white text-sm focus:border-primary outline-none transition-colors resize-none" rows="5" required></textarea></div>',
		'submit_button'      => '<div class="mt-4"><input name="%1$s" type="submit" id="%2$s" class="px-8 py-3 bg-primary text-surface text-[11px] font-black uppercase tracking-widest rounded-sm hover:opacity-90 transition-opacity cursor-pointer" value="%4$s" /></div>',
		'submit_field'       => '<div class="form-submit">%1$s %2$s</div>',
		'cancel_reply_link'  => esc_html__( 'لغو پاسخ', 'devportfolio' ),
	] );
	?>

</div>
