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
        <div class="card">
            <div class="card-body p-0">
                <h5 class="notes-header my-4">Activity Today</h5>
                <div class="content" style="max-height: 250px; overflow-y: auto;">
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
                                            <div class="row justify-content-center">
                                                <div class="col-xl-8">
                                                    <a title="Mark as done" href="<?= site_url('activity-done/' . $t->activity_id) ?>" class="btn btn-warning btn-block">Mark as done</a>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <div class="row justify-content-center">
                                                <button title="Detail Activity" class="btn btn-success show-activity" data-toggle="modal" data-target="#show-activity" data-activity="<?= $t->activity_id; ?>">Detail</button>
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
</div>

<div class="row mt-4">
    <div class="col">
        <div class="card">
            <div class="card-body p-0">
                <h5 class="notes-header my-4">Routines Today</h5>
                <div class="content" style="max-height: 250px; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table" id="list-notes">
                            <thead>
                                <tr>
                                    <th style="width: 50px">#</th>
                                    <th style="max-width: 150px">Activity</th>
                                    <th style="min-width: 300px;">Description</th>
                                    <th style="min-width: 100px;">Time Activity</th>
                                </tr>
                            </thead>
                            <?php if (!$routines) { ?>
                                <tr>
                                    <td colspan="5">
                                        <h3 class="text-center mt-3">You don't have any routine activity</h3>
                                        <div class="row justify-content-center">
                                            <a href="<?= route_to('routine') ?>" class="btn btn-primary">Set Now !</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php
                            $i = 1
                            ?>
                            <?php foreach ($routines as $data) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $data->title ?></td>
                                    <td><?= $data->description ?></td>
                                    <td><?= date('h:i a', strtotime($data->time)) ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Activity Detail-->
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
</script>

<?= $this->endSection(); ?>