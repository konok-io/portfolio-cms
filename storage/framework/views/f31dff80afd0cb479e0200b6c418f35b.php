

<?php $__env->startSection('title', 'Blog | ' . ($siteSetting->site_name ?? 'Portfolio CMS')); ?>
<?php $__env->startSection('meta_description', 'Articles and tutorials on web development, Laravel, and more.'); ?>

<?php $__env->startSection('content'); ?>

<section class="section-padding section-alt" style="padding-top: 8rem;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-eyebrow">Blog</span>
            <h1 class="section-title">Latest Articles &amp; Insights</h1>
            <p class="section-subtitle mx-auto">Thoughts on web development, Laravel, and building better software.</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-8">
                <?php if($blogs->isEmpty()): ?>
                    <div class="text-center py-5">
                        <i class="fa-solid fa-newspaper fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No articles found.</p>
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <div class="blog-card h-100">
                                    <div class="blog-img-wrap">
                                        <img src="<?php echo e($blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title)); ?>" alt="<?php echo e($blog->title); ?>">
                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between small text-muted mb-2">
                                            <?php if($blog->category): ?>
                                                <span class="text-accent-custom fw-semibold"><?php echo e($blog->category->name); ?></span>
                                            <?php endif; ?>
                                            <span><?php echo e($blog->published_at?->format('M d, Y')); ?></span>
                                        </div>
                                        <h6 class="mb-2"><a href="<?php echo e(route('blog.show', $blog->slug)); ?>" class="text-decoration-none text-dark"><?php echo e($blog->title); ?></a></h6>
                                        <p class="text-muted small"><?php echo e($blog->short_description); ?></p>
                                        <a href="<?php echo e(route('blog.show', $blog->slug)); ?>" class="small text-primary-custom fw-semibold">
                                            Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="mt-5 d-flex justify-content-center">
                        <?php echo e($blogs->links()); ?>

                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <div class="p-4 rounded-4 border shadow-sm bg-white mb-4">
                    <h6 class="mb-3">Search</h6>
                    <form action="<?php echo e(route('blog.index')); ?>" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="Search articles..." value="<?php echo e(request('search')); ?>">
                        <button type="submit" class="btn btn-primary-custom"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>

                <?php if($categories->isNotEmpty()): ?>
                    <div class="p-4 rounded-4 border shadow-sm bg-white">
                        <h6 class="mb-3">Categories</h6>
                        <ul class="list-unstyled mb-0">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="mb-2">
                                    <a href="<?php echo e(route('blog.index', ['category' => $category->slug])); ?>"
                                       class="d-flex justify-content-between text-decoration-none <?php echo e(request('category') === $category->slug ? 'text-primary-custom fw-semibold' : 'text-dark'); ?>">
                                        <span><i class="fa-solid fa-chevron-right me-2 small"></i><?php echo e($category->name); ?></span>
                                        <span class="text-muted small"><?php echo e($category->blogs()->where('status', 'published')->count()); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\portfolio-cms\resources\views/front/blog/index.blade.php ENDPATH**/ ?>