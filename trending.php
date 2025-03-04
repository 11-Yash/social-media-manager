<?php include('required/config.php'); ?>
<?php include('required/checklog.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Social Media Manager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include('required/cssLinks.php'); ?>
</head>

<body>
    <?php include('required/navbar.php'); ?>

    <div class="container-fluid">
        <div class="row main-container">
            <?php include('required/sidebar.php'); ?>
            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 p-4 bg-light">
                <h1 class='display-5'>Trending</h1>
                <div class="card shadow p-3">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>List of Trending</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-striped table-responsive" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Hashtags</th>
                                    <th>Use</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $sql = "SELECT description FROM socialmediaposts";
                                $result = $mysqli->query($sql);
                                $hashtags = array();
                                // Process each row of the result set
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        // Extract hashtags using a regular expression
                                        preg_match_all('/#(\w+)/', $row['description'], $matches);
                                    
                                        // Count and store hashtags in the array
                                        foreach ($matches[1] as $tag) {
                                            $tag = strtolower($tag);
                                            if (isset($hashtags[$tag])) {
                                                $hashtags[$tag]++;
                                            } else {
                                                $hashtags[$tag] = 1;
                                            }
                                        }
                                    }
                                }

                                //sorting the hastags
                                arsort($hashtags);

                                $srno = 1;
                                foreach ($hashtags as $tag => $count) {
                                    echo '<tr><td>' . $srno . '</td><td>#' . $tag . '</td><td>' . $count . '</td></tr>';
                                    $srno++;
                                }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="text-center mt-5">All Rights Reserved &copy; <?= Date("Y") ?></p>
            </div>
        </div>
    </div>

    <!-- ============= Modals Code Being Here ============= -->

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteDataModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Confirm Delete Trending</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="Trending">
                    <div class="modal-body">
                        Are you sure you want to delete <b><span id='title'>Trending Name</span></b>?
                        <input type="hidden" name='deleteId'>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('required/footer.php'); ?>
    <script>
        // On Edit Button Click
        // $('#addDataModal').on('show.bs.modal', function(event) {
        //     var button = $(event.relatedTarget)
        //     var id = button.data('id')
        //     var fname = button.data('fname')
        //     var lname = button.data('lname')
        //     var email = button.data('email')
        //     var contact = button.data('contact')
        //     var modal = $(this)

        //     modal.find('.modal-title').text((id == 0 || id == undefined) ? 'Add Trending' : "Edit Trending")
        //     modal.find('.modal-body #modifyID').val(id)
        //     modal.find('.modal-body #fname').val(fname)
        //     modal.find('.modal-body #lname').val(lname)
        //     modal.find('.modal-body #email').val(email)
        //     modal.find('.modal-body #contact').val(contact)
        //     modal.find('.modal-footer button[name=submit]').text((id == 0 || id == undefined) ? 'Save' : "Update")
        // })

        $('#platforms').select2({
            theme: 'bootstrap-5'
        });
    </script>
</body>

</html>