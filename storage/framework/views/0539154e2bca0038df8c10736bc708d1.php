<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Posts</h1>
    <!-- Scrollable container -->
    <div class="scrollable-posts" style="max-height: 70vh; overflow-y: auto; padding-right: 15px;">
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-4">
                <div class="card-body">
                    <!-- User Info Section -->
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?php echo e(asset('storage/default-profile.jpg')); ?>"
                             class="rounded-circle"
                             alt="User Profile"
                             width="50" height="50">
                        <div class="ms-3">
                            <h6 class="mb-0"><?php echo e($post->user->name ?? 'Anonymous'); ?></h6>
                            <small class="text-muted"><?php echo e($post->created_at->diffForHumans()); ?></small>
                        </div>
                    </div>

                    <!-- Post Content Section -->
                    <p class="mb-3"><?php echo e($post->body); ?></p>

                    <?php if($post->image): ?>
                        <div class="mb-3">
                            <img src="<?php echo e(asset('storage/' . $post->image)); ?>"
                                 class="img-fluid rounded"
                                 alt="<?php echo e($post->title); ?>">
                        </div>
                    <?php endif; ?>

                    <!-- Like and Comment Actions -->
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-light">
                            <i class="bi bi-hand-thumbs-up"></i> Like
                        </button>
                        <button class="btn btn-light">
                            <i class="bi bi-chat-left-text"></i> Comment
                        </button>
                        <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Caloy\Documents\GitHub\dashboard\resources\views/posts/index.blade.php ENDPATH**/ ?>