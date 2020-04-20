<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container-fluid">
    <?php flash('post_message'); ?>
    <div class="row">
        <div class="col">
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="50%">
                <h2>East Coast</h2>
                <thead>
                    <tr>
                        <th class="th-sm">Name
                        </th>
                        <th class="th-sm">Pushups
                        </th>
                        <th class="th-sm">Situps
                        </th>
                        <th class="th-sm">Run Miles
                        </th>
                        <th class="th-sm">Bike Miles
                        </th>
                        <th class="th-sm">Total Score
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tommy Flynn</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                    <tr>
                        <td>Anne Flynn</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                        <td>$170,750</td>
                    </tr>
                    <tr>
                        <td>Ben Porter</td>
                        <td>Junior Technical Author</td>
                        <td>San Francisco</td>
                        <td>66</td>
                        <td>2009/01/12</td>
                        <td>$86,000</td>
                    </tr>
                    <tr>
                        <td>JP DePaso</td>
                        <td>Senior Javascript Developer</td>
                        <td>Edinburgh</td>
                        <td>22</td>
                        <td>2012/03/29</td>
                        <td>$433,060</td>
                    </tr>
                    <tr>
                        <td>Bari Betil</td>
                        <td>Senior Javascript Developer</td>
                        <td>Edinburgh</td>
                        <td>22</td>
                        <td>2012/03/29</td>
                        <td>$433,060</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total
                        </th>
                        <th>
                            x
                        </th>
                        <th>
                            x
                        </th>
                        <th>
                            x
                        </th>
                        <th>
                            x
                        </th>
                        <th>
                            x
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col">
            <div>
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="50%">
                    <h2>West Coast</h2>
                    <thead>
                        <tr>
                            <th class="th-sm">Name
                            </th>
                            <th class="th-sm">Pushups
                            </th>
                            <th class="th-sm">Situps
                            </th>
                            <th class="th-sm">Run Miles
                            </th>
                            <th class="th-sm">Bike Miles
                            </th>
                            <th class="th-sm">Total Score
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Patrick Flynn</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Mark Steidler</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Emily Thornton</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>DJ Pina</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Paul Trigeiro</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total
                            </th>
                            <th>
                                x
                            </th>
                            <th>
                                x
                            </th>
                            <th>
                                x
                            </th>
                            <th>
                                x
                            </th>
                            <th>
                                x
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

    <br>

    <!-- And here I will have the recent workouts being posted.  -->
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
</div>

<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>