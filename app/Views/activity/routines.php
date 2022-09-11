<?= $this->extend("layouts/user"); ?>
<?= $this->section("content"); ?>
<div class="row">
    <div class="col">
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
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
        <form action="<?= route_to('routine.create') ?>" method="POST">
            <div class="col-lg-9 p-0">
                <div class="form-group">
                    <label class="text-dark"><strong>Activity</strong></label>
                    <input type="text" name="title" class="form-control" placeholder="e.g Reading" value="<?= set_value('title') ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="text-dark"><strong>Description</strong></label>
                        <textarea class="form-control" rows="10" name="description" placeholder="e.g Reading novel 10 pages"><?= set_value('description') ?></textarea>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="text-dark"><strong>Time Activity</strong></label>
                        <input type="time" name="time" class="form-control" value="<?= set_value('time') ?>">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk mr-1"></i> Save</button>
        </form>
    </div>
</div>
<div class="row my-5">
    <div class="col">
        <div class="card">
            <div class="card-header note">
                <h5 class="notes-header my-auto">My Routines</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table" id="list-notes">
                        <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th style="max-width: 150px">Activity</th>
                                <th style="min-width: 450px;">Description</th>
                                <th style="min-width: 100px;">Time Activity</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php if (!$routines) { ?>
                            <tr>
                                <td colspan="5">
                                    <h3 class="text-center mt-3">You don't have any routine activity</h3>
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
                                <td>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <a href="<?= site_url('routines/edit/' . $data->routine_id) ?>" class="btn btn-warning btn-block"><i class="fa-solid fa-pencil"></i></a>
                                        </div>
                                        <div class="col-xl-6">
                                            <a href="<?= site_url('routines/delete/' . $data->routine_id) ?>" class="btn btn-danger btn-block"><i class="fa-solid fa-close"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>