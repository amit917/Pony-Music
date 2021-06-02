
        <html>
      
        
            <title>jQuery UI Datepicker - Default functionality</title>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
         

            <!-- jQuery library -->
           

            <!-- Latest compiled JavaScript -->
           
             <title>Jquery Fullcalandar Integration with PHP and Mysql</title>
          
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
       

            
            



           
                <?php
                $conn=\Cake\Datasource\ConnectionManager::get('default');
                
                $stmt=$conn->execute(' select * from events');
                $stmt1=$conn->execute(' select * from quotes');
                $stmt2=$conn->execute(' select * from cancelled_bookings');
               
               

                ?>
                </head>


               <body>
               
                <script>


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
                        height: "auto",
                        
                        
                       

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
                                notes: "<?php echo $row1[8];?>",

                                backgroundColor:   "#FFA500",
                                textColor : "White",
                                url :"",

                            },
                            <?php

                            } ?>
                           


                        ] ,
                        selectable:true,
                        selectHelper:true,


                       


                        
                         
                        select: function(startDate, endDate) {
                          if(startDate.isBefore(moment())) {
                              $('#calendar').fullCalendar('unselect');
                              return false;
                               }
                               $("#exampleModalCenter").modal("show");
                                document.getElementById("start-event").value = startDate.format("DD-MM-YYYY");
                                document.getElementById("end-event").value = endDate.format("DD-MM-YYYY");
                                

                        },



                    });
                });
            </script>
            </div>
            

       
     
       
                             



                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal footer -->


</div>
</div>
</div>

 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Recording Studio Login </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="users form">
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
                        $this->Form->setTemplates($myTemplates);



                        ?>

                        <div class ="row justify-content-md-center"  >
                            <div class=" col-md-auto">
                        <fieldset>
                            <?= $this->Form->control('email') ?>
                            <?= $this->Form->control('password') ?>
                             <?= $this->Form->control('start_event',['type' => 'hidden']) ?>
                              <?= $this->Form->control('end_event',['type' => 'hidden']) ?>
                        </fieldset>
                                </div>


                        <!--                                    <a href="/users/forgot_password">forgot password</a>-->
                    </div>
                        <div class ="row justify-content-md-center"  >
                            <div class= "col">
                                <h8>*If you don't have an account and like to make a recording studio booking please contact Pony Music.</h8>
                            </div>


                            <!--                                    <a href="/users/forgot_password">forgot password</a>-->
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <?= $this->Form->button('Login',['class'=>'btn btn-rose']); ?>
                    <?= $this->Form->end() ?>
                    <br>
                    <?= $this->Html->link('forgot password',['controller'=>'users','action'=>'forgot_password'])?>
                    <!--                                    <a href="/users/add">sign up</a> <br />-->
                </div>
            </div>
        </div>
    </div>



<div class="container">
    <div id="calendar"></div>
</div>
 <?= $this->Html->css('material-kit.min') ?>
 


    </body>

    </html>
  
  
    <br />
    <h2 align="center"><a href="#"></a></h2>
    <br />
    <div class="container">
        <div id="calendar"></div>
       
        </div>
         

       
        </html>


