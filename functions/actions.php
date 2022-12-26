<?php
/**
 * Save New Task.
 */
if ( isset( $_POST['saveTask'] ) ) {
    try {
        $title       = sanitize_text_field( wp_unslash($_POST['title'] ) );
        $priority    = sanitize_text_field( wp_unslash( $_POST['priority'] ) );
        $status      = 'Pending';
        $description = sanitize_text_field( wp_unslash( $_POST['description'] ) );

        if ( empty( $title ) ) {
	        throw new Exception("Please give a valid title");
        }

        $response = AMEAT_createTask($title, $priority, $description, $status);

        if ( $response['status'] ) {
			?>
	            <script type="text/javascript">
	                swal({
	                        position: "top-end",
	                        icon: "success",
	                        title: "Task has been added !!",
	                        closeOnClickOutside: false,
	                        allowOutsideClick: false
	                    })
	                    .then((success) => {
	                        if (success) {
	                            window.location.replace("admin.php?page=tasks")
	                        }
	                    });
	            </script>
	        <?php
        } else {
			?>
	            <script type="text/javascript">
	                swal({
	                        position: "top-end",
	                        icon: "error",
	                        title: "Something went wrong, Please give task data properly !",
	                        showConfirmButton: false
	                    })
	            </script>
	        <?php
        }
    } catch ( Exception $e ) { ?>
	        <script type="text/javascript">
	            swal({
	                    position: "top-end",
	                    icon: "error",
	                    title: "Something went wrong, Please give task data properly !",
	                    showConfirmButton: false
	                })
	        </script>
	    <?php
    }
}

/** Deleting Tasks */
if ( isset( $_POST['deleteTask'] ) && isset( $task ) ) {
    $id       = absint( $_POST['id'] );
    $response = AMEAT_deleteTask( $id );

    if ( $response['status'] ) {
		?>
	        <script type="text/javascript">
	            swal({
	                    position: "top-end",
	                    title: "<?php echo esc_html( $response['message'] ); ?>",
	                    icon: "success",
	                    closeOnClickOutside: false,
	                    allowOutsideClick: false
	                })
	                .then((success) => {
	                    if (success) {
	                        window.location.replace("admin.php?page=tasks")
	                    }
	                });
	         </script>
	    <?php
    } else {
        ?>
	    <script type="text/javascript">
            swal({
                    position: "top-end",
                    icon: "error",
                    title: "<?php echo esc_html( $response['message'] ); ?>",
                    showConfirmButton: false,
                })
        </script>
	    <?php
    }
}

/**
 * Updating Task
 */
if ( isset( $_POST['updateTask'] ) && isset( $task ) ) {
    $title       = sanitize_text_field( wp_unslash( $_POST['title'] ) );
    $priority    = sanitize_text_field( wp_unslash( $_POST['priority'] ) );
    $status      = sanitize_text_field( wp_unslash( $_POST['status'] ) );
    $description = sanitize_text_field( wp_unslash( $_POST['description'] ) );
    $id          = absint( $_POST['id'] );

    if ( empty( $title ) ) {
	    throw new \Exception( "Please give a valid title" );
    }

    $response = AMEAT_updateTask( $title, $priority, $description, $status, $id );

    if ( $response['status'] ) {
		?>
		    <script type="text/javascript">
	            swal({
	                position: "top-end",
	                title: "Task has been updated !!",
	                icon: "success",
	                closeOnClickOutside: false,
	                allowOutsideClick: false
	            })
	                .then((success) => {
	                    if (success) {
	                        window.location.replace("admin.php?page=tasks")
	                    }
	                });
		    </script>
	    <?php
    } else {
		?>
		    <script type="text/javascript">
	            swal({
	                position: "top-end",
	                icon: "error",
	                title: "Something went wrong, Please give task data properly !",
	                showConfirmButton: false,
	            })
		    </script>
	    <?php
    }
}

/**
 * Mark as Complete Action.
 */
if ( isset( $_POST['submit_mark_complete'] ) ) {
    $id       = absint( $_POST['mark_as_complete_id'] );
    $status   = sanitize_text_field( wp_unslash( $_POST['mark_as_complete_status'] ) );
    $response = AMEAT_updateTaskStatus( $id, $status );

    if ( $response['status'] ) {
		?>
        <script type="text/javascript">
                window.location.replace("admin.php?page=tasks")
         </script>
        <?php
	}
}

/**
 * Mark as Pending Action.
 */
if ( isset( $_POST['submit_mark_pending'] ) ) {
    $id       = absint( $_POST['mark_as_pending_id'] );
    $status   = sanitize_text_field( wp_unslash( $_POST['mark_as_pending_status'] ) );
    $response = AMEAT_updateTaskStatus( $id, $status );

    if ( $response['status'] ) {
		?>
        <script type="text/javascript">
                window.location.replace("admin.php?page=tasks")
         </script>
		<?php
    }
}
