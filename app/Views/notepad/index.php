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
                    <input type="text" name="note_title" class="form-control note-title" placeholder="Note Title" required>
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control note-content" name="note_content" id="summernote" placeholder="Note Content" required="required"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk mr-1"></i> Save</button>
        </form>
    </div>
</div>
<hr class="my-5">
<div class="row mt-3">
    <div class="col-lg-5">
        <div class="message"></div>
        <div class="card">
            <div class="card-header note">
                <h5 class="notes-header my-auto">My Saved Notes</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table" id="list-notes">

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7" id="detail-note">
    </div>
</div>

<script type="text/javascript">
    loadNotes();

    let note_selected = ""

    function loadNotes() {
        $.ajax({
            url: "<?php echo site_url('notepad/getNotes') ?>",
            type: 'GET',
            success: function(data) {
                let objData = JSON.parse(data);
                $('#list-notes').html(objData.content);
            },
            error: function(errorMsg) {
                alert('Error : ' + errorMsg);
            }
        });
    }

    function delete_note(id) {
        $confirm = confirm('Yakin hapus note?')
        if ($confirm) {
            $.ajax({
                url: `<?= site_url('notepad/delete/') ?> ${id}`,
                type: 'DELETE',
                success: function(data) {
                    let objData = JSON.parse(data);
                    let msg = `<div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">x</button>
                                        ${objData.result}
                                    </div>
                                </div>`;
                    loadNotes();
                    $('.message').html(msg);
                    if (note_selected == id) {
                        $('#detail-note').addClass('d-none')
                    }
                },
                error: function(errorMsg) {
                    alert(`Error: ${errorMsg}`)
                }
            })
        }
    }

    function detail_note(id) {
        note_selected = id
        $.ajax({
            url: `<?= site_url('notepad/detail/') ?> ${id}`,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#detail-note').html(data);
                $('#detail-note').removeClass('d-none')
            },
            error: function(msg) {
                alert(`Error: ${msg}`)
            }
        })
    }
</script>
<?= $this->endSection(); ?>