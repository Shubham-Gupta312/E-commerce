<?= $this->extend('inc/snippet.php'); ?>
<?= $this->section('content'); ?>

<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->

<div id="main-wrapper-rmvd">

    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h1>About Cauvery Resort</h1>
                </div>
            </div>

            <div class="about-from">
                <textarea name="content" id="editor"></textarea>
                <div class="text-center">
                    <button type="submit" id="save" name="save" class="btn btn-outline-primary mt-2">Submit</button>
                </div>
            </div>

            <!-- Row -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2024 Copyright by Cauvery Resort
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>

<!-- <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
    var editor;

    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            // console.log(editor);
            editor.ui.view.editable.element.style.minHeight = '300px'; // Set the minimum height
            editor.ui.view.editable.element.style.height = '300px'; // Set the height
            editor.ui.view.editable.element.style.overflowY = 'auto';
        })
        .catch(error => {
            console.error(error);
        });

    // Assuming there is a <button id="submit">Submit</button> in your application.
    document.querySelector('#save').addEventListener('click', () => {
        if (editor) {
            editor.model.document.toData().then(data => {
                console.log(data);
                // Do something with the data
            }).catch(error => {
                console.error(error);
            });
        } else {
            console.error('Editor not initialized');
        }

        // ...
    });
</script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
    let editor;

    $.ajax({
        method: "POST",
        url: "<?= base_url('admin/fetchAbout') ?>",
        success: function (response) {
            if (response.status === 'true') {
                // Initialize the editor with existing data
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .then(newEditor => {
                        editor = newEditor;
                        // newEditor.setData(response.editorData);
                        const decodedData = $('<textarea/>').html(response.editorData).text();
                        newEditor.setData(decodedData);
                        newEditor.ui.view.editable.element.style.minHeight = '300px'; // Set the minimum height
                        newEditor.ui.view.editable.element.style.height = '300px'; // Set the height
                        newEditor.ui.view.editable.element.style.overflowY = 'auto';
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                console.error('Failed to fetch existing data');
            }
        }
    });
    // ClassicEditor
    //     .create(document.querySelector('#editor'))
    //     .then(newEditor => {
    //         editor = newEditor;
    //         editor.ui.view.editable.element.style.minHeight = '300px'; // Set the minimum height
    //         editor.ui.view.editable.element.style.height = '300px'; // Set the height
    //         editor.ui.view.editable.element.style.overflowY = 'auto';
    //     })
    //     .catch(error => {
    //         console.error(error);
    //     });

    // Assuming there is a <button id="save">Save</button> in your application.
    document.querySelector('#save').addEventListener('click', () => {
        if (editor) {
            const editorData = editor.getData(); // Get the content from the editor
            // console.log(editorData);
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/checkAbout') ?>",
                success: function (response) {
                    if (response.exists) {
                        $.ajax({
                            method: "POST",
                            url: "<?= base_url('admin/updateAbout') ?>",
                            data: { 'editorData': editorData },
                            success: function (response) {
                                // console.log(response);
                                if (response.status == 'true') {
                                    alert('Data Updated Successfully!');
                                } else {
                                    alert('Something went wrong!');
                                }
                            }
                        });
                    } else {
                        $.ajax({
                            method: "POST",
                            url: "<?= base_url('admin/about') ?>",
                            data: { 'editorData': editorData },
                            success: function (response) {
                                // console.log(response);
                                if (response.status == 'true') {
                                    alert('Data Saved Successfully!');
                                } else {
                                    alert('Something went wrong!');
                                }
                            }
                        });
                    }
                }
            });
        } else {
            console.error('Editor not initialized');
        }
    });
</script>



<?= $this->endSection() ?>