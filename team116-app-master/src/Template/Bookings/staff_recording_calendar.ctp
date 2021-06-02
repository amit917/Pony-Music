
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!DOCTYPE html>
        <html>
        <?php  $this->viewBuilder()->setLayout('admin');?>
       
            <title>jQuery UI Datepicker - Default functionality</title>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          
            <!-- Latest compiled and minified CSS -->
         

            <!-- jQuery library -->
           

            <!-- Latest compiled JavaScript -->
           


            <title>Jquery Fullcalandar Integration with PHP and Mysql</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
            </head>
            

              
            <script>

                <?php
                $conn=\Cake\Datasource\ConnectionManager::get('default');
                $stmt=$conn->execute(' select * from events');
                $stmt1=$conn->execute(' select * from quotes');
                $stmt2=$conn->execute(' select * from cancelled_bookings');
               

                ?>
                
                
         


                $(document).ready(function() {
                    var calendar = $('#calendar').fullCalendar({
                        disableDragging: true,
                        eventStartEditable : false,
                        editable:true,
                        header:{
                            center:'title',
                
                            left:   'title',
                            center: '',
                            right:  'today prev,next'
                           
                        },
                       height: 600,


                        events: [

                            <?php
                            foreach($stmt as $row){?>


                            {
                                id: "<?php echo $row[0];?>",
                                int_id: "<?php echo $row[0];?>",
                                title: "<?php echo $row[10];?>",
                                start :  "<?php echo $row[2];?>",
                                end : "<?php echo $row[3];?>",
                                begin_date : "<?php echo $row[2];?>",
                                finish_date : "<?php echo $row[3];?>",
                                notes : "<?php echo $row[4];?>",
                                customer_fname: "<?php echo $row[5];?>",
                                customer_lname: "<?php echo $row[6];?>",
                                customer_phone: "<?php echo $row[7];?>",
                                customer_email: "<?php echo $row[8];?>",
                                Band_name: "<?php echo $row[9];?>",
                                display_name: "<?php echo $row[10];?>",
                                user_email : "<?php echo $row[13];?>",


                                backgroundColor: "#90ee90",
                                textColor: "Black",




                            },
                            <?php }?>
                            <?php
                            foreach($stmt1 as $row1){?>

                            {
                                id: "<?php echo $row1[0];?>",
                                int_id :"<?php echo $row1[0];?>",
                                title : "<?php echo $row1[9];?>",
                                customer_fname : "<?php echo $row1[1];?>",
                                customer_lname : "<?php echo $row1[2];?>",
                                customer_email: "<?php echo $row1[4];?>",
                                customer_phone: "<?php echo $row1[3];?>",
                                start :  "<?php echo $row1[5];?>",
                                end : "<?php echo $row1[6];?>",
                                begin_date : "<?php echo $row1[5];?>",
                                finish_date : "<?php echo $row1[6];?>",
                                Band_name: "<?php echo $row1[7];?>",
                                display_name: "<?php echo $row1[9];?>",
                                user_email: "<?php echo $row1[12];?>",
                                notes: "<?php echo $row1[8];?>",

                                backgroundColor:   "#FFA500",
                                textColor : "White",
                                url :"",

                            },
                            <?php

                            } ?>
                            <?php
                            foreach($stmt2 as $row2){?>

                            {
                                id: "<?php echo $row2[0];?>",
                                int_id :"<?php echo $row2[0];?>",
                                title : "<?php echo $row2[8];?>",
                                client_fname : "<?php echo $row2[4];?>",
                                client_lname : "<?php echo $row2[5];?>",
                                client_phone : "<?php echo $row2[6];?>",
                                client_email : "<?php echo $row2[7];?>",


                                start :  "<?php echo $row2[2];?>",
                                end : "<?php echo $row2[3];?>",

                                requested_start :  "<?php echo $row2[2];?>",
                                requested_end : "<?php echo $row2[3];?>",
                                display_name: "<?php echo $row2[8];?>",
                                Band_name: "<?php echo $row2[10];?>",
                                notes: "<?php echo $row2[9];?>",
                                user_email: "<?php echo $row2[13];?>",

                                backgroundColor:   "#D92121",
                                textColor : "White",
                                url :"",

                            },
                            <?php

                            } ?>


                        ] ,
                        selectable:true,
                        selectHelper:true,


                        eventClick: function(event) {



                             
                           


                            $("#Details").modal("show");
                            


                            $( function() {
                                $( "#requested-start-date" ).datepicker({ dateFormat: "dd-mm-yy",
                                     minDate: 0
                                    
                                }).val();

                                $("#requested-end-date").datepicker({ dateFormat: "dd-mm-yy",
                                 minDate: 0
                                    
                                }).val();


                            } );


                            $(function() {
                                if(event.backgroundColor === '#FFA500') {
                                    document.getElementById("future-client-fname").value = event.customer_fname;
                                    document.getElementById("future-client-lname").value = event.customer_lname;
                                    document.getElementById("future-client-email").value = event.customer_email;
                                    document.getElementById("future-client-phone").value = event.customer_phone;
                                    var start_date = event.begin_date;

                                    var year = start_date.slice(0, 4);
                                    var month = start_date.slice(5, 7);
                                    var date = start_date.slice(8, 10);
                                    var res = date + "-" + month + "-" + year;

                                    var end_date = event.finish_date;


                                    var end_year = end_date.slice(0, 4);
                                    var end_month = end_date.slice(5, 7);
                                    var date2 = parseInt(end_date.slice(8, 10))-1;
                                    var end_res = date2.toString() + "-" + month + "-" + year;


                                    document.getElementById("requested-start-date").value = res;
                                    document.getElementById("requested-end-date").value = end_res;
                                    document.getElementById("requested-display-name").value = event.display_name;
                                    document.getElementById("requested-band-name").value = event.Band_name;
                                    document.getElementById("notes").value = event.notes;
                                    document.getElementById("quote-id").value = event.int_id;
                                    document.getElementById("user-id").value = event.user_email;
                                    //document.getElementById("actual-end-date").value = event.end;
                                    document.getElementById("orange").disabled = false;
                                    document.getElementById("red").disabled = false;
                                    document.getElementById("red").style.background='#D92121';
                                    document.getElementById("green").
                                    style.background='#90ee90';
                                    document.getElementById("green").disabled = false;
                                    document.getElementById("edit").value = "Delete ";
                                    document.getElementById("edit").style.background='#a9a9a9';
                                    document.getElementById("red").value = "Cancel";
                                    document.getElementById("green").value = "Confirm";
                                    document.getElementById("orange").value = "REQUEST";
                                    document.getElementById("orange").style.background='#FFA500';
                                     document.getElementById("orange").style.border = "thick solid #000000";
                                    document.getElementById("orange").style.borderWidth = "thick";
                                    document.getElementById("green").style.border = "thick solid ##ffffff";
                                   


                                }

                                if(event.backgroundColor === '#D92121') {
                                    document.getElementById("future-client-fname").value = event.client_fname;
                                    document.getElementById("future-client-lname").value = event.client_lname;
                                    document.getElementById("future-client-email").value = event.client_email;
                                    document.getElementById("future-client-phone").value = event.client_phone;
                                    var start_date = event.requested_start;

                                    var year = start_date.slice(0, 4);
                                    var month = start_date.slice(5, 7);
                                    var date = start_date.slice(8, 10);
                                    var res = date + "-" + month + "-" + year;

                                    var end_date = event.requested_end;


                                    var end_year = end_date.slice(0, 4);
                                    var end_month = end_date.slice(5, 7);
                                    var date2 = parseInt(end_date.slice(8, 10))-1;
                                    var end_res = date2.toString() + "-" + month + "-" + year;


                                    document.getElementById("requested-start-date").value = res;
                                    document.getElementById("requested-end-date").value = end_res ;
                                    document.getElementById("requested-display-name").value = event.display_name;
                                    document.getElementById("notes").value = event.notes;
                                     document.getElementById("user-id").value = event.user_email;
                                    document.getElementById("quote-id").value = event.int_id;
                                    document.getElementById("requested-band-name").value = event.Band_name;

                                    document.getElementById("red").disabled = false;
                                    document.getElementById("green").disabled = false;
                                    document.getElementById("orange").disabled = false;
                                    document.getElementById("orange").style.background = '#FFA500';
                                    document.getElementById("orange").value = "Pending   ";
                                    document.getElementById("red").value = "Canceled";
                                    document.getElementById("edit").value = "Delete";
                                    document.getElementById("edit").style.background='#a9a9a9';
                                    document.getElementById("green").style.background='#008000';
                                    document.getElementById("red").style.background='#D92121';
                                    document.getElementById("red").style.border = "thick solid #000000";
                                    document.getElementById("red").style.borderWidth = "thick";
                                     document.getElementById("red").style.width = '115px';
                                    document.getElementById("green").value = "Confirm ";



                                    //   document.getElementById("actual-end-date").value = event.end;


                                }
                                if(event.backgroundColor === '#90ee90') {
                                    document.getElementById("future-client-fname").value = event.customer_fname;
                                    document.getElementById("future-client-lname").value = event.customer_lname;
                                    document.getElementById("future-client-email").value = event.customer_email;
                                    document.getElementById("future-client-phone").value = event.customer_phone;
                                    var start_date = event.begin_date;

                                    var year = start_date.slice(0, 4);
                                    var month = start_date.slice(5, 7);
                                    var date = start_date.slice(8, 10);
                                    var res = date + "-" + month + "-" + year;

                                    var end_date = event.finish_date;


                                    var end_year = end_date.slice(0, 4);
                                    var end_month = end_date.slice(5, 7);
                                    var date2 = parseInt(end_date.slice(8, 10))-1;
                                    var end_res = date2.toString() + "-" + month + "-" + year;


                                    document.getElementById("requested-start-date").value = res;
                                    document.getElementById("requested-end-date").value = end_res ;
                                    document.getElementById("requested-display-name").value = event.display_name;
                                    document.getElementById("notes").value = event.notes;
                                    document.getElementById("quote-id").value = event.int_id;
                                    document.getElementById("user-id").value = event.user_email;
                                  
                                    document.getElementById("requested-band-name").value = event.Band_name;
                                    document.getElementById("red").disabled = false;
                                    document.getElementById("green").disabled = false;
                                    document.getElementById("orange").disabled = false;

                                    document.getElementById("red").value = "Cancel ";
                                    document.getElementById("green").value = "Confirmed";
                                    document.getElementById("orange").value = "Pending";
                                    document.getElementById("edit").value = "Delete  ";
                                    document.getElementById("edit").style.background='#a9a9a9';
                                    document.getElementById("red").style.background='#D92121';
                                    document.getElementById("orange").style.background='#FFA500',
                                    document.getElementById("green").style.background='#90ee90';
                                    document.getElementById("green").style.border = "thick solid #000000";
                                    document.getElementById("green").style.borderWidth = "thick";



                                    //   document.getElementById("actual-end-date").value = event.end;


                                }






                            });





                        },
                        


                        
                        select: function(startDate, endDate) {
                          if(startDate.isBefore(moment())) {
                              $('#calendar').fullCalendar('unselect');
                              return false;
                               }
                               
                            $("#myModal").modal("show");
                            $( function() {
                                $( "#start-date" ).datepicker({ dateFormat: "dd-mm-yy" ,
                                     minDate: 0
                                }).val();
                                $("#end-date").datepicker({ dateFormat: "dd-mm-yy" ,
                                 minDate: 0
                                    
                                }).val();


                            } );
                            
                            $(function () {
                                var selectedEndDate = parseInt(endDate.format("DD"))-1;
                                var actualEndDate = selectedEndDate+"-"+ endDate.format("MM")+"-"+endDate.format("YYYY");
                                document.getElementById("start-date").value = startDate.format("DD-MM-YYYY");
                                document.getElementById("end-date").value = actualEndDate;
                                var x = parseInt(endDate.format("DD"));
                                var actualEndDate2 = endDate.format("YYYY")+"-"+endDate.format("MM")+"-"+ x;
                                document.getElementById("actual-end-date").value = actualEndDate2 ;


                            });



                            alert('selected ' + startDate.format() + ' to ' + actualEndDate);

                        },


                    });
                });


            </script>
            

        </head>
        <body>
        <div class="modal fade" id="Details">
            <div class="modal-dialog modal-xl">
                
                
                <div class="modal-content">

                    <!-- Modal Header -->
                  <div class="modal-header">
                        <h6 class="modal-title">Edit Booking</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <?= $this->Form->create(
                            null,[
                            'url' => [
                                'controller' => 'Bookings',
                                'action' => 'confirmBooking',
                            ],
                        ]);?>

                        <h5>Client Details</h5>
                    
                 
                    
                        <div class="row">
                            <div class="col">
                              
                                <?= $this->Form->control('future_client_fname', ['label' => 'First Name', 'required' => true,'class'=>'form-control','type'=>'text']); ?>
                            </div>
                            <div class="col">
                                <?= $this->Form->control('future_client_lname', ['label' => 'Last name', 'required' => true,'class'=>'form-control','type'=>'text']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?= $this->Form->control('future_client_phone', ['label' => 'phone(10 digits)', 'required' =>
                                    true,'class'=>'form-control','type'=>'text']);?>
                            </div>
                            <div class="col">
                                <?= $this->Form->control('future_client_email', ['label' => 'Email', 'required' =>
                                    true,'class'=>'form-control','type'=>'text']);?>
                            </div>
                        </div>
                        <br>
                        <h5>Booking Information</h5>
                        <div class="row">
                            <div class="col">
                                <?= $this->Form->control('requested_start_date', ['label' => 'Start date','required' =>
                                    true,'class'=>'form-control','type'=>'text' ]); ?>

                            </div>
                            <div class="col">
                                <?= $this->Form->control('requested_end_date', ['label' => 'End date', 'required' => true,'class'=>'form-control','type'=>'text']); ?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <?= $this->Form->control('requested_display_name', ['label' => 'Display_name *', 'required' => true,'class'=>'form-control','type'=>'text']); ?>
                            </div>
                            <div class="col">
                                <?= $this->Form->control('requested_band_name', ['label' => 'Band_name *', 'required' => true,'class'=>'form-control','type'=>'text']); ?>
                            </div>


                        </div>
                        <div class="row">
                            <div class = "col">
                                <h5>Notes</h5>
                                <textarea name="notes" id = "notes" class="form-control rows="8" cols="40"></textarea>
                            </div>

                        </div>
                        <div class="row">
                            <div class = "col">
                                <?= $this->Form->control('quote_id', ['label' => '', 'type' => 'hidden']); ?>
                                <?= $this->Form->control('user_id', ['label' => '', 'type' => 'hidden']); ?>

                            </div>
                        </div>



                        <div class="modal-footer">
                          
                                
                           <div class = "row">
                           <div class = "col">
                            <?php echo $this->Form->submit('Confirm', [ 'name' => 'submit', 'id'=>'green','class'=>'btn',"onClick"=>"greenFunction()"])?>
                            <?php echo $this->Form->submit('Request', [ 'name' => 'submit', 'id'=>'orange','class'=>'btn',"onClick"=>"orangeFunction()"])?>
                            </div>
                            </div>
                             <div class = "row">
                              <div class = "col">
                            <?php echo  $this->Form->submit('Remove', ['name' => 'submit', 'id'=>'red', 'class'=>'btn',"onClick"=>"redFunction()"]); ?>
                            <?php echo $this->Form->submit('Edit', [ 'name' => 'submit', 'id'=>'edit','class'=>'btn',"onClick"=>"myFunction()"])?>
                            </div>
                            </div>
                          <script>
                                  function myFunction() {
                                           var txt;
                                         if (confirm("You are about to Delete an event permanently")) {
                                                  txt = "You pressed OK!";
                                                    }
                                        else {
                                         event.preventDefault();
                                              
                                                     }
                                            }
                                     function redFunction() {
                                           var txt;
                                         if (confirm("You are about to cancel an event ")) {
                                                  txt = "You pressed OK!";
                                                    }
                                        else {
                                         event.preventDefault();
                                              
                                                     }
                                            }
                                            
                                        function greenFunction() {
                                           var txt;
                                         if (confirm("You are about to confirm an event ")) {
                                                  txt = "You pressed OK!";
                                                    }
                                        else {
                                         event.preventDefault();
                                              
                                                     }
                                            }
                                             function orangeFunction() {
                                           var txt;
                                         if (confirm("You are about to make an event pending ")) {
                                                  txt = "You pressed OK!";
                                                    }
                                        else {
                                         event.preventDefault();
                                              
                                                     }
                                            }
                                </script>
                         

                            <?php echo $this->Form->end() ?>

                        </div>
                             



                    </div>
                   

                </div>
            </div>
        </div>
    </div>

    <!-- Modal footer -->





  


<div class="container">
    <div id="calendar"></div>
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
           
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
                               <?php  $start = $this->request->getQuery("start-date");?>
                               <?php $end = $this->request->getQuery("end-date");?>
                                <?php $PreviousDate =  date('d-m-Y', strtotime($end.' - 1 day'));?>
                               
                            <?= $this->Form->create(null, ['name'=>'searchF']);?>
                            
                            <h5>Client Details</h5>

                            <div class="row">

                                <div class="col-md">
                                    <?= $this->Form->control('client_fname', ['label' => 'First Name *:', 'required' => true,'class'=>'form-control']); ?>
                                </div>
                                <div class="col-md">
                                    <?= $this->Form->control('client_lname', ['label' => 'Last Name *:', 'required' => true,'class'=>'form-control']); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md">
                                    <?= $this->Form->control('client_phone', ['type'=>'phone','label' => 'Phone (10 digits) *:', 'required' =>
                                        true,'class'=>'form-control']);?>
                                </div>
                                <div class="col-md">
                                    <?= $this->Form->control('client_email', ['type' => 'email', 'label' => 'Email *:', 'required' => true,'class'=>'form-control']);?>
                                </div>

                            </div>
                            <div class="category form-category">* Required fields</div>
                            <h5>Booking Information</h5>

                            <div class="row">
                                <div class="col-md">
                              
                                    <?= $this->Form->control('start_date', ['label' => '','default'=>$start, 'required' => true,'class'=>'form-control']); ?>

                                </div>
                                <div class="col-md">
                               
                                    <?= $this->Form->control('end_date', ['label' => '', 'default'=> $PreviousDate,'required' => true,'class'=>'form-control']); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <?= $this->Form->control('display_name', ['label' => 'Display Name *:', 'required' => true,'class'=>'form-control']); ?>
                                </div>
                                <div class="col-md">
                                    <?= $this->Form->control('band_name', ['label' => 'Band Name *:', 'required' => true,'class'=>'form-control']); ?>

                                </div>

                            </div>
                            <h5>Notes</h5>
                            <div class = "row">
                                <div class="col-md">
                                    <textarea name="notes" id = "notes" class="form-control rows="8" cols="40"></textarea>

                                </div>
                            </div>



                            <!-- Modal footer -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <?php echo $this->Form->submit('Submit  ', ['class'=>'btn btn-rose',"onClick "=>"validateForm()"])?>
                            <?php echo $this->Form->end() ?>
                        </div>
          
 <script>


    function validateForm() {

        var fName = document.forms["searchF"]["client_fname"].value;
        var lName = document.forms["searchF"]["client_lname"].value;


        //It returns -1 if the argument passed a negative number.
        var cPhone = document.forms["searchF"]["client_phone"].value;
         var notes = document.forms["searchF"]["notes"].value;
        var cEmail = document.forms["searchF"]["client_email"].value;
        var phoneno=/^\d{10}$/;

        if (fName.length >= 10 && fName.length <= 2 || lName.length >= 10 && lName.length <= 2) {
            alert("please input valid name");
            event.preventDefault();
            
            return false;
        } 
        if (cPhone.length !== 10) {
            alert("please input correct phone number");
            event.preventDefault();
            return false;

        }
         if (notes.length> 500) {
            alert("You can only enter 500 character");
            event.preventDefault();
            return false;

        }
        else if(!cPhone.match(phoneno)) {
            alert("please input correct phone number");
            event.preventDefault();
            return false;
        }
        if (cEmail == null || cEmail == "") {
            alert("please input email address!");
            document.forms["searchF"]["client_email"].focus();
            
            return false;
        }
        var regExp = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
        if (!regExp.test(cEmail)) {
            alert("please check your email address!");
            document.forms["searchF"]["client_email"].focus();
            return false;
        }
       


    }
</script>

                    </div>
 <head>
        <?= $this->Html->css('material-kit.min') ?>
    </head>

                </div>
            </div>

        </div>
    </div>
</div>
</div>

<script>
$('#Details').on('hidden.bs.modal', function () {
 location.reload();
})
</script>






    </body>

    </html>
   
  
    <body>
    <br />
    <h2 align="center"><a href="#"></a></h2>
    <br />
    <div class="container">
        <div id="calendar"></div>
        </div>
        </body>
        </html>


