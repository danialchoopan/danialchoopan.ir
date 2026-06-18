<section class="py-24 bg-surface-darkest">
    <div class="container mx-auto px-6">
        <div class="flex flex-col items-end mb-16 text-right rtl">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-4">خدمات ما</span>
            <h2 class="text-4xl md:text-5xl font-black text-white tracking-tighter">پکیج‌های تخصصی وب‌کد</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $packages = [
                [
                    'title' => 'Studio Live',
                    'desc' => 'مشاوره و کدنویسی زنده با تیم فنی برای حل چالش‌های پیچیده در لحظه.',
                    'tags' => ['CONSULTING', 'REALTIME'],
                    'icon' => '<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/>'
                ],
                [
                    'title' => 'Projects',
                    'desc' => 'اجرای پروژه‌های صفر تا صد وب و موبایل با بالاترین استانداردهای روز دنیا.',
                    'tags' => ['ENTERPRISE', 'FULLSTACK'],
                    'icon' => '<path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/>'
                ],
                [
                    'title' => 'Pro Corner',
                    'desc' => 'منتورینگ اختصاصی برای توسعه‌دهندگانی که می‌خواهند به سطح ارشد برسند.',
                    'tags' => ['COACHING', 'MENTORSHIP'],
                    'icon' => '<path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>'
                ],
                [
                    'title' => 'Assignment Helper',
                    'desc' => 'همیار فنی برای انجام پروژه‌های دانشگاهی و چالش‌های تخصصی استخدامی.',
                    'tags' => ['INTENSIVE', 'ACADEMIC'],
                    'icon' => '<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>'
                ]
            ];

            foreach ($packages as $pkg) : ?>
                <div class="group p-8 bg-surface border border-border hover:border-primary transition-all duration-500 text-right rtl">
                    <div class="w-12 h-12 bg-surface-high border border-border flex items-center justify-center mb-8 group-hover:bg-primary group-hover:text-surface transition-colors">
                        <svg class="w-6 h-6 text-primary group-hover:text-surface" fill="currentColor" viewBox="0 0 24 24">
                            <?php echo $pkg['icon']; ?>
                        </svg>
                    </div>

                    <h3 class="text-2xl font-black text-white mb-4 tracking-tight"><?php echo $pkg['title']; ?></h3>
                    <p class="text-zinc-500 text-sm leading-relaxed mb-8">
                        <?php echo $pkg['desc']; ?>
                    </p>

                    <div class="flex flex-wrap gap-2 justify-end">
                        <?php foreach ($pkg['tags'] as $tag) : ?>
                            <span class="px-2 py-1 border border-border text-[8px] font-bold text-zinc-600 uppercase tracking-widest group-hover:border-primary/30 group-hover:text-primary transition-colors">
                                <?php echo $tag; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
