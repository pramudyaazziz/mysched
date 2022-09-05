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
        <form action="<?= route_to('notepad.create') ?>" method="POST">
            <div class="col-lg-9 p-0">
                <div class="form-group">
                    <input type="text" name="note_title" class="form-control note-title" placeholder="Note Title">
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control note-content" name="note_content" id="summernote" placeholder="Note Content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk mr-1"></i> Save</button>
        </form>
    </div>
</div>
<hr class="my-5">
<div class="row mt-3">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header note">
                <h5 class="notes-header my-auto">My Saved Notes</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th style="width: 250px">Title</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($notes) == 0) : ?>
                                <tr>
                                    <td colspan="3">
                                        <h4 class="text-center mt-4">You don't have any notes</h4>
                                    </td>
                                </tr>
                            <?php else : ?>
                                <?php
                                $i = 0;
                                foreach ($notes as $n) {
                                    ++$i;
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $n->note_title ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <a href="<?= site_url('/notepad/detail/' . $n->note_id) ?>" class="btn btn-success btn-block"><i class="fa-solid fa-eye"></i></a>
                                                </div>
                                                <div class="col-xl-6">
                                                    <button href="<?= site_url('/notepad/delete/' . $n->note_id) ?>" class="btn btn-danger btn-block"><i class="fa-solid fa-close"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7" id="detail-notes">
        <div class="card">
            <div class="card-header note">
                <h5 class="notes-header my-auto">Note Detail</h5>
            </div>
            <div class="card-body">
                <div>
                    <label for="" class=""><strong>Akun ku bang</strong></label>
                </div>
                <hr>
                <div>
                    <div class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo quasi asperiores quidem labore, facilis nobis, quo adipisci doloremque delectus aut, distinctio vero laboriosam sequi beatae aspernatur cumque eaque. Consectetur possimus aperiam rerum, similique consequatur amet blanditiis ducimus eligendi, praesentium beatae fugit tempore tempora tenetur laborum!</div>
                </div>
            </div>
            <div class="card-footer">
                <a href="" class="btn btn-warning btn-block"><i class="fas fa-pencil mr-2"></i>Edit</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>