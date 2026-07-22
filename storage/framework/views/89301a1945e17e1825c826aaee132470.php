

<?php $__env->startSection('title', ($blog->meta_title ?: $blog->title) . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS')); ?>
<?php $__env->startSection('meta_description', $blog->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($blog->description), 160)); ?>
<?php $__env->startSection('meta_keywords', $blog->meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <?php if($blog->category): ?>
                        <span class="section-eyebrow"><?php echo e($blog->category->name); ?></span>
                    <?php endif; ?>
                    <h1 class="section-title"><?php echo e($blog->title); ?></h1>
                    <div class="d-flex gap-4 small text-muted mt-3">
                        <span><i class="fa-solid fa-user me-1"></i><?php echo e($blog->author->name ?? 'Admin'); ?></span>
                        <span><i class="fa-regular fa-calendar me-1"></i><?php echo e($blog->published_at?->format('M d, Y')); ?></span>
                        <span><i class="fa-regular fa-eye me-1"></i><?php echo e($blog->views); ?> views</span>
                    </div>
                </div>

                <img src="<?php echo e($blog->featured_image_url ?? 'https://placehold.co/1000x600/0F172A/ffffff?text=' . urlencode($blog->title)); ?>"
                     alt="<?php echo e($blog->title); ?>" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="aspect-ratio: 16/9; object-fit: cover;">

                <article class="content-body">
                    <?php echo $blog->description; ?>

                </article>

                
                <div class="share-section mt-4 pt-4 border-top">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <h6 class="mb-1 share-title">Share this article</h6>
                            <p class="text-muted small mb-0">If you found this helpful, share it with your network</p>
                        </div>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->url())); ?>" target="_blank" class="share-btn facebook" title="Share on Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(request()->url())); ?>&text=<?php echo e(urlencode($blog->title)); ?>" target="_blank" class="share-btn twitter" title="Share on Twitter">
                                <i class="fa-brands fa-x-twitter"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo e(urlencode(request()->url())); ?>&title=<?php echo e(urlencode($blog->title)); ?>" target="_blank" class="share-btn linkedin" title="Share on LinkedIn">
                                <i class="fa-brands fa-linkedin-in"></i>
                                <span>LinkedIn</span>
                            </a>
                            <a href="https://wa.me/?text=<?php echo e(urlencode($blog->title . ' ' . request()->url())); ?>" target="_blank" class="share-btn whatsapp" title="Share on WhatsApp">
                                <i class="fa-brands fa-whatsapp"></i>
                                <span>WhatsApp</span>
                            </a>
                            <button onclick="copyLink()" class="share-btn copy-link" title="Copy Link">
                                <i class="fa-solid fa-link"></i>
                                <span>Copy</span>
                            </button>
                        </div>
                    </div>
                </div>

                <?php if($relatedBlogs->isNotEmpty()): ?>
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="mb-4">Related Articles</h5>
                        <div class="row g-4">
                            <?php $__currentLoopData = $relatedBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4">
                                    <div class="blog-card h-100">
                                        <div class="blog-img-wrap">
                                            <img src="<?php echo e($related->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($related->title)); ?>" alt="<?php echo e($related->title); ?>">
                                        </div>
                                        <div class="p-3">
                                            <h6 class="mb-2"><a href="<?php echo e(route('blog.show', $related->slug)); ?>" class="text-decoration-none text-dark"><?php echo e($related->title); ?></a></h6>
                                            <a href="<?php echo e(route('blog.show', $related->slug)); ?>" class="small text-primary-custom fw-semibold">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <div class="p-4 rounded-4 border shadow-sm sticky-top" style="top: 100px;">
                    <h6 class="mb-3">About the Author</h6>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="<?php echo e($blog->author->avatar_url ?? 'https://ui-avatars.com/api/?name=Admin&background=2563EB&color=fff'); ?>" alt="Author" width="56" height="56" class="rounded-circle object-fit-cover">
                        <div>
                            <h6 class="mb-0"><?php echo e($blog->author->name ?? 'Admin'); ?></h6>
                            <span class="small text-muted">Author</span>
                        </div>
                    </div>
                    <a href="<?php echo e(route('home')); ?>#contact" class="btn btn-primary-custom w-100">Get in Touch</a>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <a href="<?php echo e(route('blog.index')); ?>" class="btn btn-outline-custom">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to Blog
            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\portfolio-cms\resources\views/front/blog/show.blade.php ENDPATH**/ ?>