<?php
/**
 * Template Name: Contact Me
 *
 * @package DevPortfolio
 */

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['contact_nonce'] ) && wp_verify_nonce( $_POST['contact_nonce'], 'devportfolio_contact_form' ) ) {
	$name    = sanitize_text_field( $_POST['name'] );
	$email   = sanitize_email( $_POST['email'] );
	$subject = sanitize_text_field( $_POST['subject'] );
	$message = sanitize_textarea_field( $_POST['message'] );

	if ( ! empty( $name ) && is_email( $email ) && ! empty( $message ) ) {
		// Save to CPT
		$post_id = wp_insert_post( array(
			'post_title'   => $subject ? $subject : "Message from $name",
			'post_content' => "Name: $name\nEmail: $email\n\nMessage:\n$message",
			'post_status'  => 'publish',
			'post_type'    => 'contact_messages',
		) );

		if ( $post_id ) {
			// Send Email
			$admin_email = get_option( 'admin_email' );
			$headers = array( 'Content-Type: text/html; charset=UTF-8', "Reply-To: $name <$email>" );
			$body = "<h2>New Contact Message</h2><p><strong>Name:</strong> $name</p><p><strong>Email:</strong> $email</p><p><strong>Subject:</strong> $subject</p><p><strong>Message:</strong><br>$message</p>";
			wp_mail( $admin_email, 'New Contact Message: ' . $subject, $body, $headers );

			$success = __( 'Your message has been sent successfully.', 'devportfolio' );
		} else {
			$error = __( 'There was an error saving your message. Please try again.', 'devportfolio' );
		}
	} else {
		$error = __( 'Please fill in all required fields.', 'devportfolio' );
	}
}

get_header(); ?>

<main class="py-32 grid-pattern relative">
	<div class="container mx-auto px-6 relative z-10">
		<div class="max-w-5xl mx-auto">
			<header class="mb-20">
				<h1 class="text-6xl md:text-8xl font-black mb-10 tracking-tighter text-zinc-900 dark:text-white uppercase"><?php esc_html_e( 'Contact', 'devportfolio' ); ?></h1>
				<p class="text-xl text-zinc-600 dark:text-zinc-500 font-medium leading-relaxed max-w-2xl"><?php esc_html_e( 'Let\'s discuss your next project or technical challenge.', 'devportfolio' ); ?></p>
			</header>

			<div class="grid grid-cols-1 lg:grid-cols-12 gap-24">
				<div class="lg:col-span-7">
					<?php if ( isset( $success ) ) : ?>
						<div class="p-6 mb-10 bg-accent/10 border border-accent/20 text-accent font-bold rounded-2xl">
							<?php echo esc_html( $success ); ?>
						</div>
					<?php endif; ?>

					<?php if ( isset( $error ) ) : ?>
						<div class="p-6 mb-10 bg-red-500/10 border border-red-500/20 text-red-500 font-bold rounded-2xl">
							<?php echo esc_html( $error ); ?>
						</div>
					<?php endif; ?>

					<form method="POST" class="space-y-8">
						<?php wp_nonce_field( 'devportfolio_contact_form', 'contact_nonce' ); ?>
						<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
							<div class="space-y-3">
								<label class="text-[10px] font-black uppercase tracking-widest text-zinc-400 dark:text-zinc-600"><?php esc_html_e( 'Full Name', 'devportfolio' ); ?></label>
								<input type="text" name="name" required class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 p-6 rounded-2xl focus:border-primary outline-none transition-all text-zinc-900 dark:text-white">
							</div>
							<div class="space-y-3">
								<label class="text-[10px] font-black uppercase tracking-widest text-zinc-400 dark:text-zinc-600"><?php esc_html_e( 'Email Address', 'devportfolio' ); ?></label>
								<input type="email" name="email" required class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 p-6 rounded-2xl focus:border-primary outline-none transition-all text-zinc-900 dark:text-white">
							</div>
						</div>
						<div class="space-y-3">
							<label class="text-[10px] font-black uppercase tracking-widest text-zinc-400 dark:text-zinc-600"><?php esc_html_e( 'Subject', 'devportfolio' ); ?></label>
							<input type="text" name="subject" class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 p-6 rounded-2xl focus:border-primary outline-none transition-all text-zinc-900 dark:text-white">
						</div>
						<div class="space-y-3">
							<label class="text-[10px] font-black uppercase tracking-widest text-zinc-400 dark:text-zinc-600"><?php esc_html_e( 'Message', 'devportfolio' ); ?></label>
							<textarea name="message" rows="6" required class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 p-6 rounded-2xl focus:border-primary outline-none transition-all text-zinc-900 dark:text-white"></textarea>
						</div>
						<button type="submit" class="inline-flex items-center gap-4 py-6 px-12 bg-primary text-white font-black text-xs uppercase tracking-[0.3em] rounded-2xl hover:bg-primary-dark transition-all">
							<?php esc_html_e( 'Transmit Message', 'devportfolio' ); ?>
							<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
						</button>
					</form>
				</div>

				<aside class="lg:col-span-5">
					<div class="p-12 bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 rounded-[40px] space-y-12">
						<?php
						$options = get_option( 'devportfolio_settings' );
						$email = $options['contact_email'] ?? '';
						$phone = $options['contact_phone'] ?? '';
						?>

						<div>
							<h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-zinc-400 dark:text-zinc-600 mb-6"><?php esc_html_e( 'Direct Channels', 'devportfolio' ); ?></h3>
							<div class="space-y-6">
								<?php if ( $email ) : ?>
									<div class="flex items-center gap-6 group">
										<div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-950 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
											<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
										</div>
										<span class="text-lg font-bold text-zinc-900 dark:text-white"><?php echo esc_html( $email ); ?></span>
									</div>
								<?php endif; ?>

								<?php if ( $phone ) : ?>
									<div class="flex items-center gap-6 group">
										<div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-950 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
											<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
										</div>
										<span class="text-lg font-bold text-zinc-900 dark:text-white"><?php echo esc_html( $phone ); ?></span>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<div class="pt-12 border-t border-zinc-100 dark:border-zinc-900">
							<h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-zinc-400 dark:text-zinc-600 mb-6"><?php esc_html_e( 'Social Matrix', 'devportfolio' ); ?></h3>
							<div class="flex gap-4">
								<?php if ( ! empty( $options['github_url'] ) ) : ?>
									<a href="<?php echo esc_url( $options['github_url'] ); ?>" class="w-12 h-12 bg-zinc-900 dark:bg-zinc-800 text-white rounded-xl flex items-center justify-center hover:bg-primary transition-all">
										<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
									</a>
								<?php endif; ?>
								<?php if ( ! empty( $options['linkedin_url'] ) ) : ?>
									<a href="<?php echo esc_url( $options['linkedin_url'] ); ?>" class="w-12 h-12 bg-[#0077b5] text-white rounded-xl flex items-center justify-center hover:bg-primary transition-all">
										<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
