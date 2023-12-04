<link rel="stylesheet" href="estilos/estilosGi.css">
<script src="https://kit.fontawesome.com/2c2420c96b.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Libre+Baskerville:wght@400;700&family=Roboto:wght@300&display=swap" rel="stylesheet">
<head>

</head>
<body style="background-image: url('imagenes/g.png');" >

<div class="max" >
   
    <div class="mayor"  >
        <h2 class="he ho">__________CONTÁCTANOS__________</h2>
        <div class="contform">
        
            <div class="info">
            <!-- <h2 class="si">CONTÁCTANOS</h2> -->
            <br>
            <br>
            <br>
            <p class="are">Donde nos encuentras:</p>
            <p class="he texto">Si deseasconsultar mayor información sobre nuestros servicios o tienes alguna duda al respecto, no dudes en solicituar una consultaría gratuita y uno de nuestros asesores te contactará a la brevedad.</p>
            <br>
            <p class="he"><i class="fa-solid fa-phone fa-lg" style="color: #1b69ee;"></i>  WhatsApp +458 108 33 82</p>
            <br>
            <p class="he"><i class="fa-solid fa-envelope fa-lg" style="color: #1b69ee;"></i> cheindudas@gmail.com</p>
            <br>
            <p class="he"><i class="fa-solid fa-location-dot fa-lg" style="color: #1b69ee;"></i> Singapore, 112 Robinson Rd, Singapore</p>
            
           <p></p>
           <p></p>
           <p></p>
            </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <p class="he">Nombre*</p>
                <input class="field"  type="text" tabindex="1" name="name" required ><br/>
                <p class="he">Apellidos*</p>
                <input class="field"  type="text" tabindex="2" name="ape" required ><br/>
                <p class="he">Correo eléctronico*</p>
                <input class="field" type="email" tabindex="3" name="email" required><br/>
                <p class="he">Teléfono*</p>
                <input class="field" type="tel" tabindex="4" name="telefono" required><br/>
                <p class="he">Asunto*</p>
                <textarea class="field" name="asunto" id="" cols="37" rows="1"></textarea>
                <p class="he">Mensaje*</p>
                <textarea class="field" name="mensaje" id="" cols="37" rows="10"></textarea><br/><br/>
                <input type="submit" class="btn btn-green" value="Enviar Datos">

                <?php
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\SMTP;
                use PHPMailer\PHPMailer\Exception;

                require 'PHPMailer/src/Exception.php';
                require 'PHPMailer/src/PHPMailer.php';
                require 'PHPMailer/src/SMTP.php';
                
                $mail = new PHPMailer(true);

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $asunto = $_POST["asunto"];
                    $mensajes = $_POST["mensaje"];
                    try {
                        $mail->SMTPDebug = 0;
                        $mail->isSMTP();                                            
                        $mail->Host       = 'smtp.gmail.com';                       
                        $mail->SMTPAuth   = true;                                  
                        $mail->Username   = 'cesar.correo.pruebas09@gmail.com';           
                        $mail->Password   = 'zwgg bprl puao ycab';                  
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                        $mail->Port       = 465;                                   
            
                        //Recipients
                        $mail->setFrom('cesar.correo.pruebas09@gmail.com', 'Cesar');
                        $mail->addAddress($email, $name);    
            
                        //Content
                        $mail->isHTML(true);                                  
                        $mail->Subject = 'Respuesta de chein';
                        $mail->Body = '

                        <p><strong>¡Hola!, '. $name .' </strong></p>
                        <p><strong>Apreciamos mucho tu interés en nuestra marca y queremos agradecerte por contactarnos a través de nuestro formulario. Hemos recibido tu solicitud y queremos que sepas que estamos trabajando activamente en procesarla.!</strong></p>
                        <p><strong>Nuestro equipo se encuentra revisando tu consulta con atención para brindarte la mejor asistencia posible. Valoramos tu paciencia mientras trabajamos en esto. En breve, nos pondremos en contacto contigo para proporcionarte la información o la solucion que necesitas.</strong></p>
                        <p><strong>Gracias por confiar en nosotros y por ser parte de nuestra comunnidad. Si tienes más preguntas o inquietudes, no dudes en contactarnos nuevamente.</strong></p>
                        <p><strong>¡Saludos cordiales!</strong></p>
                        <p><strong>El equipo de CHEIN</strong></p>
                        ';
            
                        $mail->send();
                        echo "<div id='msgEnviado'>";
                        echo "El mensaje ha sido enviado correctamente";
                        echo "</div>";
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }     
            ?>
        </form>
        </div>
    </div>
</div>
    
</body>