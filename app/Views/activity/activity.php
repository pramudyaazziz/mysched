<?= $this->extend("layouts/user"); ?>
<?= $this->section("content"); ?>
<div class="row">
    <div class="col">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">x</button>
                    <?= session()->getFlashdata('success') ?>
                </div>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashdata('delete')) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">x</button>
                    <?= session()->getFlashdata('delete') ?>
                </div>
            </div>
        <?php endif ?>
        <form action="<?= route_to('activity.create') ?>" method="POST">
            <div class="col-lg-9 p-0">
                <div class="form-group">
                    <label class="text-dark"><strong>Activity</strong></label>
                    <input type="text" name="title" class="form-control <?= isset($validation) ? $validation->getError('title') ? 'is-invalid' : 'is-valid' : '' ?>" placeholder="e.g Meeting" value="<?= set_value('title') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($validation)) { ?>
                            <?= $validation->getError('title'); ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="text-dark"><strong>Description</strong></label>
                        <textarea class="form-control <?= isset($validation) ? $validation->getError('description') ? 'is-invalid' : 'is-valid' : '' ?>" rows="10" name="description" placeholder="e.g Meeting with my client in bathroom :}"><?= set_value('description') ?></textarea>
                        <div class="invalid-feedback">
                            <?php if (isset($validation)) { ?>
                                <?= $validation->getError('description'); ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="text-dark"><strong>Activity Plan</strong></label>
                        <input type="datetime-local" name="date_activity" class="form-control <?= isset($validation) ? $validation->getError('date_activity') ? 'is-invalid' : 'is-valid' : '' ?>" value="<?= set_value('time') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset($validation)) { ?>
                                <?= $validation->getError('date_activity'); ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk mr-1"></i> Save</button>
        </form>
    </div>
</div>
<h1 class="h3 text-dark mt-4">Activities</h1>
<div class="row mb-3">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5 class="notes-header">Today Activities</h5>
            </div>
            <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Activity</th>
                                <th style="width: 400px;">Description</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php if (!$today) { ?>
                            <tr>
                                <td colspan="6">
                                    <h4 class="text-center mt-3">You don't have any activity for today</h4>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php
                        $i = 1
                        ?>
                        <?php foreach ($today as $t) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $t->title; ?></td>
                                <td><?= $t->description; ?></td>
                                <td><?= date('h:i a', strtotime($t->date_activity)) ?></td>
                                <td>
                                    <?php if ($t->status == "0") : ?>
                                        <span class="badge badge-info">In Progress</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Completed</span>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if ($t->status == "0") : ?>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <a href="<?= site_url('activity/edit/' . $t->activity_id) ?>" class="btn btn-warning btn-block"><i class="fa-solid fa-pencil"></i></a>
                                            </div>
                                            <div class="col-xl-6">
                                                <a title="Delete activity" href="<?= site_url('activity-delete/' . $t->activity_id) ?>" class="btn btn-danger btn-block"><i class="fa-solid fa-close"></i></a>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="row justify-content-center">
                                            <button title="Detail Activity" class="btn btn-success show-activity" data-toggle="modal" data-target="#show-activity" data-activity="<?= $t->activity_id; ?>"><i class="fa-solid fa-eye"></i></button>
                                        </div>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="notes-header">Upcomming</h5>
            </div>
            <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Activity</th>
                                <th>Date Activity</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php if (!$upcomming) { ?>
                            <tr>
                                <td colspan="6">
                                    <h5 class="text-center mt-3">You don't have any activity</h5>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php $i = 1;
                        foreach ($upcomming as $upcome) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $upcome->title; ?></td>
                                <td><?= date('Y-m-d h:i a', strtotime($upcome->date_activity)) ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <button title="Detail Activity" class="btn btn-success btn-block show-activity" data-toggle="modal" data-target="#show-activity" data-activity="<?= $upcome->activity_id; ?>"><i class="fa-solid fa-eye"></i></button>
                                        </div>
                                        <div class="col-xl-4">
                                            <a href="<?= site_url('activity/edit/' . $upcome->activity_id) ?>" class="btn btn-warning btn-block"><i class="fa-solid fa-pencil"></i></a>
                                        </div>
                                        <div class="col-xl-4">
                                            <a href="<?= site_url('activity-delete/' . $upcome->activity_id) ?>" class="btn btn-danger btn-block"><i class="fa-solid fa-close"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="notes-header">Previous Activity <i class="fa-solid fa-circle-info float-right" style="font-size: 24px;" data-toggle="popover" data-placement="left" data-content="Only Last 3 Days Activity" data-trigger="hover"></i></h5>
            </div>
            <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Activity</th>
                                <th>Date Activity</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php if (!$previous) { ?>
                            <tr>
                                <td colspan="6">
                                    <h5 class="text-center mt-3">You don't have any previous activity</h5>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php $i = 1;
                        foreach ($previous as $prev) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $prev->title ?></td>
                                <td><?= date('Y-m-d h:i a', strtotime($prev->date_activity)) ?></td>
                                <td>
                                    <?php if ($prev->status == "0") : ?>
                                        <span class="badge badge-danger">Unfinished</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Completed</span>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <button title="Detail Activity" class="btn btn-success show-activity-prev" data-toggle="modal" data-target="#show-activity" data-activity="<?= $prev->activity_id; ?>"><i class="fa-solid fa-eye"></i></button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal section -->

<!-- Modal -->
<div class="modal fade" id="show-activity" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="show-activityLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="show-activityLabel">Activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body content-activity">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(".show-activity").on('click', function() {
        let id = $(this).data("activity");
        $.ajax({
            url: `<?= site_url('activity/') ?> ${id}`,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('.content-activity').html(data);
                // console.log(data);
            },
            error: function(msg) {
                alert(`Error: ${msg}`)
            }
        })
    })

    $(".show-activity-prev").on('click', function() {
        let id = $(this).data("activity");
        $.ajax({
            url: `<?= site_url('activity-prev/') ?> ${id}`,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('.content-activity').html(data);
                // console.log(data);
            },
            error: function(msg) {
                alert(`Error: ${msg}`)
            }
        })
    })
</script>
<?= $this->endSection(); ?>