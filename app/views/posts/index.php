<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('post_message'); ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Recent Workouts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Add Workout
        </a>
    </div>
</div>
<?php foreach ($data['posts'] as $post) : ?>
<div class="container">
    <div class="card card-body mb-3">
        <div class="container">
        <h4 class="card-title">
            <?php echo $post->name; ?>
        </h4>
    <table class="table table-striped table-dark">
    <thead class="thead-dark">
    <tr>
      <th scope="col">Pushups</th>
      <th scope="col">Situps</th>
      <th scope="col">Run Miles</th>
      <th scope="col">Bike Miles</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><?php echo $post->pushups; ?></td>
      <td><?php echo $post->situps; ?></td>
      <td><?php echo $post->run_miles; ?></td>
      <td><?php echo $post->bike_miles; ?></td>
    </tr>
    </tbody>
    </table>
        <div class="bg-light p-2 mb-3">
            <!-- written by username -->
            Posted on <?php echo $post->postCreated; ?>
        </div>
        <p class="card-text"><?php echo $post->body; ?></p>
        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postID; ?>" class="btn btn-dark"> More
        </a>
        </div>
    </div>
    </div>

<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>