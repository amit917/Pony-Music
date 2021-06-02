<div class="card text-center">
    <div class="card-header card-header-primary">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="/bookings/client_rehearsal_calendar/">Rehearsals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#0">Recordings</a>
            </li>

        </ul>
    </div>
    <div class="card-body">
        <!DOCTYPE html>
        <html>
        <head>

            <title>Jquery Fullcalandar Integration with PHP and Mysql</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
            <script>
                <?php
                $conn=\Cake\Datasource\ConnectionManager::get('default');
                $stmt=$conn->execute(' select * from events');
                $stmt1=$conn->execute(' select * from quotes');
                ?>




                $(document).ready(function() {
                    var calendar = $('#calendar').fullCalendar({
                        disableDragging: true,
                        eventStartEditable : false,
                        editable:true,
                        header:{
                            left:'prev,next ',
                            center:'title',
                            right:'month'
                        },

                        events: [

                            <?php
                            foreach($stmt as $row){?>


                            {
                                id: "<?php echo $row[0];?>",
                                title: "<?php echo $row[1];?>",
                                start :  "<?php echo $row[2];?>",
                                end : "<?php echo $row[3];?>",
                                begin_date : "<?php echo $row[2];?>",
                                finish_date : "<?php echo $row[3];?>",

                                backgroundColor: " #90ee90 ",
                                textColor: "Black",




                            },
                            <?php }?>
                            <?php
                            foreach($stmt1 as $row1){?>

                            {
                                id: "<?php echo $row1[0];?>",
                                title: "<?php echo $row1[8];?>",
                                customer_fname : "<?php echo $row1[1];?>",
                                customer_lname : "<?php echo $row1[2];?>",
                                customer_email: "<?php echo $row1[4];?>",
                                customer_phone: "<?php echo $row1[3];?>",
                                start :  "<?php echo $row1[5];?>",
                                end : "<?php echo $row1[6];?>",
                                begin_date : "<?php echo $row1[5];?>",
                                finish_date : "<?php echo $row1[6];?>",
                                display_name: "<?php echo $row1[8];?>",
                                backgroundColor:   "#FFA500",
                                textColor : "White",
                                url :"",

                            },
                            <?php }?>


                        ]




                    });
                });

            </script>
        </head>
        <body>
        <br />
        <h2 align="center"><a href="#">Recording Studio Booking</a></h2>
        <br />
        <div class="container">
            <div id="calendar"></div>
        </div>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Full Recording</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->

                    <div class="row">
                        <div class="col-md-11">

                            <div class="card">
                                <div class="card-header card-header-rose card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">event_note</i>
                                    </div>
                                    <h4 class="card-title">Recording Studio</h4>
                                </div>
                                <div class="card-body">
                                    <br>


                                    <?= $this->Form->create();
                                    $myTemplates = [
                                        'inputContainer' => '
                <div class="form-group">{{content}}</div>
                ',
                                        'label' => '<label class="bmd-label-floating">{{text}}</label>',
                                        'input' => '<input class="form-control" type="{{type}}" name="{{name}}" {{attrs}}/>',
                                        'textarea' => '<textarea class="form-control"
                                         placeholder="If you would like to add any notes to this booking, please write in this field."
                                         rows="2" {{attrs}}>{{value}}</textarea>'
                                    ];
                                    $this->Form->setTemplates($myTemplates);?>
                                    <h5>Client Details</h5>

                                    <div class="row">

                                        <div class="col-md">
                                            <?= $this->Form->control('client_fname', ['label' => 'First Name *', 'required' => true]); ?>
                                        </div>
                                        <div class="col-md">
                                            <?= $this->Form->control('client_lname', ['label' => 'Last Name *', 'required' => true]); ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md">
                                            <?= $this->Form->control('client_phone', ['type' => 'tel', 'label' => 'Phone *', 'required' =>
                                                true]);?>
                                        </div>
                                        <div class="col-md">
                                            <?= $this->Form->control('client_email', ['type' => 'email', 'label' => 'Email (optional)']);?>
                                        </div>

                                    </div>
                                    <div class="category form-category">* Required fields</div>
                                    <h5>Booking Information</h5>

                                    <div class="row">
                                        <div class="col-md">
                                            <?= $this->Form->control('start_date', ['label' => '', 'required' => true, array('readonly' => 'readonly')]); ?>

                                        </div>
                                        <div class="col-md">
                                            <?= $this->Form->control('end_date', ['label' => '', 'required' => true,array('readonly' => 'readonly')]); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <?= $this->Form->control('Display_name', ['label' => 'Display_name *', 'required' => true]); ?>
                                        </div>
                                        <div class="col-md">
                                            <?= $this->Form->control('Price', ['label' => 'Price *', 'required' => true]); ?>
                                        </div>

                                    </div>



                                    <!-- Modal footer -->

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <?php echo $this->Form->submit('Submit', ['class'=>'btn btn-rose'])?>
                                    <?php echo $this->Form->end() ?>
                                </div>


                            </div>


                        </div>
                    </div>

                </div>
                <script>

                </script>


        </body>
        </html>



