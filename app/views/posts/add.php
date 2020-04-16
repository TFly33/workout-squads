<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>
        Add Workout
    </h2>
    <br>
    <!-- <p> Create a post with this form</p> -->
    <form action="<?php echo URLROOT; ?>/posts/add" method="post">
        <!-- pushups here -->
        <div class="form-group">
            <label for="pushups"> Pushups</label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="pushups" class="form-control form-control-lg" value="<?php echo $data['pushups']; ?>">
        </div>
        <div class="form-group">
            <label for="situps"> Situps</label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="situps" class="form-control form-control-lg" value="<?php echo $data['situps']; ?>">
        </div>
        <div class="form-group">
            <label for="run_miles"> Run Miles</label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="run_miles" class="form-control form-control-lg" value="<?php echo $data['run_miles']; ?>">
        </div>
        <div class="form-group">
            <label for="bike_miles"> Bike Miles</label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" name="bike_miles" class="form-control form-control-lg" value="<?php echo $data['bike_miles']; ?>">
        </div>
        <!-- leaving a note option, but it'll be optional, not required. -->
        <div class="form-group">
            <label for="body"> Notes </label>
            <!-- I still want the body_err to apply here. -->
            <textarea name="body" class="form-control 
            form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['body']; ?>">  </textarea>
        </div>
        <input type="submit" class="btn btn-success" value="Submit">
    </form>
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>