<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-auto-dismiss">
        <strong>Please fix the following:</strong>
        <ul class="mb-0 mt-2 ps-3">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\portfolio-cms\resources\views/components/validation-errors.blade.php ENDPATH**/ ?>