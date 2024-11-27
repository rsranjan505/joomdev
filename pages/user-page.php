


<div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Tasks</h5>
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addtask">Add Task</button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>                                    
                                    <th scope="col">Start Time</th> 
                                    <th scope="col">Stop Time</th>
                                    <th scope="col">Notes</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody id="task-list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addtask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_task" action="settings/add_task.php" method="post">
                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input type="datetime-local" class="form-control" name="start_time" id="start_time" required>
                        </div>
                        <div class="form-group">
                            <label for="stop_time">Stop Time</label>
                            <input type="datetime-local" class="form-control" name="stop_time" id="stop_time" required>
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <input type="text" class="form-control" name="notes" id="notes" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" id="description" required>
                        </div>
                        <p id="message"></p>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'settings/fetch_tasks.php',
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    let tasks = JSON.parse(response);
                    if(tasks.length == 0) {
                        $('#task-list').append(`
                            <tr>
                                <td colspan="4">No tasks found</td>
                            </tr>
                        `);
                    }else {
                        tasks.forEach(task => {
                        $('#task-list').append(`
                            <tr>
                                <td>${task.start_time}</td>
                                <td>${task.stop_time}</td>
                                <td>${task.notes}</td>
                                <td>${task.description}</td>
                            </tr>
                        `);
                    });
                    }
                    

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });



        $('#add_task').submit(function(e) {
            e.preventDefault();
            $('#message').html('');
            var formData = $(this).serialize();

            var startTime = new Date($('input[name="start_time"]').val());
            var stopTime = new Date($('input[name="stop_time"]').val());

            if (startTime >= stopTime) {
                $('#message').removeClass('text-success').addClass('text-danger').html("Start time must be less than stop time.");
                return;
            }

            $.ajax({
                type: "POST",
                url: "settings/add_task.php",
                data: formData,
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        $('#task-list').append(`
                            <tr>
                                <td>${response.task.start_time}</td>
                                <td>${response.task.stop_time}</td>
                                <td>${response.task.notes}</td>
                                <td>${response.task.description}</td>
                            </tr>
                        `);

                        $('#message').removeClass('text-danger').addClass('text-success').html('Task created successfully');
                        $('#add_task')[0].reset();

                    } else {
                        console.log(response);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    </script>