<?php
    include("conexion.php");
    $conexion = conectar();
    
    $path = 'C:\xampp';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require_once($path.'\common\Utility\phpmailer\PHPMailer.php');
    require_once($path.'\common\Utility\phpmailer\SMTP.php');
    require_once($path.'\common\Utility\PHPExcel181\PHPExcel.php');
    
    $sArchivo = $path . '\prueba.xlsx';    
    $objXLS = new PHPExcel();

    $objXLS->getProperties()->setTitle("TablaEjemplo");
    
    $sheet = $objXLS ->getActiveSheet();
    $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
    $sheet->getDefaultStyle()->applyFromArray($style);
    $sheet->setTitle('Tabla de datos como Ejemplo');
    
    $header = json_decode($_POST['header']);
    $fila = 1;
    $columna = 'a';
    
    foreach($header as $value){
        $sheet ->getCell($columna.$fila)->setValue($value);
        $sheet->getColumnDimension($columna)->setWidth(20);
        $columna++;
    }
    
    $filas = count($header);
    
    $body = json_decode($_POST['body']);
    $fila = 2;
    $columna = 'a';
    $contador = 1;

    foreach($body as $value){
        
        if($contador == $filas){
            $sheet ->getCell($columna.$fila)->setValue($value);
            $columna = 'a';
            $fila++;
            $contador = 1;
        }else{    
            $sheet ->getCell($columna.$fila)->setValue($value);
            $columna++;
            $contador++;
        } 
         
         

    }
    
    
    $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel2007');
    $objWriter->save($sArchivo);

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->Port = '587';
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "correodeprueba.867@outlook.es";
    $mail->Password = "Prueba1234567";
    //);
    $mail->AddAddress("ro.jg01@hotmail.com");
    //$mail->AddAddress("vrofer@gmail.com");
    
    $mail->FromName = "Rodrigo";
    $mail->Subject = "Reporte de personas";
    $sHtml = 'Estimado usuario,<br> Se manda un reporte del personal.';
    $mail->MsgHTML($sHtml);
    $mail->From = $mail->Username;
    $mail->AddAttachment($sArchivo, 'TablaEjemplo.xlsx');
    if (!$mail->Send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else
    {
        echo "Enviado!";
    }

    exit;
?>

