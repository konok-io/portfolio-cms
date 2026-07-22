

<?php $__env->startSection('title', 'Resume Builder - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-3">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <i class="fa-solid fa-file-pdf me-2 text-primary"></i>
                Resume Builder
            </h1>
            <div class="btn-group">
                <a href="<?php echo e(route('admin.resume.preview')); ?>" target="_blank" class="btn btn-outline-primary">
                    <i class="fa-solid fa-eye me-2"></i>Preview
                </a>
                <a href="<?php echo e(route('admin.resume.download')); ?>" class="btn btn-success">
                    <i class="fa-solid fa-download me-2"></i>Download PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Template Preview - Full Width -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body p-2">
            <div class="template-preview">
                <div class="templates-row">
                    <div class="template-box modern <?php echo e($settings->template === 'modern' ? 'selected' : ''); ?>" data-template="modern">
                        <i class="fa-solid fa-file-lines"></i>
                        <span>Modern</span>
                    </div>
                    <div class="template-box creative <?php echo e($settings->template === 'creative' ? 'selected' : ''); ?>" data-template="creative">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        <span>Creative</span>
                    </div>
                    <div class="template-box tech <?php echo e($settings->template === 'tech' ? 'selected' : ''); ?>" data-template="tech">
                        <i class="fa-solid fa-microchip"></i>
                        <span>Tech</span>
                    </div>
                    <div class="template-box corporate <?php echo e($settings->template === 'corporate' ? 'selected' : ''); ?>" data-template="corporate">
                        <i class="fa-solid fa-building"></i>
                        <span>Corporate</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="<?php echo e(route('admin.resume.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="row g-3">
            <!-- Template Settings -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-2">
                        <h6 class="mb-0">
                            <i class="fa-solid fa-palette me-2 text-primary"></i>
                            Template Settings
                        </h6>
                    </div>
                    <div class="card-body pt-2">
                        <div class="mb-2">
                            <label for="template" class="form-label small">CV Template</label>
                            <select class="form-select form-select-sm <?php $__errorArgs = ['template'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="template" name="template">
                                <option value="modern" <?php echo e(old('template', $settings->template) == 'modern' ? 'selected' : ''); ?>>Modern</option>
                                <option value="creative" <?php echo e(old('template', $settings->template) == 'creative' ? 'selected' : ''); ?>>Creative</option>
                                <option value="tech" <?php echo e(old('template', $settings->template) == 'tech' ? 'selected' : ''); ?>>Tech</option>
                                <option value="corporate" <?php echo e(old('template', $settings->template) == 'corporate' ? 'selected' : ''); ?>>Corporate</option>
                            </select>
                            <?php $__errorArgs = ['template'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Row 1: Primary + Heading Color -->
                        <div class="row g-2">
                            <div class="col-6">
                                <label for="primary_color" class="form-label small">Primary Color (Accent)</label>
                                <div class="d-flex gap-1">
                                    <input type="color" class="form-control form-control-color form-control-sm" 
                                           id="primary_color" name="primary_color" 
                                           value="<?php echo e(old('primary_color', $settings->primary_color)); ?>">
                                    <input type="text" class="form-control form-control-sm" 
                                           value="<?php echo e(old('primary_color', $settings->primary_color)); ?>"
                                           pattern="^#[0-9A-Fa-f]{6}$">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="heading_color" class="form-label small">Heading Color</label>
                                <div class="d-flex gap-1">
                                    <input type="color" class="form-control form-control-color form-control-sm" 
                                           id="heading_color" name="heading_color" 
                                           value="<?php echo e(old('heading_color', $settings->heading_color ?? '#1a1a2e')); ?>">
                                    <input type="text" class="form-control form-control-sm" 
                                           value="<?php echo e(old('heading_color', $settings->heading_color ?? '#1a1a2e')); ?>"
                                           pattern="^#[0-9A-Fa-f]{6}$">
                                </div>
                            </div>
                        </div>

                        <!-- Row 2: Header Text + Text Color -->
                        <div class="row g-2 mt-1">
                            <div class="col-6">
                                <label for="header_text_color" class="form-label small">Header Text Color</label>
                                <div class="d-flex gap-1">
                                    <input type="color" class="form-control form-control-color form-control-sm" 
                                           id="header_text_color" name="header_text_color" 
                                           value="<?php echo e(old('header_text_color', $settings->header_text_color ?? '#ffffff')); ?>">
                                    <input type="text" class="form-control form-control-sm" 
                                           value="<?php echo e(old('header_text_color', $settings->header_text_color ?? '#ffffff')); ?>"
                                           pattern="^#[0-9A-Fa-f]{6}$">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="text_color" class="form-label small">Text Color</label>
                                <div class="d-flex gap-1">
                                    <input type="color" class="form-control form-control-color form-control-sm" 
                                           id="text_color" name="text_color" 
                                           value="<?php echo e(old('text_color', $settings->text_color ?? '#4a5568')); ?>">
                                    <input type="text" class="form-control form-control-sm" 
                                           value="<?php echo e(old('text_color', $settings->text_color ?? '#4a5568')); ?>"
                                           pattern="^#[0-9A-Fa-f]{6}$">
                                </div>
                            </div>
                        </div>

                        <!-- Row 3: Background + Header BG Color -->
                        <div class="row g-2 mt-1">
                            <div class="col-6">
                                <label for="background_color" class="form-label small">Background Color</label>
                                <div class="d-flex gap-1">
                                    <input type="color" class="form-control form-control-color form-control-sm" 
                                           id="background_color" name="background_color" 
                                           value="<?php echo e(old('background_color', $settings->background_color ?? '#ffffff')); ?>">
                                    <input type="text" class="form-control form-control-sm" 
                                           value="<?php echo e(old('background_color', $settings->background_color ?? '#ffffff')); ?>"
                                           pattern="^#[0-9A-Fa-f]{6}$">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="header_bg_color" class="form-label small">Header BG Color</label>
                                <div class="d-flex gap-1">
                                    <input type="color" class="form-control form-control-color form-control-sm" 
                                           id="header_bg_color" name="header_bg_color" 
                                           value="<?php echo e(old('header_bg_color', $settings->header_bg_color ?? '#1a1a2e')); ?>">
                                    <input type="text" class="form-control form-control-sm" 
                                           value="<?php echo e(old('header_bg_color', $settings->header_bg_color ?? '#1a1a2e')); ?>"
                                           pattern="^#[0-9A-Fa-f]{6}$">
                                </div>
                            </div>
                        </div>

                        <!-- Row 4: Footer BG + Footer Text Color -->
                        <div class="row g-2 mt-1">
                            <div class="col-6">
                                <label for="footer_bg_color" class="form-label small">Footer BG Color</label>
                                <div class="d-flex gap-1">
                                    <input type="color" class="form-control form-control-color form-control-sm" 
                                           id="footer_bg_color" name="footer_bg_color" 
                                           value="<?php echo e(old('footer_bg_color', $settings->footer_bg_color ?? '#1a1a2e')); ?>">
                                    <input type="text" class="form-control form-control-sm" 
                                           value="<?php echo e(old('footer_bg_color', $settings->footer_bg_color ?? '#1a1a2e')); ?>"
                                           pattern="^#[0-9A-Fa-f]{6}$">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="footer_text_color" class="form-label small">Footer Text Color</label>
                                <div class="d-flex gap-1">
                                    <input type="color" class="form-control form-control-color form-control-sm" 
                                           id="footer_text_color" name="footer_text_color" 
                                           value="<?php echo e(old('footer_text_color', $settings->footer_text_color ?? '#9ca3af')); ?>">
                                    <input type="text" class="form-control form-control-sm" 
                                           value="<?php echo e(old('footer_text_color', $settings->footer_text_color ?? '#9ca3af')); ?>"
                                           pattern="^#[0-9A-Fa-f]{6}$">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Settings -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">
                            <i class="fa-solid fa-list-check me-2 text-primary"></i>
                            Content Sections
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Select which sections to include in your resume:</p>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="include_photo" name="include_photo" value="1" 
                                   <?php echo e(old('include_photo', $settings->include_photo) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="include_photo">
                                <i class="fa-solid fa-user-circle me-2 text-primary"></i>Photo
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="include_skills" name="include_skills" value="1" 
                                   <?php echo e(old('include_skills', $settings->include_skills) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="include_skills">
                                <i class="fa-solid fa-star me-2 text-primary"></i>Skills
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="include_experience" name="include_experience" value="1" 
                                   <?php echo e(old('include_experience', $settings->include_experience) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="include_experience">
                                <i class="fa-solid fa-briefcase me-2 text-primary"></i>Work Experience
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="include_education" name="include_education" value="1" 
                                   <?php echo e(old('include_education', $settings->include_education) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="include_education">
                                <i class="fa-solid fa-graduation-cap me-2 text-primary"></i>Education
                            </label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="include_projects" name="include_projects" value="1" 
                                   <?php echo e(old('include_projects', $settings->include_projects) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="include_projects">
                                <i class="fa-solid fa-folder-open me-2 text-primary"></i>Projects
                            </label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="include_certifications" name="include_certifications" value="1" 
                                   <?php echo e(old('include_certifications', $settings->include_certifications) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="include_certifications">
                                <i class="fa-solid fa-certificate me-2 text-primary"></i>Certifications
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save me-2"></i>Save Settings
                            </button>
                            <a href="<?php echo e(route('admin.resume.preview')); ?>" target="_blank" class="btn btn-outline-primary">
                                <i class="fa-solid fa-eye me-2"></i>Preview Resume
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.template-preview {
    width: 100%;
}
.template-preview .templates-row {
    display: flex;
    flex-wrap: nowrap;
    justify-content: space-between;
    gap: 0.75rem;
}

.template-box {
    flex: 1;
    border: 2px solid #e2e8f0;
    border-radius: 6px;
    padding: 0.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    max-width: 150px;
}

.template-box:hover {
    border-color: #2563eb;
}

.template-box.selected {
    border-color: #2563eb;
    background: rgba(37, 99, 235, 0.08);
}

.template-box i {
    font-size: 1.5rem;
    margin-bottom: 0.25rem;
    color: #64748b;
    display: block;
}

.template-box.selected i {
    color: #2563eb;
}

.template-box span {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const template = document.getElementById('template');
    const templateBoxes = document.querySelectorAll('.template-box');
    
    template.addEventListener('change', function() {
        templateBoxes.forEach(box => {
            box.classList.toggle('selected', box.dataset.template === this.value);
        });
    });
    
    templateBoxes.forEach(box => {
        box.addEventListener('click', function() {
            template.value = this.dataset.template;
            templateBoxes.forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
    
    // Sync color picker with text input
    const colorPicker = document.getElementById('primary_color');
    const colorText = document.getElementById('primary_color_text');
    
    colorPicker.addEventListener('input', function() {
        colorText.value = this.value;
    });
    
    colorText.addEventListener('input', function() {
        if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
            colorPicker.value = this.value;
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\portfolio-cms\resources\views/admin/resume/index.blade.php ENDPATH**/ ?>