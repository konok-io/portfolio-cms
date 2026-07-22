<footer class="site-footer pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4">
                <h5 class="font-heading mb-3"><?php echo e($siteSetting->site_name ?? 'Portfolio'); ?></h5>
                <p class="small mb-3">Building thoughtful, modern web experiences — from idea to launch.</p>
                <div class="footer-social">
                    <?php if($siteSetting->facebook ?? false): ?>
                        <a href="<?php echo e($siteSetting->facebook); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if($siteSetting->twitter ?? false): ?>
                        <a href="<?php echo e($siteSetting->twitter); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter"></i></a>
                    <?php endif; ?>
                    <?php if($siteSetting->linkedin ?? false): ?>
                        <a href="<?php echo e($siteSetting->linkedin); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a>
                    <?php endif; ?>
                    <?php if($siteSetting->github ?? false): ?>
                        <a href="<?php echo e($siteSetting->github); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-github"></i></a>
                    <?php endif; ?>
                    <?php if($siteSetting->instagram ?? false): ?>
                        <a href="<?php echo e($siteSetting->instagram); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="<?php echo e(route('home')); ?>#about">About</a></li>
                    <li class="mb-2"><a href="<?php echo e(route('home')); ?>#services">Services</a></li>
                    <li class="mb-2"><a href="<?php echo e(route('projects.index')); ?>">Portfolio</a></li>
                    <li class="mb-2"><a href="<?php echo e(route('resume')); ?>">Resume</a></li>
                    <li class="mb-2"><a href="<?php echo e(route('blog.index')); ?>">Blog</a></li>
                    <li class="mb-2"><a href="<?php echo e(route('faq')); ?>">FAQ</a></li>
                    <li class="mb-2"><a href="<?php echo e(route('pricing')); ?>">Pricing</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <h5 class="mb-3">Contact</h5>
                <ul class="list-unstyled small">
                    <?php if($siteSetting->email ?? false): ?>
                        <li class="mb-2"><i class="fa-solid fa-envelope me-2"></i><?php echo e($siteSetting->email); ?></li>
                    <?php endif; ?>
                    <?php if($siteSetting->phone ?? false): ?>
                        <li class="mb-2"><i class="fa-solid fa-phone me-2"></i><?php echo e($siteSetting->phone); ?></li>
                    <?php endif; ?>
                    <?php if($siteSetting->address ?? false): ?>
                        <li class="mb-2"><i class="fa-solid fa-location-dot me-2"></i><?php echo e($siteSetting->address); ?></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4">
                <h5 class="mb-3">Newsletter</h5>
                <p class="small mb-3">Get notified about new projects and blog posts.</p>
                <?php if(session('newsletter_success')): ?>
                    <div class="alert alert-success py-2 px-3 small mb-2"><?php echo e(session('newsletter_success')); ?></div>
                <?php endif; ?>
                <form class="d-flex gap-2" action="<?php echo e(route('subscribe.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="email" name="email" class="form-control form-control-sm <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Your email" aria-label="Email" required>
                    <button class="btn btn-sm btn-primary-custom" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <hr class="border-secondary mt-4 mb-3" style="opacity: 0.15;">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small">
            <p class="mb-0">&copy; <?php echo e(date('Y')); ?> <?php echo e($siteSetting->site_name ?? 'Portfolio CMS'); ?>. All rights reserved.</p>
            <p class="mb-0">Built with Laravel</p>
        </div>
    </div>
</footer>
<?php /**PATH C:\laragon\www\portfolio-cms\resources\views/front/partials/footer.blade.php ENDPATH**/ ?>